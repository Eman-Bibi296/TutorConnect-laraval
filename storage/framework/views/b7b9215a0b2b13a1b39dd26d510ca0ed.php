

<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .hero-section {
        background: #F9FAFB;
        padding: 80px 5%;
    }
    
    .hero-section h1 {
        font-size: 3rem;
        font-weight: 800;
        color: #111827;
        margin-bottom: 20px;
    }
    
    .hero-section p {
        font-size: 1.1rem;
        color: #4B5563;
        line-height: 1.6;
        margin-bottom: 30px;
    }
    
    .hero-buttons {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .btn-find {
        background: #059669;
        color: white;
        padding: 12px 35px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-block;
    }
    
    .btn-find:hover {
        background: #047857;
        transform: translateY(-2px);
        color: white;
    }
    
    .btn-become {
        background: transparent;
        color: #059669;
        padding: 12px 35px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        border: 2px solid #059669;
        transition: all 0.3s;
        display: inline-block;
    }
    
    .btn-become:hover {
        background: #059669;
        color: white;
        transform: translateY(-2px);
    }
    
    .hero-image {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .features-section {
        background: white;
        padding: 60px 5%;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .feature-card {
        background: #F9FAFB;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .feature-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
    }
    
    .feature-card h3 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 10px;
    }
    
    .feature-card p {
        font-size: 0.9rem;
        color: #4B5563;
        line-height: 1.5;
    }
    
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2rem;
        }
        .hero-buttons {
            justify-content: center;
        }
    }
</style>

<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Search Easy Tutor</h1>
                <p>Students can easily search for tutors in their required subjects, check their profiles and connect directly with them.</p>
                <div class="hero-buttons">
                    <a href="/student/register" class="btn-find">Find a tutor</a>
                    <a href="/tutor/register" class="btn-become">Become a tutor</a>
                </div>
            </div>
            <div class="col-md-6">
                <img src="<?php echo e(asset('images/Home.jpg')); ?>" alt="Tutoring" class="hero-image">
            </div>
        </div>
    </div>
</div>

<div class="features-section">
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">🔍</div>
            <h3>Easy Search</h3>
            <p>Search tutors by subject and location</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">✅</div>
            <h3>Verified Tutors</h3>
            <p>All tutors are verified by admin</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">💬</div>
            <h3>Direct Communication</h3>
            <p>Message tutors directly</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">⭐</div>
            <h3>Rating</h3>
            <p>See tutor ratings from students</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/home.blade.php ENDPATH**/ ?>