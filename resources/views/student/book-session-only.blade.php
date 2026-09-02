@extends('layouts.app')

@section('title', 'Book a Session - TutorConnect')

@section('content')
<style>
    :root {
        --primary: #059669;
        --primary-hover: #047857;
        --primary-light: #ECFDF5;
        --accent: #10B981;
        --bg-dark: #111827;
        --bg-dark-secondary: #1E293B;
        --bg-light: #F8FAFC;
        --bg-card: #FFFFFF;
        --text-main: #111827;
        --text-muted: #64748B;
        --border-color: #E2E8F0;
    }

    .booking-container {
        background: var(--bg-light);
        min-height: calc(100vh - 180px);
        padding: 35px 5%;
        font-family: 'Poppins', sans-serif;
    }
    
    .booking-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .main-content {
        flex: 1;
        min-width: 0;
    }
    
    .booking-card {
        background: var(--bg-card);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid var(--border-color);
        max-width: 720px;
        margin: 0 auto;
    }
    
    .booking-header {
        background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-dark-secondary) 100%);
        padding: 35px 30px;
        text-align: center;
        color: white;
    }
    
    .booking-header h2 {
        margin: 0;
        font-size: 1.6rem;
        font-weight: 800;
    }
    
    .booking-header p {
        margin: 8px 0 0;
        color: #94A3B8;
        font-size: 0.92rem;
    }
    
    .tutor-info-banner {
        display: flex;
        align-items: center;
        gap: 16px;
        background: #F8FAFC;
        padding: 20px;
        margin: 24px;
        border-radius: 16px;
        border: 1px solid var(--border-color);
    }
    
    .tutor-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--primary);
        border: 2px solid var(--accent);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        font-weight: 800;
        flex-shrink: 0;
    }
    
    .tutor-details h3 {
        margin: 0 0 4px;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-main);
    }
    
    .tutor-details p {
        margin: 0;
        color: var(--text-muted);
        font-size: 0.85rem;
    }
    
    .tutor-price-badge {
        margin-top: 4px;
        color: var(--primary);
        font-weight: 700;
        font-size: 0.9rem;
    }
    
    .booking-form {
        padding: 0 24px 24px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-main);
        font-size: 0.9rem;
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #CBD5E1;
        border-radius: 12px;
        font-size: 0.95rem;
        outline: none;
        transition: all 0.2s ease;
        font-family: inherit;
        background: white;
        box-sizing: border-box;
    }
    
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    
    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-size: 1.05rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(5, 150, 105, 0.35);
    }
    
    .alert {
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }
    
    .alert-success { background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; }
    .alert-danger { background: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; }
    .alert-info { background: #F0F9FF; color: #075985; border: 1px solid #BAE6FD; }
    
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin: 0 24px 24px;
        color: var(--text-muted);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.88rem;
        transition: color 0.2s;
    }
    
    .back-btn:hover {
        color: var(--primary);
    }
    
    @media (max-width: 900px) {
        .booking-wrapper { flex-direction: column; }
        .form-row { grid-template-columns: 1fr; }
        .booking-form { padding: 0 18px 18px; }
        .tutor-info-banner { margin: 18px; }
    }
</style>

<div class="booking-container">
    <div class="booking-wrapper">
        
        @include('student.partials.sidebar')
        
        <div class="main-content">
            <div class="booking-card">
                
                <div class="booking-header">
                    <h2><i class="fa-solid fa-calendar-plus"></i> Schedule a Tutoring Session</h2>
                    <p>Select your preferred dates, time, and session format</p>
                </div>
                
                <div class="tutor-info-banner">
                    <div class="tutor-avatar">{{ substr($tutor->name, 0, 1) }}</div>
                    <div class="tutor-details">
                        <h3>{{ $tutor->name }}</h3>
                        <p><i class="fa-solid fa-book"></i> {{ $tutor->subject }} &nbsp;•&nbsp; <i class="fa-solid fa-location-dot"></i> {{ $tutor->location }}</p>
                        <div class="tutor-price-badge"><i class="fa-solid fa-tag"></i> Rs {{ $tutor->hourly_rate ?? 1500 }}/hour</div>
                    </div>
                </div>
                
                @if(session('success'))
                    <div style="padding: 0 24px;">
                        <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
                    </div>
                @endif
                @if(session('error'))
                    <div style="padding: 0 24px;">
                        <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}</div>
                    </div>
                @endif
                @if(session('info'))
                    <div style="padding: 0 24px;">
                        <div class="alert alert-info"><i class="fa-solid fa-circle-info"></i> {{ session('info') }}</div>
                    </div>
                @endif
                
                <form action="/student/submit-booking" method="POST" class="booking-form">
                    @csrf
                    <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fa-regular fa-calendar"></i> Preferred Date</label>
                            <input type="date" name="preferred_date" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fa-regular fa-clock"></i> Preferred Time</label>
                            <input type="time" name="preferred_time" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fa-solid fa-laptop"></i> Learning Mode</label>
                            <select name="mode" required>
                                <option value="">-- Select Mode --</option>
                                <option value="Online">Online</option>
                                <option value="On-site">On-site</option>
                                <option value="Both">Both</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><i class="fa-solid fa-repeat"></i> Sessions Per Week</label>
                            <select name="sessions_per_week" required>
                                <option value="1">1 Session / week</option>
                                <option value="2">2 Sessions / week</option>
                                <option value="3">3 Sessions / week</option>
                                <option value="4">4 Sessions / week</option>
                                <option value="5">5 Sessions / week</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fa-regular fa-message"></i> Notes / Goals for Tutor</label>
                        <textarea name="message" rows="3" placeholder="Describe topics or learning goals you would like to focus on..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-check"></i> <span>Confirm & Proceed to Payment</span>
                    </button>
                </form>
                
                <a href="/student/dashboard" class="back-btn">
                    <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection