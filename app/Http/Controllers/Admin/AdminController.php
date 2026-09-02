<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\RequestModel;
use App\Models\Booking;
use App\Models\Feedback;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct()
    {
        if (!Session::has('admin_logged_in')) {
            redirect('/admin/login')->send();
        }
    }

    public function dashboard()
    {
        $totalStudents = Student::count();
        $totalTutors = Tutor::count();
        $totalRequests = RequestModel::count();
        $totalBookings = Booking::count();
        $pendingTutors = Tutor::where('is_verified', false)->count();
        $totalRevenue = Booking::where('status', 'confirmed')->sum('amount') ?? 0;
        
        // Recent data for charts
        $recentStudents = Student::orderBy('created_at', 'desc')->take(5)->get();
        $recentTutors = Tutor::orderBy('created_at', 'desc')->take(5)->get();
        $recentBookings = Booking::with(['student', 'tutor'])->orderBy('created_at', 'desc')->take(5)->get();
        $recentReviews = Feedback::with(['student', 'tutor'])->orderBy('created_at', 'desc')->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalStudents', 'totalTutors', 'totalRequests', 
            'totalBookings', 'pendingTutors', 'totalRevenue',
            'recentStudents', 'recentTutors', 'recentBookings', 'recentReviews'
        ));
    }

    // ==================== STUDENTS MANAGEMENT ====================
    public function students()
    {
        $students = Student::with(['requests', 'bookings'])->orderBy('created_at', 'desc')->get();
        return view('admin.students', compact('students'));
    }

    public function studentDelete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return back()->with('success', 'Student deleted successfully');
    }

    // ==================== TUTORS MANAGEMENT ====================
    public function tutors()
    {
        $tutors = Tutor::orderBy('created_at', 'desc')->get();
        return view('admin.tutors', compact('tutors'));
    }

    public function tutorVerify($id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->is_verified = true;
        $tutor->save();
        return back()->with('success', 'Tutor verified successfully');
    }

    public function tutorDelete($id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->delete();
        return back()->with('success', 'Tutor deleted successfully');
    }

    // ==================== REQUESTS MANAGEMENT ====================
    public function requests()
    {
        $requests = RequestModel::with(['student', 'tutor'])->orderBy('created_at', 'desc')->get();
        return view('admin.requests', compact('requests'));
    }

    public function requestDelete($id)
    {
        $request = RequestModel::findOrFail($id);
        $request->delete();
        return back()->with('success', 'Request deleted successfully');
    }

    // ==================== BOOKINGS MANAGEMENT ====================
    public function bookings()
    {
        $bookings = Booking::with(['student', 'tutor'])->orderBy('created_at', 'desc')->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function bookingCancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();
        return back()->with('success', 'Booking cancelled successfully');
    }

    // ==================== REVIEWS MANAGEMENT ====================
    public function reviews()
    {
        $feedbacks = Feedback::with(['student', 'tutor'])->orderBy('created_at', 'desc')->get();
        $reviews = $feedbacks;
        return view('admin.reviews', compact('feedbacks', 'reviews'));
    }

    public function reviewDelete($id)
    {
        $review = Feedback::findOrFail($id);
        $review->delete();
        return back()->with('success', 'Review deleted successfully');
    }

    // ==================== MESSAGES MANAGEMENT ====================
    public function messages()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages', compact('messages'));
    }

    public function messageDelete($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return back()->with('success', 'Message deleted successfully');
    }
}