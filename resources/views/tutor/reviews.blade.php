@extends('layouts.app')

@section('title', 'Reviews & Ratings')

@section('content')
<style>
    .reviews-container {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 30px 5%;
    }
    .reviews-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
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
    .main-content {
        flex: 1;
    }
    .page-header {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        border-radius: 20px;
        padding: 25px;
        color: white;
        margin-bottom: 30px;
    }
    .page-header h1 {
        margin: 0;
        font-size: 1.5rem;
    }
    .page-header p {
        margin: 10px 0 0;
        opacity: 0.9;
    }
    .rating-summary {
        background: #d4d19d;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .rating-number {
        font-size: 4rem;
        font-weight: 800;
        color: #4a6cf7;
    }
    .rating-stars {
        color: #ffc107;
        font-size: 2.5rem;
        margin: 10px 0;
    }
    .reviews-list {
        background: #d4d19d;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .review-card {
        border-bottom: 1px solid #eee;
        padding: 20px 0;
    }
    .review-card:last-child {
        border-bottom: none;
    }
    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }
    .review-student {
        font-weight: 700;
        color: #1a1a2e;
    }
    .review-date {
        font-size: 0.7rem;
        color: #999;
    }
    .review-stars {
        color: #ffc107;
        font-size: 0.9rem;
        margin: 8px 0;
    }
    .review-comment {
        color: #221e1e;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-top: 8px;
    }
    .no-reviews {
        text-align: center;
        padding: 50px;
        color: #999;
    }
</style>

<div class="reviews-container">
    <div class="reviews-wrapper">
        
        @include('tutor.partials.sidebar')
        
        <div class="main-content">
            <div class="page-header">
                <h1>Reviews & Ratings</h1>
                <p>See what students are saying about you</p>
            </div>
            
            <div class="rating-summary">
                <div class="rating-number">{{ number_format($avgRating ?? 0, 1) }}</div>
                <div class="rating-stars">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= ($avgRating ?? 0) ? '★' : '☆' }}
                    @endfor
                </div>
                <div style="color: #666;">Based on {{ $totalReviews ?? 0 }} reviews</div>
            </div>
            
            <div class="reviews-list">
                <h3 style="margin-top: 0; margin-bottom: 20px;">All Reviews</h3>
                
                @forelse($reviews as $review)
                <div class="review-card">
                    <div class="review-header">
                        <span class="review-student">{{ $review->student->name ?? 'Student' }}</span>
                        <span class="review-date">{{ $review->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="review-stars">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= $review->rating ? '★' : '☆' }}
                        @endfor
                    </div>
                    <div class="review-comment">"{{ $review->comment }}"</div>
                </div>
                @empty
                <div class="no-reviews">No reviews yet. Students will review you after their sessions.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection