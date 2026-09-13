<?php $__env->startSection('title', 'Home - Expert Learning Platform'); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(180deg, #F8FAFC 0%, #FFFFFF 100%);
        padding: 70px 5% 50px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ECFDF5;
        color: #059669;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 6px 16px;
        border-radius: 30px;
        margin-bottom: 20px;
        border: 1px solid rgba(16, 185, 129, 0.25);
    }

    .hero-section h1 {
        font-size: 3.2rem;
        font-weight: 800;
        color: #111827;
        margin-bottom: 18px;
        line-height: 1.2;
    }

    .hero-section h1 span {
        color: #059669;
    }

    .hero-section p {
        font-size: 1.1rem;
        color: #4B5563;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .hero-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .btn-find {
        background: #059669;
        color: white;
        padding: 13px 32px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);
    }

    .btn-find:hover {
        background: #047857;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(5, 150, 105, 0.4);
        color: white;
    }
    
    .btn-become {
        background: white;
        color: #059669;
        padding: 13px 32px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        border: 2px solid #059669;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-become:hover {
        background: #059669;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(5, 150, 105, 0.2);
    }
    
    .hero-image {
        width: 100%;
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        transition: transform 0.4s ease;
    }

    .hero-image:hover {
        transform: scale(1.02);
    }

    /* Stats Bar */
    .stats-bar {
        background: white;
        border-top: 1px solid #E5E7EB;
        border-bottom: 1px solid #E5E7EB;
        padding: 30px 5%;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #111827;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6B7280;
        font-weight: 500;
    }

    /* Features Section */
    .features-section {
        background: #F9FAFB;
        padding: 70px 5%;
    }

    .section-header {
        text-align: center;
        max-width: 650px;
        margin: 0 auto 50px;
    }

    .section-header h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 12px;
    }

    .section-header p {
        color: #6B7280;
        font-size: 1rem;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 25px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 32px 25px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.04);
    }

    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 28px rgba(0,0,0,0.08);
        border-color: rgba(5, 150, 105, 0.3);
    }

    .feature-icon {
        font-size: 2.2rem;
        width: 65px;
        height: 65px;
        line-height: 65px;
        border-radius: 50%;
        background: #ECFDF5;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .feature-card h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 10px;
    }

    .feature-card p {
        font-size: 0.9rem;
        color: #6B7280;
        line-height: 1.5;
        margin: 0;
    }

    /* How it works */
    .how-it-works-section {
        background: white;
        padding: 80px 5%;
    }

    .user-flow-title {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 1.35rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 25px;
        padding-bottom: 8px;
        border-bottom: 3px solid #059669;
    }

    .steps-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 50px;
    }

    .step-card {
        background: #F9FAFB;
        border-radius: 18px;
        padding: 25px 20px;
        border: 1px solid #E5E7EB;
        transition: all 0.3s ease;
    }

    .step-card:hover {
        background: #FFFFFF;
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        border-color: #059669;
    }

    .step-number {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #059669;
        color: white;
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
    }

    .step-number.tutor-step {
        background: #3B82F6;
    }

    .step-card h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .step-card p {
        font-size: 0.88rem;
        color: #6B7280;
        line-height: 1.5;
        margin: 0;
    }

    /* CTA Banner */
    .cta-banner {
        background: linear-gradient(135deg, #111827 0%, #1e293b 100%);
        border-radius: 24px;
        padding: 55px 30px;
        color: white;
        text-align: center;
        margin: 20px auto 0;
        max-width: 1100px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
    }

    .cta-banner h3 {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 12px;
        color: #ffffff;
    }

    .cta-banner p {
        color: #E2E8F0;
        font-size: 1.1rem;
        margin-bottom: 30px;
    }

    .btn-cta-student {
        background: #059669;
        color: #ffffff !important;
        padding: 14px 34px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(5, 150, 105, 0.4);
    }

    .btn-cta-student:hover {
        background: #047857;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(5, 150, 105, 0.55);
        color: #ffffff !important;
    }

    .btn-cta-tutor {
        background: #ffffff;
        color: #065f46 !important;
        padding: 14px 34px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1rem;
        border: 2px solid #ffffff;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .btn-cta-tutor:hover {
        background: #F0FDF4;
        color: #047857 !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 40px 5% 30px;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 2.2rem;
        }
        .hero-buttons {
            justify-content: center;
            margin-bottom: 30px;
        }
        .section-header h2 {
            font-size: 1.8rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container animate-fade-in-up">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="hero-badge">
                    <i class="fas fa-graduation-cap"></i> Easy &amp; Trusted Tutoring Platform
                </div>
                <h1>Search Easy &amp; <span>Expert Tutors</span></h1>
                <p>Students can easily search for verified tutors in their required subjects, view detailed profiles, message directly, and book learning sessions.</p>
                <div class="hero-buttons">
                    <a href="#find-tutors" class="btn-find"><i class="fas fa-search"></i> Find a Tutor</a>
                    <a href="/tutor/register" class="btn-become"><i class="fas fa-chalkboard-teacher"></i> Become a Tutor</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="<?php echo e(asset('images/hero_banner.jpg')); ?>" alt="Expert Tutoring Platform" class="hero-image">
            </div>
        </div>
    </div>
</section>


 <?php
     $realStudentCount = \App\Models\Student::count();
    $realTutorCount = \App\Models\Tutor::where('is_verified', true)->count();
    $realSubjectCount = \App\Models\Tutor::where('is_verified', true)->distinct('subject')->count('subject');
     $realAvgRating = \App\Models\Feedback::avg('rating');
 ?>

<!-- Quick Stats Bar -->
<section class="stats-bar">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3 stat-item"><div class="stat-number"><?php echo e($realStudentCount); ?></div><div class="stat-label">Active Students</div></div>
            <div class="col-6 col-md-3 stat-item"><div class="stat-number"><?php echo e($realTutorCount); ?></div><div class="stat-label">Verified Tutors</div></div>
             <div class="col-6 col-md-3 stat-item"><div class="stat-number"><?php echo e($realSubjectCount); ?></div><div class="stat-label">Subjects Covered</div></div>
            <div class="col-6 col-md-3 stat-item"><div class="stat-number"><?php echo e($realAvgRating ? number_format($realAvgRating, 1) : '5.0'); ?>/5</div><div class="stat-label">Student Rating</div></div>
        </div>
    </div>
</section>

<!-- Find Tutor Search Section -->

<?php
    if (!isset($featuredTutors)) {
        try {
            $featuredTutors = \App\Models\Tutor::where('is_verified', true)
                ->orderByDesc('id')
                ->take(3)
                ->get();
        } catch (\Throwable $e) {
            $featuredTutors = collect([]);
        }
    }
?>
<section id="find-tutors" class="find-tutor-section" style="background: #F8FAFC; padding: 75px 5%; scroll-margin-top: 70px;">
    <div class="container">
        <div class="section-header" style="text-align: center; max-width: 700px; margin: 0 auto 35px;">
            <div class="hero-badge" style="margin-bottom: 12px;">
                <i class="fas fa-search"></i> Featured Instructors
            </div>
            <h2 style="font-size: 2.3rem; font-weight: 800; color: #111827; margin-bottom: 10px;">Meet Our Top <span style="color: #059669;">Tutors</span></h2>
            <p style="color: #64748B; font-size: 1rem;">A glimpse of our verified instructors. Sign up to explore the full directory, filter by subject, and book sessions.</p>
        </div>

        <!-- Featured Tutors Cards Grid (Static Preview - No Search) -->
        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $featuredTutors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tutor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $avatarUrl = $tutor->profile_picture ? asset($tutor->profile_picture) : asset('images/burhan.png');
                ?>
                <div class="col-lg-4 col-md-6">
                    <div style="background: white; border-radius: 20px; padding: 25px; border: 1px solid #E2E8F0; box-shadow: 0 4px 15px rgba(0,0,0,0.03); height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <img src="<?php echo e($avatarUrl); ?>" alt="<?php echo e($tutor->name); ?>" style="width: 62px; height: 62px; border-radius: 50%; object-fit: cover; border: 2.5px solid #10B981; flex-shrink: 0;" onerror="this.src='<?php echo e(asset('images/burhan.png')); ?>'">
                                <div>
                                    <h4 style="font-size: 1.15rem; font-weight: 800; color: #111827; margin: 0;"><?php echo e($tutor->name); ?></h4>
                                    <span style="display: inline-block; background: #ECFDF5; color: #059669; font-size: 0.75rem; font-weight: 700; padding: 2px 8px; border-radius: 10px; margin-top: 2px;">✓ Verified Expert</span>
                                </div>
                            </div>
                            <p style="font-size: 0.88rem; color: #475569; margin-bottom: 6px;"><strong>Subject:</strong> <?php echo e($tutor->subject); ?></p>
                            <p style="font-size: 0.82rem; color: #64748B; margin-bottom: 12px; line-height: 1.5;"><?php echo e(Str::limit($tutor->bio ?? ($tutor->qualification . ' with proven subject expertise.'), 95)); ?></p>
                            <div style="display: flex; justify-content: space-between; background: #F8FAFC; padding: 10px 14px; border-radius: 12px; margin-bottom: 18px; font-size: 0.85rem; border: 1px solid #F1F5F9;">
                                <span>⭐ <strong>4.9</strong> (Verified)</span>
                                <span style="color: #059669; font-weight: 800;">Rs <?php echo e(number_format($tutor->hourly_rate ?? 1500)); ?>/hr</span>
                            </div>
                        </div>
                        <a href="/student/register" class="btn w-100" style="background: linear-gradient(135deg, #059669 0%, #10B981 100%); color: white; border-radius: 10px; font-weight: 700; font-size: 0.88rem; padding: 10px;">
                            <i class="fas fa-user-plus me-1"></i> Sign Up to Book
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center" style="color: #94A3B8; padding: 30px;">Tutors coming soon.</div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="/student/register" class="btn-find" style="text-decoration:none;">
                <i class="fas fa-arrow-right"></i> Explore Full Directory
            </a>
        </div>
    </div>
</section>





<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-header">
            <h2>Why Choose TutorConnect?</h2>
            <p>Our platform provides a seamless, simple experience for both learners and educators.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card"><div class="feature-icon">🔍</div><h3>Easy Search</h3><p>Filter tutors by subject, city, experience, and hourly rates.</p></div>
            <div class="feature-card"><div class="feature-icon">✅</div><h3>Verified Tutors</h3><p>Every tutor profile and credential is verified by admin.</p></div>
            <div class="feature-card"><div class="feature-icon">💬</div><h3>Direct Messaging</h3><p>Chat directly with tutors to discuss syllabus and schedules.</p></div>
            <div class="feature-card"><div class="feature-icon">⭐</div><h3>Ratings &amp; Reviews</h3><p>Read real student feedback before booking your sessions.</p></div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works-section">
    <div class="container">
        <div class="section-header">
            <h2>How It Works</h2>
            <p>Simple and straightforward steps to start your journey with TutorConnect.</p>
        </div>

        <!-- Steps for Students -->
        <div class="mb-5">
            <div class="user-flow-title">
                <i class="fas fa-user-graduate text-success"></i> For Students
            </div>
            <div class="steps-grid">
                <div class="step-card"><div class="step-number">1</div><h4>Create Account</h4><p>Sign up as a student with your basic details and log into your dashboard.</p></div>
                <div class="step-card"><div class="step-number">2</div><h4>Search Tutors</h4><p>Explore tutors filtered by your subject and check their qualifications.</p></div>
                <div class="step-card"><div class="step-number">3</div><h4>Book or Message</h4><p>Send a session booking request or message the tutor directly.</p></div>
                <div class="step-card"><div class="step-number">4</div><h4>Rating &amp; Review</h4><p>Attend sessions, download study materials, and leave feedback.</p></div>
            </div>
        </div>

        <!-- Steps for Tutors -->
        <div>
            <div class="user-flow-title" style="border-color: #3B82F6;">
                <i class="fas fa-chalkboard-teacher" style="color: #3B82F6;"></i> For Tutors
            </div>
            <div class="steps-grid">
                <div class="step-card"><div class="step-number tutor-step">1</div><h4>Register Profile</h4><p>Sign up as a tutor and add your qualifications, subjects, and bio.</p></div>
                <div class="step-card"><div class="step-number tutor-step">2</div><h4>Admin Approval</h4><p>Your profile gets verified by the administrator for safety &amp; trust.</p></div>
                <div class="step-card"><div class="step-number tutor-step">3</div><h4>Manage Bookings</h4><p>Accept booking requests and respond to student inquiries.</p></div>
                <div class="step-card"><div class="step-number tutor-step">4</div><h4>Share Study material</h4><p>Upload study notes, conduct sessions, and build your reputation.</p></div>
            </div>
        </div>

        <!-- CTA Banner with Direct Registration Links -->
        <div class="cta-banner">
            <h3>Ready to Boost Your Grades?</h3>
            <p>Join hundreds of students finding the right guidance today.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="/student/register" class="btn-cta-student"><i class="fas fa-user-graduate"></i> Get Started as Student</a>
                <a href="/tutor/register" class="btn-cta-tutor"><i class="fas fa-chalkboard-teacher"></i> Become a Tutor</a>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/home.blade.php ENDPATH**/ ?>