@extends('layouts.app')

@section('title', 'Reviews & Feedback')

@section('content')
<style>
    /* ===== ALL YOUR EXISTING STYLES (SAME) ===== */
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
    
    /* Sidebar Styles */
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
    
    .my-reviews-heading {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 25px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #4a6cf7;
    }
    
    .stat-label {
        color: #666;
        font-size: 0.8rem;
        margin-top: 5px;
    }
    
    .my-review-card {
        background: #ffe4e1;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .my-review-card h3 {
        margin: 0 0 15px;
        font-size: 1.2rem;
        color: #1a1a2e;
    }
    
    .my-review-box {
        background: rgba(255,255,255,0.6);
        border-radius: 15px;
        padding: 20px;
    }
    
    .my-review-stars {
        color: #ffc107;
        font-size: 1.2rem;
        margin-bottom: 10px;
    }
    
    .my-review-text {
        color: #555;
        font-size: 0.9rem;
        line-height: 1.4;
        margin-bottom: 15px;
    }
    
    .btn-delete {
        background: #ff6b6b;
        color: white;
        border: none;
        padding: 6px 18px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.8rem;
    }
    
    .btn-delete:hover {
        background: #e55a5a;
    }
    
    .give-feedback {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .give-feedback h3 {
        margin: 0 0 20px;
        font-size: 1.2rem;
        color: #1a1a2e;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }
    
    .form-group select, .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 0.95rem;
    }
    
    .form-group select:focus, .form-group textarea:focus {
        border-color: #4a6cf7;
        outline: none;
    }
    
    .rating-select {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }
    
    .rating-star {
        font-size: 2rem;
        cursor: pointer;
        color: #ddd;
        transition: color 0.2s;
    }
    
    .rating-star:hover, .rating-star.selected {
        color: #ffc107;
    }
    
    .submit-feedback {
        background: #ff69b4;
        color: white;
        border: none;
        padding: 8px 25px;
        border-radius: 20px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s;
        width: auto;
        display: inline-block;
    }
    
    .submit-feedback:hover {
        background: #ff1493;
        transform: translateY(-2px);
    }
    
    .alert {
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
    }
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
    }

    /* ===== ⭐ TOAST NOTIFICATION (NEW) ===== */
    .toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #28a745;
        color: white;
        padding: 16px 30px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        font-weight: 600;
        font-size: 0.95rem;
        display: none;
        align-items: center;
        gap: 12px;
        animation: slideUp 0.4s ease;
        max-width: 400px;
    }

    .toast.error {
        background: #dc3545;
    }

    .toast.success {
        background: #28a745;
    }

    @keyframes slideUp {
        0% {
            transform: translateY(100px);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .toast-close {
        background: transparent;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 0 5px;
        opacity: 0.7;
    }

    .toast-close:hover {
        opacity: 1;
    }
</style>

<div class="reviews-container">
    <div class="reviews-wrapper">
        
        @include('student.partials.sidebar')
        
        <div class="main-content">
            
            <h2 class="my-reviews-heading">📝 My Reviews</h2>
            
            @php
                use Illuminate\Support\Facades\DB;
                $studentId = Session::get('student_id');
                
                // Get user's own review
                $myReview = \App\Models\Feedback::where('student_id', $studentId)->first();
                
                // Get related tutor IDs
                $acceptedTutorIds = DB::table('requests')
                    ->where('student_id', $studentId)
                    ->where('status', 'accepted')
                    ->pluck('tutor_id')
                    ->toArray();
                
                $chattedTutorIds = DB::table('messages')
                    ->where(function($q) use ($studentId) {
                        $q->where('sender_id', $studentId)->where('sender_type', 'student')
                          ->orWhere('receiver_id', $studentId)->where('receiver_type', 'student');
                    })
                    ->select(DB::raw('CASE 
                        WHEN sender_type = "tutor" THEN sender_id 
                        ELSE receiver_id 
                    END as tutor_id'))
                    ->distinct()
                    ->pluck('tutor_id')
                    ->toArray();
                
                $relatedTutorIds = array_unique(array_merge($acceptedTutorIds, $chattedTutorIds));
                
                // Filter reviews - only related tutors
                $filteredReviews = $reviews->filter(function($review) use ($relatedTutorIds) {
                    return in_array($review->tutor_id, $relatedTutorIds);
                });
                
                // ========== DYNAMIC STATS (SAHI) ==========
                $avgRating = $filteredReviews->avg('rating') ?? 0;
                $totalReviews = $filteredReviews->count();
                // =========================================
                
                // Eligible tutors
                $eligibleTutors = DB::table('requests')
                    ->join('tutors', 'requests.tutor_id', '=', 'tutors.id')
                    ->where('requests.student_id', $studentId)
                    ->where('requests.status', 'accepted')
                    ->whereNotIn('tutors.id', function($query) use ($studentId) {
                        $query->select('tutor_id')
                              ->from('feedback')
                              ->where('student_id', $studentId);
                    })
                    ->whereExists(function($query) use ($studentId) {
                        $query->select(DB::raw(1))
                              ->from('messages')
                              ->whereRaw('(messages.sender_id = requests.student_id AND messages.receiver_id = requests.tutor_id)')
                              ->orWhereRaw('(messages.sender_id = requests.tutor_id AND messages.receiver_id = requests.student_id)');
                    })
                    ->select('tutors.id', 'tutors.name', 'tutors.subject')
                    ->get();
            @endphp
            
            <!-- Stats - DYNAMIC -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($avgRating, 1) }}</div>
                    <div class="stat-label">Avg. Rating / 5.0</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $totalReviews }}</div>
                    <div class="stat-label">TOTAL REVIEWS</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $eligibleTutors->count() }}</div>
                    <div class="stat-label">TUTORS TO REVIEW</div>
                </div>
            </div>
            
            <!-- MY REVIEW -->
            @if($myReview)
            <div class="my-review-card">
                <h3>⭐ My Review</h3>
                <div class="my-review-box">
                    <div class="my-review-stars">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= $myReview->rating ? '★' : '☆' }}
                        @endfor
                    </div>
                    <div class="my-review-text">"{{ $myReview->comment }}"</div>
                    <div>
                        <!-- ⭐ DELETE FORM - BINA CONFIRM POPUP KE -->
                        <form action="/student/review/delete/{{ $myReview->id }}" method="POST" style="display: inline;" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" id="deleteBtn">
                                🗑️ Delete Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- GIVE FEEDBACK -->
            @if(!$myReview)
            <div class="give-feedback">
                <h3>✍️ Give Feedback to a Tutor</h3>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
                @if($eligibleTutors->count() > 0)
                <form action="/student/post-feedback" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Select Tutor</label>
                        <select name="tutor_id" required>
                            <option value="">-- Select Tutor --</option>
                            @foreach($eligibleTutors as $tutor)
                                <option value="{{ $tutor->id }}">{{ $tutor->name }} ({{ $tutor->subject }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Your Rating</label>
                        <div class="rating-select">
                            <span class="rating-star" data-rating="1">☆</span>
                            <span class="rating-star" data-rating="2">☆</span>
                            <span class="rating-star" data-rating="3">☆</span>
                            <span class="rating-star" data-rating="4">☆</span>
                            <span class="rating-star" data-rating="5">☆</span>
                        </div>
                        <input type="hidden" name="rating" id="ratingValue" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Your Review / Feedback</label>
                        <textarea name="comment" rows="4" placeholder="Share your experience with the tutor..." required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-feedback">Submit Feedback →</button>
                </form>
                @else
                <div style="text-align:center; padding:30px; background:#f8f9fc; border-radius:15px;">
                    <p style="color:#666;">📭 No tutors available to review right now.</p>
                    <p style="color:#999; font-size:0.8rem;">Once you chat with a tutor, they will appear here for feedback.</p>
                </div>
                @endif
            </div>
            @endif
            
        </div>
    </div>
</div>

<!-- ===== ⭐ TOAST NOTIFICATION HTML ===== -->
<div id="toast" class="toast">
    <span id="toastMessage">✅ Review deleted successfully!</span>
    <button class="toast-close" onclick="hideToast()">✕</button>
</div>

<script>
    // ===== STAR RATING (Already exists) =====
    const stars = document.querySelectorAll('.rating-star');
    let selectedRating = 0;
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            selectedRating = this.getAttribute('data-rating');
            document.getElementById('ratingValue').value = selectedRating;
            
            stars.forEach((s, index) => {
                if (index < selectedRating) {
                    s.innerHTML = '★';
                    s.classList.add('selected');
                } else {
                    s.innerHTML = '☆';
                    s.classList.remove('selected');
                }
            });
        });
        
        star.addEventListener('mouseenter', function() {
            const hoverRating = this.getAttribute('data-rating');
            stars.forEach((s, index) => {
                if (index < hoverRating) {
                    s.innerHTML = '★';
                } else {
                    s.innerHTML = '☆';
                }
            });
        });
        
        star.addEventListener('mouseleave', function() {
            stars.forEach((s, index) => {
                if (index < selectedRating) {
                    s.innerHTML = '★';
                } else {
                    s.innerHTML = '☆';
                }
            });
        });
    });

    // ===== ⭐ TOAST FUNCTIONS (NEW) =====
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');
        
        toastMessage.textContent = message;
        toast.className = 'toast ' + type;
        toast.style.display = 'flex';
        
        setTimeout(function() {
            hideToast();
        }, 3000);
    }
    
    function hideToast() {
        const toast = document.getElementById('toast');
        toast.style.display = 'none';
    }
    
    // ===== ⭐ DELETE BUTTON - TOAST DIKHAO (NEW) =====
    document.getElementById('deleteBtn')?.addEventListener('click', function(e) {
        showToast('🗑️ Review deleted successfully!', 'success');
        // Form submit ho jayega, page refresh ho jayega
    });
</script>
@endsection