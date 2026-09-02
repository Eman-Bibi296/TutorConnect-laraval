@extends('layouts.app')

@section('title', 'Booking Confirmed - TutorConnect')

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

    .success-container {
        background: var(--bg-light);
        min-height: calc(100vh - 180px);
        padding: 35px 5%;
        font-family: 'Poppins', sans-serif;
    }
    
    .success-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .main-content {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 0;
    }
    
    .success-card {
        background: var(--bg-card);
        border-radius: 24px;
        padding: 45px 35px;
        max-width: 520px;
        width: 100%;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid var(--border-color);
    }
    
    .success-icon-badge {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--primary);
        font-size: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        border: 3px solid var(--accent);
    }
    
    .success-card h2 {
        color: var(--text-main);
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 10px;
    }
    
    .success-card p {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin: 0 0 30px;
        line-height: 1.6;
    }
    
    .btn-view-bookings {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 32px;
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.25);
    }
    
    .btn-view-bookings:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(5, 150, 105, 0.35);
        color: white;
    }
    
    @media (max-width: 900px) {
        .success-wrapper { flex-direction: column; }
        .success-card { padding: 30px 20px; }
    }
</style>

<div class="success-container">
    <div class="success-wrapper">
        
        <!-- Sidebar -->
        @include('student.partials.sidebar')
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="success-card">
                <div class="success-icon-badge">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h2>Booking Confirmed!</h2>
                <p>Your session has been successfully booked and payment has been processed. The tutor has been notified.</p>
                <a href="/student/my-bookings" class="btn-view-bookings">
                    <i class="fa-solid fa-calendar-check"></i> <span>View My Bookings</span>
                </a>
            </div>
        </div>
        
    </div>
</div>
@endsection