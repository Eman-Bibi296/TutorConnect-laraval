@extends('layouts.app')

@section('title', $tutor->name . ' - Tutor Profile - TutorConnect')

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

    .profile-container {
        padding: 35px 5%;
        min-height: calc(100vh - 180px);
        background: var(--bg-light);
        font-family: 'Poppins', sans-serif;
    }
    .profile-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    .main-content {
        flex: 1;
        min-width: 0;
    }
    
    .profile-card {
        background: var(--bg-card);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid var(--border-color);
    }
    
    .profile-header {
        background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-dark-secondary) 100%);
        padding: 40px 30px;
        text-align: center;
        color: white;
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        margin: 0 auto 18px;
        border-radius: 50%;
        overflow: hidden;
        border: 3.5px solid white;
        box-shadow: 0 6px 18px rgba(0,0,0,0.18);
        background: #064E3B;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-name {
        font-size: 1.9rem;
        font-weight: 800;
        margin: 0 0 6px;
        letter-spacing: -0.5px;
    }
    .profile-email {
        font-size: 0.9rem;
        color: #94A3B8;
        margin-bottom: 12px;
    }
    
    .profile-subject {
        background: rgba(16, 185, 129, 0.18);
        border: 1px solid rgba(16, 185, 129, 0.35);
        color: #34D399;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 18px;
        border-radius: 30px;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .profile-body {
        padding: 35px;
    }
    .row-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }
    .info-section {
        margin-bottom: 30px;
    }
    .info-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 16px;
        border-left: 4px solid var(--primary);
        padding-left: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    .info-item {
        background: #F8FAFC;
        padding: 14px 18px;
        border-radius: 14px;
        border: 1px solid var(--border-color);
    }
    .info-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
        font-weight: 700;
    }
    .info-value {
        font-size: 0.98rem;
        font-weight: 600;
        color: var(--text-main);
        margin-top: 4px;
    }
    
    .rating-section {
        background: #F8FAFC;
        padding: 24px;
        border-radius: 18px;
        text-align: center;
        border: 1px solid var(--border-color);
    }
    .rating-number {
        font-size: 2.8rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
    }
    .rating-stars {
        color: #F59E0B;
        font-size: 1.3rem;
        margin: 8px 0;
    }

    .review-card {
        background: #F8FAFC;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 14px;
    }
    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
        flex-wrap: wrap;
    }
    .reviewer-name {
        font-weight: 700;
        color: var(--text-main);
        font-size: 0.92rem;
    }
    .review-date {
        font-size: 0.75rem;
        color: var(--text-muted);
    }
    .review-stars {
        color: #F59E0B;
        font-size: 0.9rem;
        margin-bottom: 6px;
    }
    .review-comment {
        color: #475569;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .pricing-card {
        background: #F8FAFC;
        padding: 24px;
        border-radius: 18px;
        border: 1px solid var(--border-color);
        text-align: center;
    }
    .price-amount {
        font-size: 2.2rem;
        color: var(--primary);
        font-weight: 800;
        line-height: 1;
        margin: 12px 0 4px;
    }
    .price-unit {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-bottom: 20px;
    }

    .btn-action-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .btn-book-session {
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        padding: 13px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.25);
        border: none;
        cursor: pointer;
        width: 100%;
        transition: all 0.2s;
    }
    .btn-book-session:hover {
        color: white;
        transform: translateY(-2px);
    }
    .btn-chat {
        background: #111827;
        color: white;
        padding: 13px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-chat:hover {
        color: white;
        background: #1E293B;
    }

    @media (max-width: 900px) {
        .profile-wrapper { flex-direction: column; }
        .row-grid { grid-template-columns: 1fr; }
        .info-grid { grid-template-columns: 1fr; }
    }
</style>

@php
    $tutorAvatar = 'images/burhan.png';
    if (!empty($tutor->profile_picture) && file_exists(public_path($tutor->profile_picture))) {
        $tutorAvatar = $tutor->profile_picture;
    } else {
        $firstName = strtolower(explode(' ', str_replace(['Dr.', 'Prof.', 'Mr.', 'Ms.'], '', $tutor->name))[0] ?? 'burhan');
        if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
            $tutorAvatar = 'images/' . $firstName . '.jpg';
        } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
            $tutorAvatar = 'images/' . $firstName . '.png';
        }
    }
