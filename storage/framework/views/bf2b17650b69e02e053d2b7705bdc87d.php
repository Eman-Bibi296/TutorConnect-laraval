<?php $__env->startSection('title', 'Reviews & Feedback - TutorConnect'); ?>

<?php $__env->startSection('content'); ?>
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

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: white;
        border-radius: 18px;
        padding: 22px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid #E2E8F0;
        transition: all 0.25s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        border-color: #10B981;
    }
    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: #059669;
        margin-bottom: 4px;
    }
    .stat-label {
        color: #64748B;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .data-card {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid #E2E8F0;
        margin-bottom: 28px;
    }
    .data-card h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .my-review-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 22px;
        margin-bottom: 16px;
    }
    .my-review-stars {
        color: #F59E0B;
        font-size: 1.4rem;
        letter-spacing: 2px;
        margin-bottom: 10px;
    }
    .my-review-text {
        color: #334155;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 16px;
        font-style: italic;
    }

    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: 700;
        margin-bottom: 8px;
        color: #111827;
        font-size: 0.9rem;
    }
    .form-group select, .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #CBD5E1;
        border-radius: 12px;
        font-size: 0.95rem;
        outline: none;
        transition: all 0.2s ease;
        font-family: inherit;
        background: white;
    }
    .form-group select:focus, .form-group textarea:focus {
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }

    .rating-select {
        display: inline-flex;
        gap: 6px;
        font-size: 2rem;
        color: #F59E0B;
        cursor: pointer;
        user-select: none;
        margin-bottom: 12px;
    }

    .submit-feedback {
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.92rem;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.25);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .submit-feedback:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(5, 150, 105, 0.35);
    }

    @media (max-width: 900px) {
        .reviews-wrapper {
            flex-direction: column;
        }
    }
</style>

<?php
    use App\Models\Feedback;
    use App\Models\Tutor;
    use App\Models\Booking;
    use Illuminate\Support\Facades\Session;

    $studentId = Session::get('student_id');
    
    $reviews = collect([]);
    $avgRatingGiven = 5.0;
    $eligibleTutors = collect([]);

    if ($studentId) {
        try {
            $reviews = Feedback::where('student_id', $studentId)->with('tutor')->orderBy('created_at', 'desc')->get();
            $avgRatingGiven = $reviews->count() > 0 ? $reviews->avg('rating') : 5.0;

            // Tutors student had confirmed/completed sessions with
            $bookedTutorIds = Booking::where('student_id', $studentId)
                ->whereIn('status', ['confirmed', 'completed'])
                ->pluck('tutor_id')
                ->unique()
                ->toArray();

            $eligibleTutors = Tutor::whereIn('id', $bookedTutorIds)->get();
            if($eligibleTutors->isEmpty()) {
                $eligibleTutors = Tutor::where('is_verified', true)->get();
            }
        } catch (\Throwable $e) {
            $reviews = collect([]);
            $eligibleTutors = collect([]);
        }
    }
?>

<div class="reviews-container">
    <div class="reviews-wrapper">
        <!-- Student Sidebar -->
        <?php echo $__env->make('student.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1><i class="fa-solid fa-star"></i> Reviews & Feedback</h1>
                <p>Track reviews given to tutors and evaluate your recent learning sessions</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number"><?php echo e(number_format($avgRatingGiven, 1)); ?></div>
                    <div class="stat-label">Avg. Rating / 5.0</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #059669;"><?php echo e($reviews->count()); ?></div>
                    <div class="stat-label">Total Reviews Given</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #D97706;"><?php echo e($reviews->pluck('tutor_id')->unique()->count()); ?></div>
                    <div class="stat-label">Instructors Reviewed</div>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success rounded-4 mb-4 border-0 shadow-sm">
                    <i class="fa-solid fa-circle-check me-2"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger rounded-4 mb-4 border-0 shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <!-- My Submitted Reviews -->
            <div class="data-card">
                <h3><i class="fa-solid fa-award" style="color:#F59E0B;"></i> My Submitted Reviews</h3>
                <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="my-review-box">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="m-0 fw-bold text-dark"><?php echo e($rev->tutor->name ?? 'Instructor'); ?></h5>
                                <small class="text-muted"><?php echo e($rev->tutor->subject ?? ''); ?> • <?php echo e($rev->created_at->format('M d, Y')); ?></small>
                            </div>
                            <form action="/student/review/delete/<?php echo e($rev->id); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa-solid fa-trash-can me-1"></i> Delete Review
                                </button>
                            </form>
                        </div>
                        <div class="my-review-stars">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php echo e($i <= $rev->rating ? '★' : '☆'); ?>

                            <?php endfor; ?>
                        </div>
                        <div class="my-review-text">"<?php echo e($rev->comment); ?>"</div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-4 text-muted">
                        <i class="fa-regular fa-comment-dots fs-1 mb-2 text-secondary"></i>
                        <p class="mb-0">You haven't submitted any tutor reviews yet.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Submit New Review -->
            <div class="data-card">
                <h3><i class="fa-solid fa-pen-to-square" style="color:var(--primary);"></i> Leave Feedback for an Instructor</h3>
                <form action="/student/post-feedback" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label>Select Faculty Member / Tutor</label>
                        <select name="tutor_id" class="form-select" required>
                            <?php $__currentLoopData = $eligibleTutors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tutor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tutor->id); ?>"><?php echo e($tutor->name); ?> (<?php echo e($tutor->subject); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Rating (Click to Rate)</label>
                        <div class="rating-select" id="revStars">
                            <span onclick="setRevStar(1)">★</span>
                            <span onclick="setRevStar(2)">★</span>
                            <span onclick="setRevStar(3)">★</span>
                            <span onclick="setRevStar(4)">★</span>
                            <span onclick="setRevStar(5)">★</span>
                        </div>
                        <input type="hidden" name="rating" id="reviewRatingInput" value="5">
                    </div>

                    <div class="form-group mb-4">
                        <label>Your Feedback & Experience</label>
                        <textarea name="comment" rows="4" placeholder="Share specific details about teaching style, punctuality, and concept clarity..." required></textarea>
                    </div>

                    <button type="submit" class="submit-feedback">
                        <i class="fa-solid fa-paper-plane"></i> Submit Feedback
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setRevStar(num) {
        document.getElementById('reviewRatingInput').value = num;
        const spans = document.querySelectorAll('#revStars span');
        spans.forEach((span, idx) => {
            span.innerText = (idx < num) ? '★' : '☆';
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/student/reviews.blade.php ENDPATH**/ ?>