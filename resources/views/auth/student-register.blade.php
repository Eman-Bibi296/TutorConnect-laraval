@extends('layouts.app')

@section('title', 'Student Register')

@section('content')
<div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 50px;">
    <div style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); width: 100%; max-width: 500px;">
        <h2 style="text-align: center; margin-bottom: 30px;">Student Registration</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        
        <form action="/student/register" method="POST">
            @csrf
            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Location</label>
                <input type="text" name="location" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class="text-center mt-3">Already have an account? <a href="/student/login">Login</a></p>
        </form>
    </div>
</div>
@endsection