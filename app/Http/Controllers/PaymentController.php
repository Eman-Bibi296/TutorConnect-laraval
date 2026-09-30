<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    // ===== SHOW MANUAL PAYMENT PAGE =====
    public function showPaymentPage($bookingId)
    {
        $studentId = Session::get('student_id');
        if (!$studentId) {
            return redirect('/student/login')->with('error', 'Please login to view payment.');
        }

        $booking = Booking::with('tutor')->findOrFail($bookingId);

        if ($booking->student_id != $studentId) {
            return redirect('/student/dashboard')->with('error', 'Unauthorized access!');
        }

        return view('student.payment', compact('booking'));
    }

    // ===== SUBMIT TRANSACTION PROOF =====
    public function submitPaymentProof(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'payment_method' => 'required|in:JazzCash,EasyPaisa',
            'transaction_reference' => 'required|string|max:100'
        ]);

        $studentId = Session::get('student_id');
        $booking = Booking::find($request->booking_id);

        if (!$booking || $booking->student_id != $studentId) {
            return back()->with('error', 'Booking not found or unauthorized.');
        }

        $booking->payment_method = $request->payment_method;
        $booking->transaction_reference = $request->transaction_reference;
        $booking->payment_verification_status = 'submitted';
        $booking->payment_status = 'pending';
         $booking->is_viewed = 0;
        $booking->save();

        return redirect('/booking/success/' . $booking->id);
    }

    // ===== BOOKING SUCCESS / SUBMITTED PAGE =====
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