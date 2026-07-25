

<?php $__env->startSection('title', 'About Us - TutorConnect'); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* ===== GOOGLE FONTS ===== */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap');

    * {
        font-family: 'Poppins', sans-serif;
    }

    /* ===== HERO SECTION WITH FULL BACKGROUND IMAGE ===== */
    .about-hero {
        background-image: url('<?php echo e(asset("images/about4.jpg")); ?>');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 100px 5% 80px;
        text-align: center;
        border-radius: 0 0 50px 50px;
        margin-bottom: 50px;
        position: relative;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Dark Overlay */
    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.55);
        border-radius: 0 0 50px 50px;
    }

    .about-hero * {
        position: relative;
        z-index: 1;
    }

    .about-hero h1 {
        font-size: 3.2rem;
        font-weight: 800;
        margin: 0 0 5px;
        color: white;
        letter-spacing: -1px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .about-hero h1 span {
        color: #ffd700;
    }

    .about-hero .hero-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 650px;
        margin: 0 auto 5px;
        line-height: 1.6;
        text-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
    }

    .about-hero .hero-line {
        width: 80px;
        height: 4px;
        background: #ffd700;
        margin: 12px auto;
        border-radius: 2px;
    }

    .about-hero .hero-role {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
        text-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
    }

    /* ===== CONTENT SECTION ===== */
    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 5% 60px;
    }

    .about-text h2 {
        font-size: 2rem;
        color: #1a1a2e;
        margin: 0 0 20px;
        text-align: center;
    }

    .about-text h2 span {
        color: #4a6cf7;
    }

    .about-text p {
        color: #555;
        line-height: 1.8;
        font-size: 1.05rem;
        margin-bottom: 15px;
        text-align: center;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
    }

    /* ===== SERVICES SECTION ===== */
    .services-section {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin: 50px 0;
    }

    .service-card {
        background: white;
        border-radius: 20px;
        padding: 30px 25px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #192e7a;
        transition: all 0.3s ease;
        text-align: center;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(74, 108, 247, 0.15);
        border-color: #4a6cf7;
    }

    .service-card .icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        display: block;
    }

    .service-card h4 {
        color: #1a1a2e;
        margin: 0 0 10px;
        font-size: 1.1rem;
    }

    .service-card p {
        color: #666666;
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0;
    }

    /* ===== MISSION & VISION ===== */
    .mission-vision {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin: 50px 0;
    }

    .mv-card {
        background: white;
        border-radius: 20px;
        padding: 35px 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        border-left: 5px solid #4a6cf7;
        transition: all 0.3s ease;
    }

    .mv-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transform: translateY(-3px);
    }

    .mv-card.vision {
        border-left-color: #ffd700;
    }

    .mv-card .icon {
        font-size: 2rem;
        margin-bottom: 10px;
        display: block;
    }

    .mv-card h3 {
        color: #1a1a2e;
        margin: 0 0 10px;
        font-size: 1.3rem;
    }

    .mv-card p {
        color: #555;
        line-height: 1.7;
        font-size: 0.95rem;
        margin: 0;
    }

    /* ===== FEATURES LIST ===== */
    .features-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        list-style: none;
        padding: 0;
        margin: 20px 0 0;
    }

    .features-list li {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 18px;
        background: #f0f4ff;
        border-radius: 12px;
        color: #1a1a2e;
        font-weight: 500;
        border-left: 3px solid #4a6cf7;
        transition: all 0.3s ease;
    }

    .features-list li:hover {
        background: #e8edff;
        transform: translateX(5px);
    }

    .features-list li .check {
        color: #28a745;
        font-weight: 700;
        font-size: 1.2rem;
    }

    /* ===== SECTION TITLES ===== */
    .section-title {
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0 0 10px;
    }

    .section-title span {
        color: #4a6cf7;
    }

    .section-subtitle {
        text-align: center;
        color: #888;
        font-size: 1.05rem;
        margin-bottom: 30px;
    }

    .features-wrapper {
        background: #f8faff;
        border-radius: 25px;
        padding: 40px;
        margin-top: 30px;
        border: 1px solid #e8edff;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        .services-section {
            grid-template-columns: 1fr 1fr;
        }
        .mission-vision {
            grid-template-columns: 1fr;
        }
        .features-list {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .about-hero {
            padding: 60px 5% 50px;
            min-height: 300px;
        }
        .about-hero h1 {
            font-size: 2rem;
        }
        .about-hero .hero-subtitle {
            font-size: 1rem;
        }
        .services-section {
            grid-template-columns: 1fr;
        }
        .features-wrapper {
            padding: 20px;
        }
    }
