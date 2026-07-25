@extends('layouts.app')

@section('title', 'Tutor Login')

@section('content')
<style>
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px;
        background: linear-gradient(135deg, #667eea 0%, #b4a9be 100%);
    }
    .login-card {
        background: white;
        border-radius: 30px;
        padding: 40px;
        max-width: 450px;
        width: 100%;
    }
    .login-card h2 { text-align: center; margin-bottom: 10px; }
    .login-card p { text-align: center; color: #666; margin-bottom: 30px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { font-weight: 600; display: block; margin-bottom: 8px; }
    .form-group input { width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 12px; }
    .btn-login { width: 100%; background: linear-gradient(135deg, #4a6cf7, #6c5ce7); color: white; padding: 12px; border: none; border-radius: 12px; cursor: pointer; }
    .register-link { text-align: center; margin-top: 20px; }
    .alert { padding: 10px; border-radius: 8px; margin-bottom: 15px; }
    .alert-danger { background: #f8d7da; color: #721c24; }
    .alert-success { background: #d4edda; color: #155724; }
</style>

<div class="login-container">
    <div class="login-card">
        <h2>Tutor Login</h2>
        <p>Login to manage your tutoring sessions</p>
        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

        <form action="/tutor/login" method="POST">
            @csrf
            <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
            <button type="submit" class="btn-login">Login</button>
            <div class="register-link">Don't have an account? <a href="/tutor/register">Register</a></div>
        </form>
    </div>
</div>
@endsection