<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // ==================== STUDENT REGISTRATION ====================
    public function showStudentRegister()
    {
        return view('auth.student-register');
    }

    public function studentRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'password' => 'required|min:6',
            'location' => 'required'
        ]);

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'location' => $request->location
        ]);

        return redirect('/student/login')->with('success', 'Registration successful! Please login.');
    }

    // ==================== STUDENT LOGIN (WITH REGISTRATION CHECK) ====================
    public function showStudentLogin()
    {
        return view('auth.student-login');
    }

    public function studentLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Pehle check karo email exist karta hai ya nahi
        $student = Student::where('email', $request->email)->first();
        
        // Agar student exist nahi karta
        if(!$student) {
            return back()->with('error', 'Account not found. Please register first.');
        }

        // Agar exist karta hai to password check karo
        if ($student && Hash::check($request->password, $student->password)) {
            Session::put('student_id', $student->id);
            Session::put('student_name', $student->name);
            Session::put('user_type', 'student');
            return redirect('/student/dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // ==================== TUTOR REGISTRATION ====================
    public function showTutorRegister()
    {
        return view('auth.tutor-register');
    }

    public function tutorRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:tutors',
            'password' => 'required|min:6|confirmed',
            'subject' => 'required',
            'qualification' => 'required',
            'experience' => 'required|integer',
            'location' => 'required',
            'profile_picture' => 'nullable|image|max:5120'
        ]);

        $profilePicPath = null;
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/uploads'), $filename);
            $profilePicPath = 'images/uploads/' . $filename;
        }

        Tutor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'subject' => $request->subject,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'hourly_rate' => $request->hourly_rate ?? '1500',
            'location' => $request->location,
            'bio' => $request->bio,
            'profile_picture' => $profilePicPath ?? 'images/burhan.png',
            'is_verified' => true
        ]);

        return redirect('/tutor/login')->with('success', 'Registration successful! Please login.');
    }

    // ==================== TUTOR LOGIN (WITH REGISTRATION CHECK) ====================
    public function showTutorLogin()
    {
        return view('auth.tutor-login');
    }

    public function tutorLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Pehle check karo email exist karta hai ya nahi
        $tutor = Tutor::where('email', $request->email)->first();
        
        // Agar tutor exist nahi karta
        if(!$tutor) {
            return back()->with('error', 'Account not found. Please register first.');
        }

        // Agar exist karta hai to password check karo
        if ($tutor && password_verify($request->password, $tutor->password)) {
            if($tutor->is_verified) {
                Session::put('tutor_id', $tutor->id);
                Session::put('tutor_name', $tutor->name);
                Session::put('user_type', 'tutor');
                return redirect('/tutor/dashboard');
            } else {
                return back()->with('error', 'Your account is pending admin verification.');
            }
        }

        return back()->with('error', 'Invalid credentials');
    }

    // ==================== LOGOUT ====================
    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}