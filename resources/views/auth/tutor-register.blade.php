@extends('layouts.app')

@section('title', 'Tutor Registration')

@section('content')
<style>
    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .register-card {
        background: white;
        border-radius: 30px;
        padding: 40px;
        max-width: 550px;
        width: 100%;
    }
    .register-card h2 { text-align: center; margin-bottom: 30px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { font-weight: 600; display: block; margin-bottom: 8px; }
    .form-group input, .form-group select { width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 12px; }
    .btn-register { width: 100%; background: linear-gradient(135deg, #4a6cf7, #6c5ce7); color: white; padding: 12px; border: none; border-radius: 12px; font-size: 1rem; cursor: pointer; }
    .login-link { text-align: center; margin-top: 20px; }
    .alert { padding: 10px; border-radius: 8px; margin-bottom: 15px; }
    .alert-success { background: #d4edda; color: #155724; }
    .alert-danger { background: #f8d7da; color: #721c24; }
</style>

<div class="register-container">
    <div class="register-card">
        <h2> Become a Tutor</h2>
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

        <form action="/tutor/register" method="POST">
            @csrf
            <div class="form-group"><label>Full Name</label><input type="text" name="name" required></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
            <div class="form-group"><label>Confirm Password</label><input type="password" name="password_confirmation" required></div>
            <div class="form-group"><label>Subject</label><input type="text" name="subject" required></div>
            <div class="form-group"><label>Qualification</label><input type="text" name="qualification" required></div>
            <div class="form-group"><label>Experience (Years)</label><input type="number" name="experience" required></div>
            <div class="form-group"><label>Location</label><input type="text" name="location" required></div>
            <button type="submit" class="btn-register">Register</button>
            <div class="login-link">Already have an account? <a href="/tutor/login">Login</a></div>
        </form>
    </div>
</div>
@endsection