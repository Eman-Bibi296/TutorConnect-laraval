@extends('layouts.app')

@section('title', 'Tutor Profile')

@section('content')
<style>
    .profile-container {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 30px 5%;
    }
    
    .profile-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Sidebar Styles - Same as Dashboard */
    .sidebar {
        width: 280px;
        background: white;
        border-radius: 25px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        height: fit-content;
        position: sticky;
        top: 30px;
    }
    
    .sidebar-logo {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f4f8;
    }
    
    .sidebar-logo h2 {
        margin: 0;
        font-size: 1.5rem;
        color: #1a1a2e;
    }
    
    .sidebar-logo span {
        color: #4a6cf7;
    }
    
    .sidebar-logo p {
        font-size: 0.7rem;
        color: #999;
        margin: 5px 0 0;
    }
    
    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-menu li {
        margin-bottom: 8px;
    }
    
    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        color: #555;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s;
        font-weight: 500;
    }
    
    .sidebar-menu a:hover {
        background: #f0f4f8;
        color: #4a6cf7;
    }
    
    .sidebar-menu a.active {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
    }
    
    .logout-link {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    
    /* Main Content */
    .main-content {
        flex: 1;
    }
    
    .profile-card {
        background: white;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .profile-header {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        padding: 40px;
        text-align: center;
        color: white;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid white;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        background: rgba(255,255,255,0.2);
    }
    
    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-avatar .no-image {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        background: rgba(255,255,255,0.2);
        color: white;
    }
    
    .profile-name {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .profile-email {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 10px;
    }
    
    .profile-subject {
        background: rgba(255,255,255,0.2);
        display: inline-block;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 1rem;
    }
    
    .profile-body {
        padding: 40px;
    }
    
    .info-section {
        margin-bottom: 30px;
    }
    
    .info-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 15px;
        border-left: 4px solid #4a6cf7;
        padding-left: 15px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .info-item {
        background: #f8f9fc;
        padding: 12px 15px;
        border-radius: 12px;
    }
    
    .info-label {
        font-size: 0.7rem;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .info-value {
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a2e;
        margin-top: 5px;
    }
    
    .rating-section {
        background: #f8f9fc;
        padding: 20px;
        border-radius: 20px;
        text-align: center;
        margin-bottom: 20px;
    }
    
    .rating-number {
        font-size: 3rem;
        font-weight: 800;
        color: #4a6cf7;
    }
    
    .rating-stars {
        color: #ffc107;
        font-size: 1.2rem;
        margin: 10px 0;
    }
    
    .review-card {
        background: #f8f9fc;
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }
    
    .reviewer-name {
        font-weight: 700;
        color: #1a1a2e;
    }
    
    .review-date {
        font-size: 0.7rem;
        color: #999;
    }
    
    .review-stars {
        color: #ffc107;
        font-size: 0.8rem;
        margin: 5px 0;
    }
    
    .review-comment {
        color: #555;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-top: 8px;
    }
    
    .btn-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .btn-book-session {
        display: inline-block;
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 14px 25px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        flex: 1;
        text-align: center;
        min-width: 140px;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }
    
    .btn-book-session:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(40,167,69,0.4);
        color: white;
    }
    
    .btn-chat {
        display: inline-block;
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
        padding: 14px 25px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        flex: 1;
        text-align: center;
        min-width: 140px;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }
    
    .btn-chat:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(74,108,247,0.4);
        color: white;
    }
    
    .btn-disabled {
        background: #ccc;
        color: #666;
        padding: 14px 25px;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        flex: 1;
        text-align: center;
        cursor: not-allowed;
    }
    
    .price {
        font-size: 2rem;
        color: #4a6cf7;
        font-weight: 800;
    }
    
    .alert {
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 15px;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
    }
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
    }
    
    .row {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }
    
    .col-md-8 {
        flex: 2;
        min-width: 300px;
    }
    
    .col-md-4 {
        flex: 1;
        min-width: 250px;
    }
    
    .mt-3 {
        margin-top: 15px;
    }
    
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        .profile-body {
            padding: 20px;
        }
        .btn-group {
            flex-direction: column;
        }
        .sidebar {
            width: 100%;
            position: static;
        }
        .profile-wrapper {
            flex-direction: column;
        }
        .row {
            flex-direction: column;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-wrapper">
        
        <!-- Sidebar -->
        @include('student.partials.sidebar')
        
        <div class="main-content">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <!-- ⭐ PICTURE - DATABASE SE SHOW KARO -->
                        @if($tutor->profile_picture)
                            <img src="{{ asset($tutor->profile_picture) }}" alt="{{ $tutor->name }}">
                        @else
                            <div class="no-image">👨‍🏫</div>
                        @endif
                    </div>
                    <h1 class="profile-name">{{ $tutor->name }}</h1>
                    <div class="profile-email">{{ $tutor->email }}</div>
                    <div class="profile-subject">📖 {{ $tutor->subject }}</div>
                </div>
                
                <div class="profile-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="info-section">
                                <h3 class="info-title">About Me</h3>
                                <p style="color: #555; line-height: 1.8;">
                                    {{ $tutor->bio ?? $tutor->qualification . ' with ' . $tutor->experience . ' years of teaching experience. Specialized in ' . $tutor->subject . ' for school, college, and university level students.' }}
                                </p>
                            </div>
                            
                            <div class="info-section">
                                <h3 class="info-title">Qualifications & Experience</h3>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">Qualification</div>
                                        <div class="info-value">🎓 {{ $tutor->qualification }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Experience</div>
                                        <div class="info-value">📅 {{ $tutor->experience }} years</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Location</div>
                                        <div class="info-value">📍 {{ $tutor->location }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Availability</div>
                                        <div class="info-value">⏰ {{ $tutor->availability ?? 'Weekdays & Weekends' }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="info-section">
                                <h3 class="info-title">⭐ Ratings & Reviews</h3>
                                
                                <div class="rating-section">
                                    <div class="rating-number">{{ number_format($avgRating, 1) }}</div>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($avgRating))
                                                ★
                                            @elseif($i - 0.5 <= $avgRating)
                                                ⭐
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </div>
                                    <div style="color: #666;">Based on {{ $feedback->count() }} {{ Str::plural('review', $feedback->count()) }}</div>
                                </div>
                                
                                <h4 style="margin-top: 20px; margin-bottom: 15px;">📝 Student Reviews</h4>
                                
                                @forelse($feedback as $fb)
                                <div class="review-card">
                                    <div class="review-header">
                                        <span class="reviewer-name">{{ $fb->student->name ?? 'Student' }}</span>
                                        <span class="review-date">{{ $fb->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="review-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            {{ $i <= $fb->rating ? '★' : '☆' }}
                                        @endfor
                                    </div>
                                    <div class="review-comment">"{{ $fb->comment }}"</div>
                                </div>
                                @empty
                                <div style="background: #f8f9fc; padding: 30px; text-align: center; border-radius: 15px; color: #999;">
                                    No reviews yet. Be the first to review this tutor!
                                </div>
                                @endforelse
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="info-section" style="background: #f8f9fc; padding: 20px; border-radius: 20px;">
                                <h3 class="info-title">Session Pricing</h3>
                                <div class="price">
                                    Rs {{ $tutor->hourly_rate ?? $tutor->experience * 100 + 1000 }}
                                </div>
                                <p style="color: #666;">per hour</p>
                                
                                @php
                                    use App\Models\RequestModel;
                                    $requestStatus = RequestModel::where('student_id', Session::get('student_id'))
                                                        ->where('tutor_id', $tutor->id)
                                                        ->first();
                                @endphp

                                @if($requestStatus && $requestStatus->status == 'accepted')
                                    <div class="btn-group">
                                        <a href="/student/book-session-only/{{ $tutor->id }}" class="btn-book-session">
                                            📅 Book Session
                                        </a>
                                        <a href="/student/messages" class="btn-chat">
                                            💬 Chat with Tutor
                                        </a>
                                    </div>
                                @elseif($requestStatus && $requestStatus->status == 'pending')
                                    <button class="btn-disabled" disabled>
                                        ⏳ Request Pending
                                    </button>
                                @elseif($requestStatus && $requestStatus->status == 'rejected')
                                    <button class="btn-disabled" disabled style="background:#dc3545; color:white;">
                                        ❌ Request Rejected
                                    </button>
                                @else
                                    <form action="/student/send-request" method="POST">
                                        @csrf
                                        <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">
                                        <button type="submit" class="btn-book-session" style="background: linear-gradient(135deg, #4a6cf7, #6c5ce7);">
                                            📩 Send Request
                                        </button>
                                    </form>
                                @endif
                                
                                @if(session('success'))
                                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection