@extends('layouts.app')

@section('title', 'Student Registration - TutorConnect')

@section('content')
<style>
    :root {
        --primary: #059669;
        --primary-hover: #047857;
        --primary-light: #ECFDF5;
        --accent: #10B981;
        --bg-dark: #111827;
        --bg-light: #F8FAFC;
        --bg-card: #FFFFFF;
        --text-main: #111827;
        --text-muted: #64748B;
        --border-color: #E2E8F0;
    }

    .auth-container {
        min-height: calc(100vh - 220px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 20px;
        background: var(--bg-light);
        font-family: 'Poppins', sans-serif;
    }
    
    .auth-card {
        background: var(--bg-card);
        border-radius: 24px;
        padding: 40px 35px;
        max-width: 520px;
        width: 100%;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
        border: 1px solid var(--border-color);
    }
    
    .auth-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .auth-header-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin: 0 auto 16px;
        border: 2px solid var(--accent);
    }

    .auth-card h2 {
        color: var(--text-main);
        font-weight: 800;
        font-size: 1.8rem;
        margin-bottom: 6px;
    }
    
    .auth-card p {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 0;
    }
    
    .form-group {
        margin-bottom: 18px;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-main);
        font-size: 0.9rem;
    }
    
    .form-group input {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #CBD5E1;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background: white;
        outline: none;
        font-family: inherit;
    }
    
    .form-group input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    
    .btn-auth-submit {
        width: 100%;
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        border: none;
        padding: 13px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);
        margin-top: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    
    .btn-auth-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(5, 150, 105, 0.45);
        color: white;
    }
    
    .auth-footer {
        text-align: center;
        margin-top: 25px;
        color: var(--text-muted);
        font-size: 0.9rem;
    }
    
    .auth-footer a {
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
    }
    
    .auth-footer a:hover {
        text-decoration: underline;
    }

    .auth-alert {
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .auth-alert-danger {
        background: #FEF2F2;
        color: #991B1B;
        border: 1px solid #FECACA;
    }

    .auth-alert-success {
        background: #ECFDF5;
        color: #065F46;
        border: 1px solid #A7F3D0;
    }
</style>

<div class="auth-container">
    <div class="auth-card animate-fade-in-up">
        <div class="auth-header">
            <div class="auth-header-icon"><i class="fa-solid fa-user-plus"></i></div>
            <h2>Create Student Account</h2>
            <p>Join TutorConnect to find verified expert tutors near you</p>
        </div>
        
        @if(session('success'))
            <div class="auth-alert auth-alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif
        @if($errors->any())
            <div class="auth-alert auth-alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div>{{ $errors->first() }}</div>
            </div>
        @endif
        
        <form action="/student/register" method="POST">
            @csrf
            <div class="form-group">
                <label><i class="fa-regular fa-user"></i> Full Name</label>
                <input type="text" name="name" placeholder="e.g. Eman Bibi" value="{{ old('name') }}" required>
            </div>
            
            <div class="form-group">
                <label><i class="fa-regular fa-envelope"></i> Email Address</label>
                <input type="email" name="email" placeholder="e.g. eman@student.com" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label><i class="fa-solid fa-lock"></i> Password</label>
                <input type="password" name="password" placeholder="Create a secure password" minlength="6" required>
            </div>
            
            <div class="form-group">
                <label><i class="fa-solid fa-location-dot"></i> City / Location</label>
                <input type="text" name="location" placeholder="e.g. Islamabad, Lahore, Sheikhupura" value="{{ old('location') }}" required>
            </div>
            
            <button type="submit" class="btn-auth-submit">
                <i class="fa-solid fa-user-plus me-1"></i> Create Student Account
            </button>
        </form>
        
        <div class="auth-footer">
            Already have an account? <a href="/student/login">Sign in here</a>
        </div>
    </div>
</div>
@endsection