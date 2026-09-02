<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\RequestModel;
use App\Models\Feedback;
use App\Models\Message;
use App\Models\Booking;
use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TutorController extends Controller
{
    public function __construct()
    {
        if (!Session::has('tutor_id')) {
            redirect('/tutor/login')->send();
        }
    }

    public function dashboard()
    {
        $tutorId = Session::get('tutor_id');
        $tutor = Tutor::find($tutorId);
        
        if (!$tutor) {
            Session::forget(['tutor_id', 'tutor_name', 'user_type']);
            return redirect('/tutor/login')->with('error', 'Session expired. Please login again.');
        }
        
        // If bio or hourly_rate is null, prompt profile completion
        if (is_null($tutor->bio) || is_null($tutor->hourly_rate)) {
            return redirect('/tutor/profile/complete')->with('info', 'Please complete your profile first.');
        }


        
        $totalRequests = RequestModel::where('tutor_id', $tutorId)->count();
        $pendingRequests = RequestModel::where('tutor_id', $tutorId)->where('status', 'pending')->count();
        $requests = RequestModel::where('tutor_id', $tutorId)->with('student')->get();
        $activeStudents = RequestModel::where('tutor_id', $tutorId)->where('status', 'accepted')->count();
        $reviews = Feedback::where('tutor_id', $tutorId)->with('student', 'tutor')->get();
        $avgRating = Feedback::where('tutor_id', $tutorId)->avg('rating');
        $totalReviews = Feedback::where('tutor_id', $tutorId)->count();
        
        $bookings = Booking::where('tutor_id', $tutorId)->with('student')->get();
        $messages = Message::where('receiver_id', $tutorId)
                           ->where('receiver_type', 'tutor')
                           ->with('student')
                           ->orderBy('created_at', 'desc')
                           ->get();
        
        // ⭐ UNREAD COUNTS FOR SIDEBAR
        $unreadReviews = Feedback::where('tutor_id', $tutorId)->where('is_read', 0)->count();
        $unreadMessages = Message::where('receiver_id', $tutorId)->where('receiver_type', 'tutor')->where('is_read', 0)->count();
        $newRequests = RequestModel::where('tutor_id', $tutorId)->where('status', 'pending')->where('is_viewed', 0)->count();
        $newBookings = Booking::where('tutor_id', $tutorId)->where('status', 'pending')->where('is_viewed', 0)->count();
        
        return view('tutor.dashboard', compact(
            'totalRequests', 'pendingRequests', 'requests', 
            'activeStudents', 'reviews', 'avgRating', 'totalReviews', 'tutor',
            'bookings', 'messages', 'unreadReviews', 'unreadMessages', 'newRequests', 'newBookings'
        ));
    }

    public function showCompleteProfile()
    {
        $tutor = Tutor::find(Session::get('tutor_id'));
        return view('tutor.complete-profile', compact('tutor'));
    }

    public function saveCompleteProfile(Request $request)
    {
        $tutor = Tutor::find(Session::get('tutor_id'));
        
        $request->validate([
            'bio' => 'nullable',
            'hourly_rate' => 'nullable|numeric',
            'availability' => 'nullable',
            'qualification' => 'required',
            'experience' => 'required|integer',
            'subject' => 'required',
            'location' => 'required',
        ]);
        
        $tutor->bio = $request->bio;
        $tutor->hourly_rate = $request->hourly_rate;
        $tutor->availability = $request->availability;
        $tutor->qualification = $request->qualification;
        $tutor->experience = $request->experience;
        $tutor->subject = $request->subject;
        $tutor->location = $request->location;
        
        if ($request->profile_picture) {
            $tutor->profile_picture = $request->profile_picture;
        }
        
        $tutor->save();
        
        return redirect('/tutor/dashboard')->with('success', 'Profile completed successfully!');
    }

    public function updateStatus(Request $request)
    {
        $requestModel = RequestModel::find($request->request_id);
        if ($requestModel) {
            $requestModel->status = $request->status;

              if ($request->status == 'accepted') {
            $requestModel->is_viewed = 0;
        }


            $requestModel->save();
            return back()->with('success', 'Request ' . $request->status . '!');
        }
        return back()->with('error', 'Request not found');
    }
    
    public function editProfile()
    {
        $tutor = Tutor::find(Session::get('tutor_id'));
        return view('tutor.edit-profile', compact('tutor'));
    }

    public function updateProfile(Request $request)
    {
        $tutor = Tutor::find(Session::get('tutor_id'));
        
        $tutor->name = $request->name;
        $tutor->email = $request->email;
        $tutor->subject = $request->subject;
        $tutor->qualification = $request->qualification;
        $tutor->experience = $request->experience;
        $tutor->location = $request->location;
        $tutor->hourly_rate = $request->hourly_rate;
        $tutor->bio = $request->bio;
        $tutor->availability = $request->availability;
        
           // ⭐ BASE64 PICTURE SAVE KARO
    if ($request->filled('profile_picture') && $request->profile_picture != '') {
        $imageData = $request->profile_picture;
        
        // Check if it's base64
        if (strpos($imageData, 'data:image') === 0) {
            // Extract base64 data
            list($type, $data) = explode(';', $imageData);
            list(, $data) = explode(',', $data);
            $imageData = base64_decode($data);
            
            // Generate filename
            $fileName = time() . '_' . $tutor->id . '.png';
            $filePath = 'uploads/profiles/' . $fileName;
            
            // Save file
            file_put_contents(public_path($filePath), $imageData);
            $tutor->profile_picture = $filePath;
        }
    }
    
    $tutor->save();
    
    return redirect('/tutor/dashboard')->with('success', 'Profile updated successfully!');
}

    public function updateBookingStatus(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        if ($booking) {
            $booking->status = $request->status;
            
                if ($request->status == 'confirmed') {
            $booking->is_viewed = 0;
        }


            $booking->save();
            return back()->with('success', 'Booking ' . $request->status . '!');
        }
        return back()->with('error', 'Booking not found');
    }

    public function completeSession(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        if ($booking) {
            $booking->status = 'completed';
            $booking->save();
            return back()->with('success', 'Session marked as completed! Student can now review you.');
        }
        return back()->with('error', 'Booking not found');
    }

    public function replyMessage(Request $request)
    {
        $messageText = $request->reply ?? $request->message;
        $receiverId = $request->student_id ?? $request->receiver_id;

        if (empty($messageText) || empty($receiverId)) {
            return back()->with('error', 'Please write a reply before sending.');
        }
        
        Message::create([
            'sender_id' => Session::get('tutor_id'),
            'receiver_id' => $receiverId,
            'sender_type' => 'tutor',
            'receiver_type' => 'student',
            'message' => $messageText,
            'is_read' => 0
        ]);
        
        return back()->with('success', 'Reply sent successfully!');
    }

    // ==================== MESSAGES - MARK AS READ ====================
    public function messages()
    {
        $tutorId = Session::get('tutor_id');
        
        // ⭐ MARK AS READ WHEN TUTOR OPENS MESSAGES PAGE
        \DB::table('messages')
            ->where('receiver_id', $tutorId)
            ->where('receiver_type', 'tutor')
            ->where('is_read', 0)
            ->update(['is_read' => 1]);
        
        $messages = Message::where('receiver_id', $tutorId)
            ->where('receiver_type', 'tutor')
            ->with('student')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('tutor.messages', compact('messages'));
    }

    public function markMessagesRead()
    {
        $tutorId = Session::get('tutor_id');
        
        \DB::table('messages')
            ->where('receiver_id', $tutorId)
            ->where('receiver_type', 'tutor')
            ->update(['is_read' => 1]);
        
        return response()->json(['success' => true]);
    }

    // ==================== REVIEWS - MARK AS READ ====================
    public function reviews()
    {
        $tutorId = Session::get('tutor_id');
        
        // ⭐ MARK AS READ WHEN TUTOR OPENS REVIEWS PAGE
        \DB::table('feedback')
            ->where('tutor_id', $tutorId)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);
        
        $reviews = Feedback::where('tutor_id', $tutorId)
            ->with('student')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $avgRating = Feedback::where('tutor_id', $tutorId)->avg('rating') ?? 0;
        $totalReviews = Feedback::where('tutor_id', $tutorId)->count();
        
        return view('tutor.reviews', compact('reviews', 'avgRating', 'totalReviews'));
    }

    public function studyMaterials()
    {
        $tutorId = Session::get('tutor_id');
        $materials = StudyMaterial::where('tutor_id', $tutorId)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('tutor.study-materials', compact('materials'));
    }

    public function uploadMaterial(Request $request)
    {
        $request->validate([
            'title' => 'required',
            
            'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,txt|max:10240'
        ]);

        $tutorId = Session::get('tutor_id');
        
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'uploads/study_materials/' . $fileName;
        $file->move(public_path('uploads/study_materials'), $fileName);

        StudyMaterial::create([
            'tutor_id' => $tutorId,
            'title' => $request->title,
             'material_type' => $request->material_type ?? 'document',
            'description' => $request->description,
            'file_path' => $filePath,
            'file_name' => $fileName
        ]);

        return back()->with('success', 'Study material uploaded successfully!');
    }

    public function deleteMaterial($id)
    {
        $material = StudyMaterial::findOrFail($id);
        
        $filePath = public_path($material->file_path);
        if(file_exists($filePath)) {
            unlink($filePath);
        }
        
        $material->delete();
        return back()->with('success', 'Material deleted successfully!');
    }

    // ==================== GET STUDENT MESSAGES (AJAX) ====================
    public function getStudentMessages($studentId)
    {
        $tutorId = Session::get('tutor_id');
        
        $messages = Message::where(function($q) use ($tutorId, $studentId) {
            $q->where('sender_id', $tutorId)->where('sender_type', 'tutor')
              ->where('receiver_id', $studentId)->where('receiver_type', 'student');
        })->orWhere(function($q) use ($tutorId, $studentId) {
            $q->where('sender_id', $studentId)->where('sender_type', 'student')
              ->where('receiver_id', $tutorId)->where('receiver_type', 'tutor');
        })->orderBy('created_at', 'asc')->get();
        
        return response()->json($messages);
    }

    // ==================== REPLY MESSAGE AJAX ====================
    public function replyMessageAjax(Request $request)
    {
        try {
            $receiverId = $request->receiver_id ?? $request->student_id;
            $messageText = $request->message ?? $request->reply;

            if (empty($messageText) || empty($receiverId)) {
                return response()->json(['success' => false, 'error' => 'Receiver and message content are required.']);
            }

            $message = Message::create([
                'sender_id' => Session::get('tutor_id'),
                'receiver_id' => $receiverId,
                'sender_type' => 'tutor',
                'receiver_type' => 'student',
                'message' => $messageText,
                'is_read' => 0
            ]);
            
            return response()->json(['success' => true, 'message' => $message]);
        } catch(\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    
    public function markReviewsRead()
    {
        \DB::table('feedback')
            ->where('tutor_id', Session::get('tutor_id'))
            ->update(['is_read' => 1]);
        
        return response()->json(['success' => true]);
    }

    // ==================== STUDENT REQUESTS - MARK AS VIEWED ====================
    public function requests()
    {
        $tutorId = Session::get('tutor_id');
        
        // ⭐ MARK AS VIEWED WHEN TUTOR OPENS REQUESTS PAGE
        \DB::table('requests')
            ->where('tutor_id', $tutorId)
            ->where('status', 'pending')
            ->where('is_viewed', 0)
            ->update(['is_viewed' => 1]);
        
        $requests = RequestModel::where('tutor_id', $tutorId)
            ->with('student')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $pendingRequests = $requests->where('status', 'pending')->count();
        $acceptedRequests = $requests->where('status', 'accepted')->count();
        $rejectedRequests = $requests->where('status', 'rejected')->count();
        
        return view('tutor.requests', compact('requests', 'pendingRequests', 'acceptedRequests', 'rejectedRequests'));
    }

    // ==================== BOOKING REQUESTS - MARK AS VIEWED ====================
    public function bookings()
    {
        $tutorId = Session::get('tutor_id');
        
        // ⭐ MARK AS VIEWED WHEN TUTOR OPENS BOOKINGS PAGE
        \DB::table('bookings')
            ->where('tutor_id', $tutorId)
            ->where('status', 'confirmed')
            ->where('is_viewed', 0)
            ->update(['is_viewed' => 1]);
        
        $bookings = Booking::where('tutor_id', $tutorId)
            ->with('student')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $pendingBookings = $bookings->where('status', 'pending')->count();
        $confirmedBookings = $bookings->where('status', 'confirmed')->count();
        $completedBookings = $bookings->where('status', 'completed')->count();
        $cancelledBookings = $bookings->where('status', 'cancelled')->count();
        
        return view('tutor.bookings', compact('bookings', 'pendingBookings', 'confirmedBookings', 'completedBookings', 'cancelledBookings'));
    }
    public function confirmPayment(Request $request)
{
    $booking = Booking::find($request->booking_id);
    if ($booking) {
        $booking->tutor_confirmed = 1;
        $booking->student_viewed = 0;
        $booking->save();
        return back()->with('success', 'Payment confirmed! Student has been notified.');
    }
    return back()->with('error', 'Booking not found');
}
}