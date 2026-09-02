<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\RequestModel;
use App\Models\Message;
use App\Models\Feedback;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function __construct()
    {
        if (!Session::has('student_id')) {
            redirect('/student/login')->send();
        }
    }

    public function dashboard()
    {
        $studentId = Session::get('student_id');
        $student = Student::find($studentId);
        
        if (!$student) {
            Session::forget(['student_id', 'student_name', 'user_type']);
            return redirect('/student/login')->with('error', 'Session expired. Please login again.');
        }
        
        $tutors = Tutor::where('is_verified', true)->with('feedback')->get();
        $requests = RequestModel::where('student_id', $studentId)->with('tutor')->get();
        
        $messages = DB::table('messages')
                    ->where('receiver_id', $studentId)
                    ->orWhere('sender_id', $studentId)
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        // ⭐ UNREAD COUNTS FOR SIDEBAR
        $unreadMessages = DB::table('messages')
            ->where('receiver_id', $studentId)
            ->where('receiver_type', 'student')
            ->where('is_read', 0)
            ->count();
        
        $unreadRequestChanges = RequestModel::where('student_id', $studentId)
            ->where('status', '!=', 'pending')
            ->where('is_viewed', 0)
            ->count();

              // ⭐⭐⭐⭐⭐ YEH LINE ADD KARO ⭐⭐⭐⭐⭐
        $unreadBookings = Booking::where('student_id', $studentId)
        ->where('status', 'confirmed')
        ->where('student_viewed', 0)
        ->count();
        
        return view('student.dashboard', compact(
            'student', 'tutors', 'requests', 'messages',
            'unreadMessages', 'unreadRequestChanges', 'unreadBookings'
        ));
    }

    public function searchTutors(Request $request)
    {
        $query = Tutor::where('is_verified', true);
        
        if ($request->subject) {
            $query->where('subject', 'LIKE', '%' . $request->subject . '%');
        }
        if ($request->location) {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }
        
        $tutors = $query->get();
        return response()->json($tutors);
    }

    public function showTutorProfile($id)
    {
        $tutor = Tutor::findOrFail($id);
        $feedback = Feedback::where('tutor_id', $id)->with('student')->get();
        $avgRating = $tutor->avgRating();

        // ⭐ NAYA CODE: Student ki is tutor ke sath request ka status check karo
    $existingRequest = RequestModel::where('student_id', Session::get('student_id'))
                        ->where('tutor_id', $id)
                        ->orderBy('created_at', 'desc')
                        ->first();
    
        
        return view('student.tutor-profile', compact('tutor', 'feedback', 'avgRating', 'existingRequest'));
    }

    public function sendRequest(Request $request)
    {
        $existing = RequestModel::where('student_id', Session::get('student_id'))
                                ->where('tutor_id', $request->tutor_id)
                                ->where('status', 'pending')
                                ->first();
        
        if ($existing) {
            return back()->with('error', 'Request already sent!');
        }
        
        RequestModel::create([
            'student_id' => Session::get('student_id'),
            'tutor_id' => $request->tutor_id,
            'status' => 'pending'
        ]);
        
        return back()->with('success', 'Request sent successfully!');
    }

    public function sendMessage(Request $request)
    {
        $receiverId = $request->receiver_id ?? $request->tutor_id;
        $messageText = $request->message ?? $request->reply;

        if (empty($messageText) || empty($receiverId)) {
            return back()->with('error', 'Please write a message before sending.');
        }

        Message::create([
            'sender_id' => Session::get('student_id'),
            'receiver_id' => $receiverId,
            'sender_type' => 'student',
            'receiver_type' => $request->receiver_type ?? 'tutor',
            'message' => $messageText,
            'is_read' => 0
        ]);
        
        return back()->with('success', 'Message sent!');
    }

    public function postFeedback(Request $request)
    {
        $studentId = Session::get('student_id');
        $tutorId = $request->tutor_id;
        
        // Allow both 'confirmed' and 'completed' bookings
        $hasCompletedSession = Booking::where('student_id', $studentId)
            ->where('tutor_id', $tutorId)
            ->whereIn('status', ['confirmed', 'completed'])
            ->exists();
        
        if(!$hasCompletedSession) {
            return back()->with('error', 'You can only review after completing the session.');
        }
        
        $alreadyReviewed = Feedback::where('student_id', $studentId)
            ->where('tutor_id', $tutorId)
            ->exists();
        
        if($alreadyReviewed) {
            return back()->with('error', 'You have already reviewed this tutor.');
        }
        
        Feedback::create([
            'student_id' => $studentId,
            'tutor_id' => $tutorId,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_read' => 0
        ]);
        
        return back()->with('success', 'Thank you for your feedback!');
    }

    public function myRequests()
    {
        $studentId = Session::get('student_id');
        
        // ⭐ MARK AS VIEWED WHEN STUDENT OPENS MY REQUESTS PAGE
        DB::table('requests')
            ->where('student_id', $studentId)
            ->where('status', '!=', 'pending')
            ->where('is_viewed', 0)
            ->update(['is_viewed' => 1]);
        
        $student = Student::find($studentId);
        $requests = RequestModel::where('student_id', $studentId)
                                ->with('tutor')
                                ->orderBy('created_at', 'desc')
                                ->get();
        
        $totalRequests = $requests->count();
        $pendingRequests = $requests->where('status', 'pending')->count();
        $acceptedRequests = $requests->where('status', 'accepted')->count();
        
        return view('student.my-requests', compact('requests', 'student', 'totalRequests', 'pendingRequests', 'acceptedRequests'));
    }
    
    public function submitBooking(Request $request)
    {
        $tutor = Tutor::findOrFail($request->tutor_id);
        $hourlyRate = (float)($tutor->hourly_rate ?? 1500);

        $booking = Booking::create([
            'student_id' => Session::get('student_id'),
            'tutor_id' => $request->tutor_id,
            'preferred_date' => $request->preferred_date ?? date('Y-m-d', strtotime('+1 day')),
            'preferred_time' => $request->preferred_time ?? '04:00 PM - 05:00 PM',
            'mode' => $request->mode ?? 'Online',
            'sessions_per_week' => $request->sessions_per_week ?? '1',
            'message' => $request->message ?? $request->topic ?? 'Course syllabus revision',
            
            'amount' => $hourlyRate,
            'status' => 'pending'
        ]);
        
        return redirect('/payment/' . $booking->id);
    }

    public function sendMessageAjax(Request $request)
    {
        try {
            $receiverId = $request->receiver_id ?? $request->tutor_id;
            $messageText = $request->message ?? $request->reply;

            if (empty($messageText) || empty($receiverId)) {
                return response()->json(['success' => false, 'error' => 'Receiver and message content are required.']);
            }

            $message = Message::create([
                'sender_id' => Session::get('student_id'),
                'receiver_id' => $receiverId,
                'sender_type' => 'student',
                'receiver_type' => $request->receiver_type ?? 'tutor',
                'message' => $messageText,
                'is_read' => 0
            ]);
            
            return response()->json(['success' => true, 'message' => $message]);
        } catch(\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function bookSessionOnly($tutorId)
    {
        $tutor = Tutor::findOrFail($tutorId);
        $avgRating = $tutor->avgRating();
        $totalReviews = Feedback::where('tutor_id', $tutorId)->count();
        
        return view('student.book-session-only', compact('tutor', 'avgRating', 'totalReviews'));
    }

    public function chatOnly($tutorId)
    {
        $tutor = Tutor::findOrFail($tutorId);
        
        $messages = Message::where(function($q) use ($tutorId) {
            $q->where('sender_id', Session::get('student_id'))->where('sender_type', 'student')
              ->where('receiver_id', $tutorId)->where('receiver_type', 'tutor');
        })->orWhere(function($q) use ($tutorId) {
            $q->where('sender_id', $tutorId)->where('sender_type', 'tutor')
              ->where('receiver_id', Session::get('student_id'))->where('receiver_type', 'student');
        })->orderBy('created_at')->get();
        
        return view('student.chat-only', compact('tutor', 'messages'));
    }

    public function messages()
    {
        $studentId = Session::get('student_id');
        
        // ⭐ MARK MESSAGES AS READ WHEN STUDENT OPENS MESSAGES PAGE
        DB::table('messages')
            ->where('receiver_id', $studentId)
            ->where('receiver_type', 'student')
            ->where('is_read', 0)
            ->update(['is_read' => 1]);
        
        $acceptedRequest = RequestModel::where('student_id', $studentId)
            ->where('status', 'accepted')
            ->with('tutor')
            ->first();
        
        if($acceptedRequest && $acceptedRequest->tutor) {
            $tutor = $acceptedRequest->tutor;
            $messages = Message::where(function($q) use ($studentId, $tutor) {
                $q->where('sender_id', $studentId)->where('sender_type', 'student')
                  ->where('receiver_id', $tutor->id)->where('receiver_type', 'tutor');
            })->orWhere(function($q) use ($studentId, $tutor) {
                $q->where('sender_id', $tutor->id)->where('sender_type', 'tutor')
                  ->where('receiver_id', $studentId)->where('receiver_type', 'student');
            })->orderBy('created_at')->get();
        } else {
            $tutor = null;
            $messages = collect([]);
        }
        
        return view('student.messages', compact('tutor', 'messages'));
    }

    public function getMessages($tutorId)
    {
        $studentId = Session::get('student_id');
        
        $messages = Message::where(function($q) use ($studentId, $tutorId) {
            $q->where('sender_id', $studentId)->where('sender_type', 'student')
              ->where('receiver_id', $tutorId)->where('receiver_type', 'tutor');
        })->orWhere(function($q) use ($studentId, $tutorId) {
            $q->where('sender_id', $tutorId)->where('sender_type', 'tutor')
              ->where('receiver_id', $studentId)->where('receiver_type', 'student');
        })->orderBy('created_at', 'asc')->get();
        
        return response()->json($messages);
    }

    public function myBookings()
    {
        $studentId = Session::get('student_id');
        
         DB::table('bookings')
        ->where('student_id', $studentId)
        ->where('status', 'confirmed')
        ->where('student_viewed', 0)
        ->update(['student_viewed' => 1]);
        $bookings = Booking::where('student_id', $studentId)
                            ->with('tutor')
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        $totalBookings = $bookings->count();
        $pendingBookings = $bookings->where('status', 'pending')->count();
        $confirmedBookings = $bookings->where('status', 'confirmed')->count();
        $upcomingBookings = $bookings->where('preferred_date', '>=', date('Y-m-d'))->where('status', 'confirmed')->count();
        
        return view('student.my-bookings', compact('bookings', 'totalBookings', 'pendingBookings', 'confirmedBookings', 'upcomingBookings'));
    }

    public function cancelBooking(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        if($booking && $booking->status == 'pending') {
            $booking->status = 'cancelled';
            $booking->save();
            return back()->with('success', 'Booking cancelled successfully!');
        }
        return back()->with('error', 'Booking cannot be cancelled');
    }

    // ==================== REVIEWS ====================
    public function reviews()
    {
        $studentId = Session::get('student_id');
        
        // Sirf un tutors ke IDs jinse student ne kabhi chat ki hai
        $chattedTutorIds = DB::table('messages')
            ->where(function($q) use ($studentId) {
                $q->where('sender_id', $studentId)->where('sender_type', 'student')
                  ->orWhere('receiver_id', $studentId)->where('receiver_type', 'student');
            })
            ->select(DB::raw('CASE 
                WHEN sender_type = "tutor" THEN sender_id 
                ELSE receiver_id 
            END as tutor_id'))
            ->distinct()
            ->pluck('tutor_id')
            ->toArray();
        
        // Sirf un tutors ke IDs jinse request accepted hai
        $acceptedTutorIds = RequestModel::where('student_id', $studentId)
            ->where('status', 'accepted')
            ->pluck('tutor_id')
            ->toArray();
        
        // Dono ko merge kar ke unique IDs
        $relatedTutorIds = array_unique(array_merge($chattedTutorIds, $acceptedTutorIds));
        
        // Agar koi related tutor nahi hai to empty reviews
        if(empty($relatedTutorIds)) {
            $reviews = collect([]);
            $avgRating = 0;
            $totalReviews = 0;
        } else {
            // Sirf related tutors ke reviews
            $reviews = Feedback::whereIn('tutor_id', $relatedTutorIds)
                                ->with(['student', 'tutor'])
                                ->orderBy('created_at', 'desc')
                                ->get();
            
            $avgRating = Feedback::whereIn('tutor_id', $relatedTutorIds)->avg('rating') ?? 0;
            $totalReviews = Feedback::whereIn('tutor_id', $relatedTutorIds)->count();
        }
        
        // Eligible tutors for giving feedback
        $eligibleTutors = DB::table('requests')
            ->join('tutors', 'requests.tutor_id', '=', 'tutors.id')
            ->where('requests.student_id', $studentId)
            ->where('requests.status', 'accepted')
            ->whereNotIn('tutors.id', function($query) use ($studentId) {
                $query->select('tutor_id')
                      ->from('feedback')
                      ->where('student_id', $studentId);
            })
            ->whereExists(function($query) use ($studentId) {
                $query->select(DB::raw(1))
                      ->from('messages')
                      ->whereRaw('(messages.sender_id = requests.student_id AND messages.receiver_id = requests.tutor_id)')
                      ->orWhereRaw('(messages.sender_id = requests.tutor_id AND messages.receiver_id = requests.student_id)');
            })
            ->select('tutors.id', 'tutors.name', 'tutors.subject')
            ->get();
        
        return view('student.reviews', compact('eligibleTutors', 'reviews', 'avgRating', 'totalReviews'));
    }

    // ==================== STUDY MATERIALS ====================
    public function studyMaterials()
    {
        $studentId = Session::get('student_id');

        // ⭐ JAB STUDENT STUDY MATERIALS PAGE OPEN KARE TOH IS_VIEWED = 1 KARO
    $acceptedTutorIds = RequestModel::where('student_id', $studentId)
        ->where('status', 'accepted')
        ->pluck('tutor_id')
        ->toArray();
    
    \DB::table('study_materials')
        ->whereIn('tutor_id', $acceptedTutorIds)
        ->where('is_viewed', 0)
        ->update(['is_viewed' => 1]);
        
        // Sirf un tutors ke materials jinse student ne chat ki hai
        $tutorIds = DB::table('messages')
            ->where(function($q) use ($studentId) {
                $q->where('sender_id', $studentId)->where('sender_type', 'student')
                  ->orWhere('receiver_id', $studentId)->where('receiver_type', 'student');
            })
            ->select(DB::raw('CASE 
                WHEN sender_type = "tutor" THEN sender_id 
                ELSE receiver_id 
            END as tutor_id'))
            ->distinct()
            ->pluck('tutor_id')
            ->toArray();
        
        $materials = \App\Models\StudyMaterial::whereIn('tutor_id', $tutorIds)
                        ->with('tutor')
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('student.study-materials', compact('materials'));
    }

    public function downloadMaterial($id)
    {
        $material = \App\Models\StudyMaterial::findOrFail($id);
        
        $studentId = Session::get('student_id');
        $hasConfirmedBooking = Booking::where('student_id', $studentId)
            ->where('tutor_id', $material->tutor_id)
            ->where('status', 'confirmed')
            ->exists();
        
        if(!$hasConfirmedBooking) {
            return back()->with('error', 'You can only download material after booking confirmation.');
        }
        
        $filePath = public_path($material->file_path);
        
        if(file_exists($filePath)) {
            return response()->download($filePath, $material->file_name);
        }
        
        return back()->with('error', 'File not found!');
    }

    public function markMessagesRead()
    {
        DB::table('messages')
            ->where('receiver_id', Session::get('student_id'))
            ->where('receiver_type', 'student')
            ->update(['is_read' => 1]);
        
        return response()->json(['success' => true]);
    }

    public function markRequestsViewed()
    {
        DB::table('requests')
            ->where('student_id', Session::get('student_id'))
            ->where('status', '!=', 'pending')
            ->update(['is_viewed' => 1]);
        
        return response()->json(['success' => true]);
    }

    public function markBookingsViewed()
    {
        DB::table('bookings')
            ->where('student_id', Session::get('student_id'))
            ->where('status', 'confirmed')
            ->update(['student_viewed' => 1]);
        
        return response()->json(['success' => true]);
    }

    public function deleteReview($id)
    {
        $review = Feedback::findOrFail($id);
        
        // Check karo ke yeh review is student ka hi hai
        if($review->student_id != Session::get('student_id')) {
            return back()->with('error', 'You cannot delete this review.');
        }
        
        $review->delete();
        return redirect('/student/reviews')->with('success', 'Review deleted successfully!');
    }
}