@extends('layouts.app')

@section('title', 'Student Login')

@section('content')
<div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 50px;">
    <div style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); width: 100%; max-width: 500px;">
        <h2 style="text-align: center; margin-bottom: 30px;">Student Login</h2>
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <form action="/student/login" method="POST">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <p class="text-center mt-3">Don't have an account? <a href="/student/register">Register</a></p>
        </form>
    </div>
</div>
@endsection