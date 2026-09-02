@extends('layouts.app')

@section('title', 'Reviews & Ratings - Tutor Portal - TutorConnect')

@section('content')
<style>
    .reviews-container {
        padding: 35px 5%;
        background: #F8FAFC;
        min-height: calc(100vh - 180px);
        font-family: 'Poppins', sans-serif;
    }
    .reviews-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    .main-content {
        flex: 1;
        min-width: 0;
    }
    
    .page-header {
        background: linear-gradient(135deg, #111827 0%, #1e293b 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: white;
        margin-bottom: 28px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .page-header h1 {
        font-size: 1.6rem;
        font-weight: 800;
        margin: 0;
    }
    .page-header p {
        color: #94A3B8;
        margin: 8px 0 0;
        font-size: 0.95rem;
    }

    .rating-summary-card {
        background: white;
        border-radius: 20px;
        padding: 32px 24px;
        text-align: center;
        margin-bottom: 28px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid #E2E8F0;
    }
    .rating-number {
        font-size: 3.5rem;
        font-weight: 800;
        color: #059669;
        line-height: 1;
    }
    .rating-stars {
        color: #F59E0B;
        font-size: 1.6rem;
        margin: 12px 0 6px;
        letter-spacing: 3px;
    }
    .rating-meta {
        color: #64748B;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .reviews-list-card {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid #E2E8F0;
    }
    .reviews-list-card h3 {
        margin: 0 0 20px;
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .review-item {
        background: #F8FAFC;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #E2E8F0;
        margin-bottom: 16px;
        transition: all 0.2s;
    }
    .review-item:hover {
        background: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }
    .review-item:last-child {
        margin-bottom: 0;
    }
    
    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        flex-wrap: wrap;
    }
    .review-student {
        font-weight: 700;
        color: #111827;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .review-student-img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #10B981;
    }
    .review-date {
        font-size: 0.8rem;
        color: #64748B;
    }
    .review-stars {
        color: #F59E0B;
        font-size: 1.1rem;
        margin-bottom: 8px;
    }
    .review-comment {
        color: #334155;
        font-size: 0.92rem;
        line-height: 1.6;
        font-style: italic;
    }

    @media (max-width: 900px) {
        .reviews-wrapper {
            flex-direction: column;
        }
    }
</style>

@php
    $reviewsList = $reviews ?? collect();
    $avgVal = $reviewsList->count() > 0 ? $reviewsList->avg('rating') : 5.0;
@endphp

<div class="reviews-container">
    <div class="reviews-wrapper">
        <!-- Tutor Sidebar -->
        @include('tutor.Partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1><i class="fa-solid fa-star"></i> Reviews & Ratings</h1>
                <p>Student feedback and performance ratings received from completed sessions</p>
            </div>

            <!-- Big Rating Summary Card -->
            <div class="rating-summary-card">
                <div class="rating-number">{{ number_format($avgVal, 1) }}</div>
                <div class="rating-stars">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= round($avgVal) ? '★' : '☆' }}
                    @endfor
                </div>
                <div class="rating-meta">Overall Rating Based on {{ $reviewsList->count() }} Verified Student Review{{ $reviewsList->count() == 1 ? '' : 's' }}</div>
            </div>

            <!-- Testimonials Card -->
            <div class="reviews-list-card">
                <h3><i class="fa-regular fa-comment-dots" style="color:var(--primary);"></i> Student Testimonials</h3>
                
                @forelse($reviewsList as $rev)
                    @php
                        $studentName = $rev->student->name ?? 'Student';
                        $firstName = strtolower(explode(' ', $studentName)[0]);
                        $studentAvatar = 'images/eman.jpg';
                        if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
                            $studentAvatar = 'images/' . $firstName . '.jpg';
                        } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
                            $studentAvatar = 'images/' . $firstName . '.png';
                        }
                    @endphp
                    <div class="review-item">
                        <div class="review-header">
                            <span class="review-student">
                            
                                <div>
                                    <span>{{ $studentName }}</span>
                                    <small class="d-block text-muted" style="font-weight:400; font-size:0.75rem;">Verified Student Learner</small>
                                </div>
                            </span>
                            <span class="review-date">{{ $rev->created_at ? $rev->created_at->format('M d, Y') : 'Recently' }}</span>
                        </div>
                        <div class="review-stars">
                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= $rev->rating ? '★' : '☆' }}
                            @endfor
                            <span style="font-size:0.85rem; color:#111827; font-weight:700; margin-left:4px;">({{ number_format($rev->rating, 1) }})</span>
                        </div>
                        <div class="review-comment">
                            "{{ $rev->comment }}"
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="fa-regular fa-star fs-1 mb-2 text-secondary"></i>
                        <p class="mb-0">No student reviews received yet.</p>
                        <small>When students complete sessions and submit feedback, it will show here.</small>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection