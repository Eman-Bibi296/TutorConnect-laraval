@extends('layouts.app')
@section('title', 'Forgot Password - TutorConnect')
@section('content')
<div style="min-height: calc(100vh - 180px); display: flex; align-items: center; justify-content: center; padding: 40px 5%; background: #F8FAFC; font-family: 'Poppins', sans-serif;">
    <div style="background: white; border-radius: 24px; padding: 40px 35px; max-width: 480px; width: 100%; box-shadow: 0 4px 20px rgba(0,0,0,0.04); border: 1px solid #E2E8F0;">
        <h2 style="text-align:center; font-weight:800; color:#111827; margin-bottom:8px;">Forgot Password</h2>
        <p style="text-align:center; color:#64748B; margin-bottom:25px; font-size:0.9rem;">Enter your email to receive a reset OTP</p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="/forgot-password" method="POST">
            @csrf
            <div style="margin-bottom:16px;">
                <label style="font-weight:600; font-size:0.9rem; display:block; margin-bottom:6px;">I am a</label>
                <select name="user_type" required style="width:100%; padding:12px; border:1.5px solid #CBD5E1; border-radius:12px;">
                    <option value="student" {{ request('type') == 'student' ? 'selected' : '' }}>Student</option>
                     <option value="tutor" {{ request('type') == 'tutor' ? 'selected' : '' }}>Tutor</option>
                </select>
            </div>
            <div style="margin-bottom:20px;">
                <label style="font-weight:600; font-size:0.9rem; display:block; margin-bottom:6px;">Email Address</label>
                <input type="email" name="email" placeholder="name@example.com" required style="width:100%; padding:12px; border:1.5px solid #CBD5E1; border-radius:12px;">
            </div>
            <button type="submit" style="width:100%; background: linear-gradient(135deg, #059669 0%, #10B981 100%); color:white; padding:13px; border:none; border-radius:12px; font-weight:700; cursor:pointer;">
                Send OTP
            </button>
        </form>
    </div>
</div>
@endsection