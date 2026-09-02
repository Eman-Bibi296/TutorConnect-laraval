<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    // ===== SHOW PAYMENT PAGE =====
    public function showPaymentPage($bookingId)
    {
        $studentId = Session::get('student_id');
        if (!$studentId) {
            return redirect('/student/login')->with('error', 'Please login to view payment.');
        }

        $booking = Booking::with('tutor')->findOrFail($bookingId);
        
        // Check if booking belongs to logged-in student
        if ($booking->student_id != $studentId) {
            return redirect('/student/dashboard')->with('error', 'Unauthorized access!');
        }
        
        $stripeKey = config('services.stripe.key') ?? env('STRIPE_KEY');
        return view('student.payment', compact('booking', 'stripeKey'));
    }

    // ===== CREATE PAYMENT INTENT =====
    public function createPaymentIntent(Request $request)
    {
        try {
            $studentId = Session::get('student_id');
            
            if (!$studentId) {
                return response()->json(['success' => false, 'message' => 'Please login first']);
            }
            
            $amount = (float)($request->amount ?? 1000);
            $secretKey = config('services.stripe.secret') ?? env('STRIPE_SECRET');

            if (!empty($secretKey) && env('PAYMENT_MODE') !== 'demo_only') {
                try {
                    $stripe = new \Stripe\StripeClient($secretKey);
                    $paymentIntent = $stripe->paymentIntents->create([
                        'amount' => (int)($amount * 100),
                        'currency' => 'usd',
                        'metadata' => [
                            'student_id' => $studentId,
                            'tutor_id' => $request->tutor_id
                        ]
                    ]);
                    
                    return response()->json([
                        'success' => true,
                        'clientSecret' => $paymentIntent->client_secret
                    ]);
                } catch (\Throwable $stripeEx) {
                    // Fall back to demo mode if Stripe network/key is unavailable
                    return response()->json([
                        'success' => true,
                        'demo' => true,
                        'clientSecret' => 'pi_demo_secret_' . uniqid()
                    ]);
                }
            } else {
                return response()->json([
                    'success' => true,
                    'demo' => true,
                    'clientSecret' => 'pi_demo_secret_' . uniqid()
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    // ===== BOOK AND PAY =====
    public function bookAndPay(Request $request)
    {
        try {
            $studentId = Session::get('student_id');
            if (!$studentId) {
                return response()->json(['success' => false, 'message' => 'Please login first']);
            }
            
            // Find booking
            $booking = Booking::find($request->booking_id);
            
            if (!$booking) {
                return response()->json(['success' => false, 'message' => 'Booking not found']);
            }

            if ($booking->student_id != $studentId) {
                return response()->json(['success' => false, 'message' => 'Unauthorized booking access']);
            }

            $txId = $request->payment_intent_id ?? ('pi_demo_' . uniqid());
            $amount = (float)($request->amount ?? $booking->amount ?? 1500);
            
            // Atomically update Booking and create/update Payment ledger
            DB::transaction(function() use ($booking, $studentId, $request, $txId, $amount) {
                $booking->status = 'confirmed';
                $booking->payment_status = 'paid';
                $booking->payment_id = $txId;
                $booking->is_viewed = 0;
                $booking->student_viewed = 1;
                $booking->save();
                
                Payment::updateOrCreate(
                    ['booking_id' => $booking->id],
                    [
                        'student_id' => $studentId,
                        'tutor_id' => $booking->tutor_id ?? $request->tutor_id,
                        'amount' => $amount,
                        'currency' => 'usd',
                        'transaction_id' => $txId,
                        'status' => 'completed'
                    ]
                );
            });
            
            return response()->json([
                'success' => true,
                'booking_id' => $booking->id
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    
    // ===== BOOKING SUCCESS PAGE =====
    public function bookingSuccess($bookingId)
    {
        $studentId = Session::get('student_id');
        if (!$studentId) {
            return redirect('/student/login')->with('error', 'Please login first.');
        }

        $booking = Booking::with('tutor')->findOrFail($bookingId);
        
        if ($booking->student_id != $studentId) {
            return redirect('/student/dashboard')->with('error', 'Unauthorized access.');
        }

        return view('student.booking-success', compact('booking'));
    }
}
