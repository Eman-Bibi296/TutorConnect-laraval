@extends('layouts.app')

@section('title', 'About Us - TutorConnect')

@section('content')
<style>
    /* About Hero */
    .about-hero {
        background: linear-gradient(135deg, rgba(26, 32, 53, 0.45) 0%, rgba(17, 24, 39, 0.55) 100%), url('{{ asset("images/about4.jpg") }}') center/cover no-repeat;
        padding: 85px 5% 75px;
        text-align: center;
        border-radius: 0 0 40px 40px;
        margin-bottom: 50px;
        color: white;
    }

    .about-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(16, 185, 129, 0.18);
        border: 1px solid rgba(16, 185, 129, 0.35);
        color: #34D399;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 6px 18px;
        border-radius: 30px;
        margin-bottom: 18px;
    }

    .about-hero h1 {
        font-size: 3rem;
        font-weight: 800;
        margin: 0 0 12px;
        color: white;
    }

    .about-hero h1 span {
        color: #10B981;
    }

    .about-hero .hero-subtitle {
        font-size: 1.15rem;
        color: #E2E8F0;
        max-width: 680px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 5% 60px;
    }

    .about-text {
        text-align: center;
        max-width: 880px;
        margin: 0 auto 50px;
    }

    .about-text h2 {
        font-size: 2.2rem;
        color: #111827;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .about-text h2 span {
        color: #059669;
    }

    .about-text p {
        color: #4B5563;
        line-height: 1.8;
        font-size: 1.05rem;
        margin-bottom: 15px;
    }

    .section-title {
        text-align: center;
        font-size: 2.2rem;
        font-weight: 800;
        color: #111827;
        margin: 0 0 10px;
    }

    .section-title span {
        color: #059669;
    }

    .section-subtitle {
        text-align: center;
        color: #6B7280;
        font-size: 1.05rem;
        margin-bottom: 40px;
    }

    .services-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 25px;
        margin-bottom: 60px;
    }

    .service-card {
        background: white;
        border-radius: 20px;
        padding: 32px 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid #E5E7EB;
        transition: all 0.3s ease;
        text-align: center;
    }

    .service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(5, 150, 105, 0.12);
        border-color: #10B981;
    }

    .service-card .icon {
        font-size: 2.2rem;
        width: 65px;
        height: 65px;
        line-height: 65px;
        border-radius: 50%;
        background: #ECFDF5;
        color: #059669;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .service-card h4 {
        color: #111827;
        margin: 0 0 10px;
        font-size: 1.2rem;
        font-weight: 700;
    }

    .service-card p {
        color: #6B7280;
        font-size: 0.92rem;
        line-height: 1.6;
        margin: 0;
    }

    .mission-vision {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 60px;
    }

    .mv-card {
        background: white;
        border-radius: 22px;
        padding: 35px 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #E5E7EB;
        border-top: 5px solid #059669;
        transition: all 0.3s ease;
    }

    .mv-card.vision {
        border-top-color: #3B82F6;
    }

    .mv-card:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        transform: translateY(-4px);
    }

    .mv-card .icon {
        font-size: 2rem;
        margin-bottom: 12px;
        display: block;
    }

    .mv-card h3 {
        color: #111827;
        margin: 0 0 12px;
        font-size: 1.35rem;
        font-weight: 700;
    }

    .mv-card p {
        color: #4B5563;
        line-height: 1.7;
        font-size: 0.95rem;
        margin: 0;
    }

    .features-wrapper {
        background: #F8FAFC;
        border-radius: 24px;
        padding: 40px;
        border: 1px solid #E2E8F0;
    }

    .features-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        list-style: none;
        padding: 0;
        margin: 25px 0 0;
    }

    .features-list li {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        background: white;
        border-radius: 14px;
        color: #1F2937;
        font-weight: 600;
        font-size: 0.95rem;
        border: 1px solid #E5E7EB;
        transition: all 0.25s ease;
    }

    .features-list li:hover {
        border-color: #10B981;
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
    }

    .features-list li .check {
        color: #059669;
        font-weight: 800;
        font-size: 1.1rem;
    }

    @media (max-width: 992px) {
        .mission-vision, .features-list {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .about-hero {
            padding: 60px 5% 45px;
        }
        .about-hero h1 {
            font-size: 2.2rem;
        }
        .features-wrapper {
            padding: 25px 15px;
        }
    }
</style>

<!-- Hero Section -->
<section class="about-hero">
    <div class="animate-fade-in-up">
        <div class="about-hero-badge">
            <i class="fas fa-bullseye"></i> Our Purpose &amp; Story
        </div>
        <h1>About <span>TutorConnect</span></h1>
        <p class="hero-subtitle">Connecting motivated students with verified expert tutors in a simple, structured, and trusted ecosystem.</p>
    </div>
</section>

<!-- Main Content -->
<div class="about-container">
    <div class="about-text">
        <h2>Welcome to <span>TutorConnect</span></h2>
        <p>TutorConnect is an educational platform created to bridge the gap between students seeking targeted academic guidance and qualified tutors providing specialized instruction.</p>
        <p>Whether preparing for school exams, mastering university modules, or learning programming, TutorConnect streamlines teacher discovery, scheduling, direct communication, and study material sharing in one place.</p>
    </div>

    <h2 class="section-title">Core <span>Platform Features</span></h2>
    <p class="section-subtitle">Everything you need for productive tutoring sessions</p>

    <div class="services-section">
        <div class="service-card"><div class="icon">🔍</div><h4>Subject &amp; City Filter</h4><p>Locate ideal tutors quickly based on specific subjects, location, and teaching mode.</p></div>
        <div class="service-card"><div class="icon">📋</div><h4>Verified Tutor Profiles</h4><p>Review comprehensive tutor biographies, educational credentials, and student ratings.</p></div>
        <div class="service-card"><div class="icon">📨</div><h4>Direct Booking Requests</h4><p>Schedule one-on-one sessions seamlessly with instant status tracking.</p></div>
        <div class="service-card"><div class="icon">💬</div><h4>Integrated Messaging</h4><p>Exchange questions, discuss syllabus requirements, and confirm timings directly.</p></div>
        <div class="service-card"><div class="icon">📚</div><h4>Study Materials Sharing</h4><p>Tutors can upload lecture notes and past papers for students to download.</p></div>
        <div class="service-card"><div class="icon">⭐</div><h4>Transparent Reviews</h4><p>Genuine student feedback maintains high quality standards across the platform.</p></div>
    </div>

    <div class="mission-vision">
        <div class="mv-card">
            <span class="icon">🎯</span>
            <h3>Our Mission</h3>
            <p>To provide an accessible, safe, and intuitive platform that empowers students to achieve academic excellence through personalized one-on-one mentorship from qualified educators.</p>
        </div>
        <div class="mv-card vision">
            <span class="icon">🚀</span>
            <h3>Our Vision</h3>
            <p>To become a leading academic discovery network that democratizes access to quality education, supporting both independent tutors and aspiring learners worldwide.</p>
        </div>
    </div>

    <!-- Featured Faculty / Educators Section -->
    <div style="margin-top: 60px;">
        <h2 class="section-title">Meet Our <span>Verified Faculty</span></h2>
        <p class="section-subtitle">Dedicated professionals empowering students across Pakistan and online</p>

        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div style="background: white; border-radius: 20px; padding: 25px; text-align: center; border: 1px solid #E2E8F0; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                    <img src="{{ asset('images/burhan.png') }}" alt="Dr. Burhan Ahmad" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 3px solid #10B981; margin-bottom: 15px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);">
                    <h4 style="font-weight: 800; color: #111827; margin: 0 0 4px;">Dr. Burhan Ahmad</h4>
                    <p style="color: #059669; font-weight: 700; font-size: 0.85rem; margin-bottom: 8px;">PhD in Computer Science</p>
                    <p style="color: #64748B; font-size: 0.85rem; line-height: 1.5; margin-bottom: 15px;">Full-Stack Development, PHP Laravel, and Software Architecture specialist.</p>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">⭐ 4.9 Rating</span>
                </div>
            </div>
            <div class="col-md-4">
                <div style="background: white; border-radius: 20px; padding: 25px; text-align: center; border: 1px solid #E2E8F0; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                    <img src="{{ asset('images/rabia.jpg') }}" alt="Prof. Rabia Tariq" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 3px solid #10B981; margin-bottom: 15px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);">
                    <h4 style="font-weight: 800; color: #111827; margin: 0 0 4px;">Prof. Rabia Tariq</h4>
                    <p style="color: #059669; font-weight: 700; font-size: 0.85rem; margin-bottom: 8px;">MPhil in Applied Mathematics</p>
                    <p style="color: #64748B; font-size: 0.85rem; line-height: 1.5; margin-bottom: 15px;">Calculus, Differential Equations, and Linear Algebra mentor.</p>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">⭐ 5.0 Rating</span>
                </div>
            </div>
            <div class="col-md-4">
                <div style="background: white; border-radius: 20px; padding: 25px; text-align: center; border: 1px solid #E2E8F0; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                    <img src="{{ asset('images/ahmad.jpg') }}" alt="Engr. Ahmad Ali" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 3px solid #10B981; margin-bottom: 15px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);">
                    <h4 style="font-weight: 800; color: #111827; margin: 0 0 4px;">Engr. Ahmad Ali</h4>
                    <p style="color: #059669; font-weight: 700; font-size: 0.85rem; margin-bottom: 8px;">Electrical Engineering</p>
                    <p style="color: #64748B; font-size: 0.85rem; line-height: 1.5; margin-bottom: 15px;">Applied Physics, Circuit Design, and Electromagnetism instructor.</p>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">⭐ 4.8 Rating</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Checklist Section -->
    <div class="features-wrapper mt-5">
        <h3 style="text-align:center; color:#111827; margin:0 0 10px; font-size:1.4rem; font-weight:700;">
            ✨ Why Choose <span style="color:#059669;">TutorConnect</span>?
        </h3>
        <p style="text-align:center; color:#6B7280; margin-bottom:20px; font-size:0.95rem;">Designed specifically for smooth student-tutor collaboration</p>
        <ul class="features-list">
            <li><span class="check">✔</span> Subject-Specific Tutor Discovery</li>
            <li><span class="check">✔</span> Admin-Verified Educator Credentials</li>
            <li><span class="check">✔</span> Real-Time Session Booking System</li>
            <li><span class="check">✔</span> Direct In-App Student-Tutor Chat</li>
            <li><span class="check">✔</span> Course Materials &amp; Resource Center</li>
            <li><span class="check">✔</span> Transparent Rating &amp; Review System</li>
            <li><span class="check">✔</span> Dedicated Dashboards for Both Roles</li>
            <li><span class="check">✔</span> Safe &amp; Secure Authentication</li>
        </ul>
    </div>

    <!-- Call to Action Banner -->
    <div style="background: linear-gradient(135deg, #111827 0%, #064E3B 100%); border-radius: 24px; padding: 50px 30px; text-align: center; color: white; margin-top: 60px; box-shadow: 0 15px 35px rgba(6,78,59,0.2);">
        <h3 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 10px;">Ready to Get Started?</h3>
        <p style="color: #A7F3D0; font-size: 1rem; max-width: 550px; margin: 0 auto 25px;">Whether you want to learn from top tutors or share your knowledge as an educator, TutorConnect is ready for you.</p>
        <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
            <a href="/student/register" style="background: linear-gradient(135deg, #059669 0%, #10B981 100%); color: white; font-weight: 700; padding: 12px 28px; border-radius: 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                <i class="fas fa-user-graduate"></i> Register as Student
            </a>
            <a href="/tutor/register" style="background: white; color: #047857; font-weight: 700; padding: 12px 28px; border-radius: 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                <i class="fas fa-chalkboard-teacher"></i> Become a Tutor
            </a>
        </div>
    </div>
</div>
@endsection