</style>

<!-- ===== HERO SECTION WITH FULL BACKGROUND IMAGE ===== -->
<section class="about-hero">
    <div>
        <h1>About <span>TutorConnect</span></h1>
        <p class="hero-subtitle">Connecting students with qualified tutors in a simple, efficient, and trusted way.</p>
        <div class="hero-line"></div>
        <p class="hero-role">Founder &amp; Lead Developer</p>
    </div>
</section>

<!-- ===== MAIN CONTENT ===== -->
<div class="about-container">

    <!-- ===== WELCOME TEXT ===== -->
    <div class="about-text">
        <h2>Welcome to <span>TutorConnect</span></h2>
        <p>
            TutorConnect is a platform designed to connect students with qualified tutors
            in a simple and efficient way. Students can explore tutor profiles, review
            qualifications and experience, send tutoring requests, communicate through
            messages and book tutoring.
        </p>
        <p>
            Tutors can create professional profiles, showcase their expertise, manage
            student requests and connect with students through the platform.
        </p>
        <p>
            Whether a tutoring session is planned online or offline, TutorConnect serves
            as a reliable platform for connecting students and tutors and making the
            session scheduling process easier and more organized.
        </p>
    </div>

    <!-- ===== SERVICES ===== -->
    <h2 class="section-title">Our <span>Services</span></h2>
    <p class="section-subtitle">What we offer to make learning better</p>

    <div class="services-section">
        <div class="service-card">
            <span class="icon">🔍</span>
            <h4>Tutor Search by Subject</h4>
            <p>Find the perfect tutor based on your subject and location preferences.</p>
        </div>
        <div class="service-card">
            <span class="icon">📋</span>
            <h4>Professional Tutor Profiles</h4>
            <p>View detailed profiles with qualifications, experience, and ratings.</p>
        </div>
        <div class="service-card">
            <span class="icon">📨</span>
            <h4>Request Management</h4>
            <p>Send and manage tutoring requests with ease.</p>
        </div>
        <div class="service-card">
            <span class="icon">💬</span>
            <h4>Student-Tutor Messaging</h4>
            <p>Communicate directly with tutors through the platform.</p>
        </div>
        <div class="service-card">
            <span class="icon">📅</span>
            <h4>Session Booking</h4>
            <p>Book online or offline sessions based on mutual availability.</p>
        </div>
        <div class="service-card">
            <span class="icon">⭐</span>
            <h4>Rating &amp; Feedback</h4>
            <p>Maintain transparency and help students choose the best tutors.</p>
        </div>
    </div>

    <!-- ===== MISSION & VISION ===== -->
    <div class="mission-vision">
        <div class="mv-card">
            <span class="icon"></span>
            <h3>Our Mission</h3>
            <p>
                To provide a trusted and user-friendly platform that makes it easier for
                students to find suitable tutors and for tutors to connect with students
                efficiently.
            </p>
        </div>
        <div class="mv-card vision">
            <span class="icon"></span>
            <h3>Our Vision</h3>
            <p>
                To become a reliable tutor discovery and booking platform that simplifies
                the process of connecting students and tutors across the globe.
            </p>
        </div>
    </div>

    <!-- ===== FEATURES LIST ===== -->
    <div class="features-wrapper">
        <h3 style="text-align:center; color:#1a1a2e; margin:0 0 20px; font-size:1.3rem;">
            ✨ Why Choose <span style="color:#4a6cf7;">TutorConnect</span>?
        </h3>
        <ul class="features-list">
            <li><span class="check">✔</span> Tutor Search by Subject</li>
            <li><span class="check">✔</span> Professional Tutor Profiles</li>
            <li><span class="check">✔</span> Tutor Request Management</li>
            <li><span class="check">✔</span> Student-Tutor Messaging</li>
            <li><span class="check">✔</span> Online &amp; Offline Session Booking</li>
            <li><span class="check">✔</span> Rating and Feedback System</li>
            <li><span class="check">✔</span> Secure User Authentication</li>
            <li><span class="check">✔</span> Trusted &amp; Reliable Platform</li>
        </ul>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/about.blade.php ENDPATH**/ ?>