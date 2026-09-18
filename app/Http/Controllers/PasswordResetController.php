<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\PasswordResetOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'user_type' => 'required|in:student,tutor'
        ]);

        $userType = $request->user_type;
        $model = $userType == 'student' ? Student::class : Tutor::class;
        $user = $model::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'No account found with this email.');
        }

        $otp = rand(100000, 999999);

        PasswordResetOtp::updateOrCreate(
            ['email' => $request->email, 'user_type' => $userType],
            ['otp' => $otp, 'expires_at' => now()->addMinutes(10)]
        );

        try {
            Mail::raw("Your TutorConnect password reset OTP is: $otp\nThis code expires in 10 minutes.", function ($message) use ($request) {
                $message->to($request->email)->subject('TutorConnect - Password Reset OTP');
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Could not send email. Please check mail configuration.');
        }

        Session::put('reset_email', $request->email);
        Session::put('reset_user_type', $userType);

        return redirect('/verify-otp')->with('success', 'An OTP has been sent to your email.');
    }

    public function showOtpForm()
    {
        if (!Session::has('reset_email')) {
            return redirect('/forgot-password');
        }
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);

        $email = Session::get('reset_email');
        $userType = Session::get('reset_user_type');

        $record = PasswordResetOtp::where('email', $email)
                    ->where('user_type', $userType)
                    ->where('otp', $request->otp)
                    ->first();

        if (!$record) {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }

        if (now()->greaterThan($record->expires_at)) {
            return back()->with('error', 'OTP has expired. Please request a new one.');
        }

        Session::put('otp_verified', true);
        return redirect('/reset-password')->with('success', 'OTP verified! Set your new password.');
    }

    public function showResetForm()
    {
        if (!Session::get('otp_verified')) {
            return redirect('/forgot-password');
        }
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        if (!Session::get('otp_verified')) {
            return redirect('/forgot-password')->with('error', 'Session expired. Please start again.');
        }

        $email = Session::get('reset_email');
        $userType = Session::get('reset_user_type');

        $model = $userType == 'student' ? Student::class : Tutor::class;
        $user = $model::where('email', $email)->first();

        if (!$user) {
            return redirect('/forgot-password')->with('error', 'Account not found.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        PasswordResetOtp::where('email', $email)->where('user_type', $userType)->delete();
        Session::forget(['reset_email', 'reset_user_type', 'otp_verified']);

        $loginRoute = $userType == 'student' ? '/student/login' : '/tutor/login';
        return redirect($loginRoute)->with('success', 'Password reset successfully! Please login.');
    }
}