@endphp

<div class="profile-container">
    <div class="profile-wrapper">
        <!-- Student Sidebar -->
        @include('student.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="profile-card">
                <!-- Profile Header -->
                <div class="profile-header">
                    <div class="profile-avatar">
                        <img src="{{ asset($tutorAvatar) }}" alt="{{ $tutor->name }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($tutor->name) }}&background=ECFDF5&color=059669'">
                    </div>
                    <h1 class="profile-name">{{ $tutor->name }}</h1>
                    <div class="profile-email"><i class="fa-regular fa-envelope"></i> {{ $tutor->email }}</div>
                    <div class="profile-subject"><i class="fa-solid fa-book"></i> {{ $tutor->subject }}</div>
                </div>

                <!-- Profile Body -->
                <div class="profile-body">
                    <div class="row-grid">
                        
                        <!-- Left Column -->
                        <div>
                            <div class="info-section">
                                <h3 class="info-title"><i class="fa-solid fa-user"></i> About Instructor</h3>
                                <p style="color: #475569; line-height: 1.8; font-size: 0.95rem; margin: 0;">
                                    {{ $tutor->bio ?? 'Senior lecturer specialized in ' . $tutor->subject . ' with ' . $tutor->experience . ' years of teaching experience.' }}
                                </p>
                            </div>

                            <div class="info-section">
                                <h3 class="info-title"><i class="fa-solid fa-graduation-cap"></i> Qualifications & Details</h3>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">Qualification</div>
                                        <div class="info-value">{{ $tutor->qualification ?? 'Master Degree' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Experience</div>
                                        <div class="info-value">{{ $tutor->experience ?? 5 }}+ Years</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Location / Mode</div>
                                        <div class="info-value">{{ $tutor->location ?? 'Islamabad' }} / Online</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Verification Status</div>
                                        <div class="info-value" style="color:#059669;">✓ 100% Background Verified</div>
                                    </div>
                                </div>
                            </div>

                            <div class="info-section">
                                <h3 class="info-title"><i class="fa-solid fa-star"></i> Ratings & Feedback</h3>
                                <div class="rating-section mb-4">
                                    <div class="rating-number">{{ number_format($avgRating, 1) }}</div>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            {{ $i <= round($avgRating) ? '★' : '☆' }}
                                        @endfor
                                    </div>
                                    <div style="color: #64748B; font-size: 0.85rem;">Based on {{ $feedback->count() }} Verified Student {{ Str::plural('Review', $feedback->count()) }}</div>
                                </div>

                                <!-- Reviews List -->
                                <div class="mb-4">
                                    @forelse($feedback as $fb)
                                        <div class="review-card">
                                            <div class="review-header">
                                                <span class="reviewer-name">{{ $fb->student->name ?? 'Verified Student' }}</span>
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
                                        <div style="background: #F8FAFC; padding: 25px; text-align: center; border-radius: 14px; border: 1px dashed #CBD5E1; color: #94A3B8;">
                                            No reviews yet. Be the first student to review this instructor!
                                        </div>
                                    @endforelse
                                </div>

                                <!-- Quick Review Submit Form -->
                                <div style="background:#F8FAFC; border-radius:16px; padding:18px; border:1px solid #E2E8F0;">
                                    <h5 style="font-weight:700; font-size:0.95rem; color:#111827; margin-bottom:10px;"><i class="fa-solid fa-pen-to-square text-success"></i> Rate & Review this Instructor</h5>
                                    <form action="/student/post-feedback" method="POST">
                                        @csrf
                                        <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">
                                        <div class="mb-2">
                                            <div id="starPicker" style="font-size:1.5rem; color:#F59E0B; cursor:pointer; user-select:none;">
                                                <span onclick="setRating(1)">★</span>
                                                <span onclick="setRating(2)">★</span>
                                                <span onclick="setRating(3)">★</span>
                                                <span onclick="setRating(4)">★</span>
                                                <span onclick="setRating(5)">★</span>
                                            </div>
                                            <input type="hidden" name="rating" id="ratingValue" value="5">
                                        </div>
                                        <div class="mb-2">
                                            <textarea name="comment" class="form-control form-control-sm" rows="2" placeholder="Write your experience with this instructor..." style="border-radius:8px;" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-bold">
                                            <i class="fa-solid fa-paper-plane me-1"></i> Post Verified Review
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Pricing & Booking -->
                        <div>
                            <div class="pricing-card">
                                <h3 class="info-title" style="border: none; padding: 0; justify-content: center;"><i class="fa-solid fa-tag"></i> Session Pricing</h3>
                                <div class="price-amount">Rs {{ number_format($tutor->hourly_rate ?? 1500) }}</div>
                                <div class="price-unit">per hourly 1-on-1 session</div>
                                
                               <!-- Request & Booking Flow -->
<div style="background: white; border-radius: 14px; padding: 18px; border: 1px solid #E2E8F0; margin-bottom: 20px; text-align: left;">

    @if(!$existingRequest)
        {{-- Step 1: Koi request nahi bheji abhi tak --}}
        <form action="/student/send-request" method="POST">
            @csrf
            <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">
            <button type="submit" class="btn-book-session w-100" style="background: linear-gradient(135deg, #059669 0%, #10B981 100%);">
                <i class="fa-solid fa-paper-plane me-1"></i> Send Request
            </button>
        </form>

    @elseif($existingRequest->status === 'pending')
        {{-- Step 2: Request bhej di, tutor ka wait --}}
        <button class="btn-book-session w-100" style="background:#94A3B8; cursor:not-allowed;" disabled>
            <i class="fa-solid fa-clock me-1"></i> Request Sent - Waiting for Approval
        </button>

    @elseif($existingRequest->status === 'accepted')
        {{-- Step 3: Accept ho gayi - ab Book Session aur Chat dikhao --}}
        <a href="{{ url('/student/book-session-only/' . $tutor->id) }}" class="btn-book-session w-100" style="text-decoration:none; display:block; text-align:center; background: linear-gradient(135deg, #059669 0%, #10B981 100%);">
            <i class="fa-solid fa-calendar-check me-1"></i> Book Session
        </a>

    @elseif($existingRequest->status === 'rejected')
        {{-- Request reject ho gayi --}}
        <div style="color:#DC2626; text-align:center; font-weight:600; padding: 10px 0;">
            Request declined by tutor.
        </div>
        <form action="/student/send-request" method="POST" class="mt-2">
            @csrf
            <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">
            <button type="submit" class="btn-book-session w-100" style="background: linear-gradient(135deg, #059669 0%, #10B981 100%);">
                Send Request Again
            </button>
        </form>
    @endif

</div>

@if($existingRequest && $existingRequest->status === 'accepted')
<div class="btn-action-group">
    <a href="{{ url('/student/chat-only/' . $tutor->id) }}" class="btn-chat">
        <i class="fa-solid fa-comments"></i> Direct In-App Chat
    </a>
</div>
@endif
                                
                                @if(session('success'))
                                    <div class="alert alert-success mt-3 text-start">{{ session('success') }}</div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger mt-3 text-start">{{ session('error') }}</div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setRating(val) {
        document.getElementById('ratingValue').value = val;
        const spans = document.querySelectorAll('#starPicker span');
        spans.forEach((span, idx) => {
            span.innerText = (idx < val) ? '★' : '☆';
        });
    }
</script>
@endsection