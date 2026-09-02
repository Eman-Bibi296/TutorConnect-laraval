<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TutorConnect - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #059669;
            --primary-hover: #047857;
            --primary-light: #ECFDF5;
            --accent: #10B981;
            --dark: #111827;
            --navy: #1E293B;
            --bg-light: #F8FAFC;
            --bg-card: #FFFFFF;
            --text-main: #111827;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }
            * {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            color: var(--text-main);
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
        
        .navbar {
            background: rgba(26, 32, 53, 0.97);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 0.85rem 0;
            box-shadow: 0 4px 25px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .navbar-brand:hover {
            opacity: 0.95;
            transform: translateY(-1px);
        }

        .brand-svg-logo {
            flex-shrink: 0;
            filter: drop-shadow(0 4px 10px rgba(16, 185, 129, 0.35));
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover .brand-svg-logo {
            transform: scale(1.06) rotate(-3deg);
        }

        .brand-text {
            display: flex;
            flex-direction: column;
        }
        
        .brand-name {
            font-size: 1.45rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.1;
            letter-spacing: -0.3px;
        }
        
        .brand-accent {
            color: var(--accent);
        }

        .brand-tagline {
            font-size: 0.62rem;
            font-weight: 600;
            color: #93C5FD;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin-top: 2px;
        }
        
        .nav-links {
            display: flex;
            gap: 24px;
            margin-left: auto;
            align-items: center;
        }
        
        .nav-link-custom {
            padding: 8px 12px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 8px;
        }
        
        .nav-link-custom:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.06);
        }

        .nav-link-custom.active {
            color: var(--accent);
            font-weight: 600;
            background: rgba(16, 185, 129, 0.1);
        }
        
        .btn-login-navbar {
            background: linear-gradient(135deg, #059669 0%, #10B981 100%);
            color: white;
            padding: 9px 24px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);
        }
        
        .btn-login-navbar:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(5, 150, 105, 0.45);
            color: white;
        }
        
        .mobile-menu-btn {
            display: none;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .mobile-menu-btn:hover {
            background: rgba(255, 255, 255, 0.15);
        }
        
        @media (max-width: 992px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: #16213e;
                flex-direction: column;
                padding: 20px 5%;
                align-items: stretch;
                gap: 12px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.25);
                border-top: 1px solid rgba(255,255,255,0.08);
            }
            .nav-links.show {
                display: flex;
            }
            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .btn-login-navbar {
                text-align: center;
                justify-content: center;
            }
        }
        
        .footer {
            background: #111827;
            color: #94A3B8;
            padding: 60px 0 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            margin-top: 60px;
        }
        
        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .footer a:hover {
            color: var(--accent);
            padding-left: 4px;
        }

        .footer h4, .footer h5 {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .footer hr {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 40px 0 20px;
        }

        /* Micro-Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.7s ease forwards;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar" aria-label="Main Navigation">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <svg class="brand-svg-logo" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="38" height="38" rx="10" fill="url(#brandGradLayout)"/>
                        <path d="M19 9L29 14.5L19 20L9 14.5L19 9Z" fill="white"/>
                        <path d="M12.5 17.2V22.5C12.5 24.8 15.4 27 19 27C22.6 27 25.5 24.8 25.5 22.5V17.2L19 20.8L12.5 17.2Z" fill="white" fill-opacity="0.85"/>
                        <circle cx="28.5" cy="19.5" r="2" fill="#FCD34D"/>
                        <path d="M28.5 21.5V26" stroke="#FCD34D" stroke-width="1.5" stroke-linecap="round"/>
                        <defs>
                            <linearGradient id="brandGradLayout" x1="0" y1="0" x2="38" y2="38" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#059669"/>
                                <stop offset="1" stop-color="#10B981"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="brand-text">
                        <span class="brand-name">Tutor<span class="brand-accent">Connect</span></span>
                        <span class="brand-tagline">EXPERT LEARNING PLATFORM</span>
                    </div>
                </a>
                
                <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Toggle navigation menu">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="nav-links" id="navLinks">
                    <a href="/" class="nav-link-custom {{ request()->is('/') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                    <a href="/about" class="nav-link-custom {{ request()->is('about') ? 'active' : '' }}">
                        <i class="fas fa-info-circle"></i> About Us
                    </a>
                    
                    @if(session('student_id'))
                        <a href="/student/dashboard" class="btn-login-navbar">
                            <i class="fas fa-user-graduate"></i> My Dashboard
                        </a>
                    @elseif(session('tutor_id'))
                        <a href="/tutor/dashboard" class="btn-login-navbar">
                            <i class="fas fa-chalkboard-user"></i> My Dashboard
                        </a>
                    @elseif(session('admin_logged_in'))
                        <a href="/admin/dashboard" class="btn-login-navbar">
                            <i class="fas fa-shield-halved"></i> Admin Panel
                        </a>
                    @else
                        <a href="/login" class="btn-login-navbar {{ request()->is('login') ? 'active' : '' }}">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <svg width="34" height="34" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="40" height="40" rx="10" fill="url(#ftBladeLogoGrad)"/>
                            <path d="M20 10L9 16L20 22L31 16L20 10Z" fill="#FFFFFF"/>
                            <path d="M12 18.5V24.5C12 24.5 15.5 28 20 28C24.5 28 28 24.5 28 24.5V18.5L20 23L12 18.5Z" fill="#A7F3D0"/>
                            <defs>
                                <linearGradient id="ftBladeLogoGrad" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#059669"/>
                                    <stop offset="1" stop-color="#10B981"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <h4 style="color:white; margin:0; font-weight:800;">Tutor<span style="color:#10B981;">Connect</span></h4>
                    </div>
                    <p style="font-size: 0.9rem; line-height: 1.6; color: #94A3B8;">Pakistan's premier peer-to-peer tutoring network connecting verified faculty instructors with ambitious students for personalized 1-on-1 learning.</p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 style="color:white; font-weight:700; font-size:1rem; margin-bottom:18px;">Quick Links</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2" style="font-size:0.9rem;">
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/student/register">Student Register</a></li>
                        <li><a href="/tutor/register">Become a Tutor</a></li>
                        <li><a href="/login">Sign In</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 style="color:white; font-weight:700; font-size:1rem; margin-bottom:18px;">Portals & Admin</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2" style="font-size:0.9rem;">
                        <li><a href="/student/dashboard"><i class="fa-solid fa-user-graduate me-2" style="color:#10B981;"></i> Student Portal</a></li>
                        <li><a href="/tutor/dashboard"><i class="fa-solid fa-chalkboard-user me-2" style="color:#10B981;"></i> Tutor Portal</a></li>
                        <li><a href="/admin/dashboard" style="color:#34D399; font-weight:700;"><i class="fa-solid fa-shield-halved me-2"></i> Admin Portal</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 style="color:white; font-weight:700; font-size:1rem; margin-bottom:18px;">Contact & Support</h5>
                    <p style="font-size:0.9rem; margin-bottom:8px; color:#94A3B8;"><i class="fa-solid fa-envelope me-2" style="color:#10B981;"></i> info@tutorconnect.com</p>
                    <p style="font-size:0.9rem; margin-bottom:8px; color:#94A3B8;"><i class="fa-solid fa-phone me-2" style="color:#10B981;"></i> +92 316 6325085</p>
                    <p style="font-size:0.9rem; margin-bottom:8px; color:#94A3B8;"><i class="fa-solid fa-location-dot me-2" style="color:#10B981;"></i> Sheikhupura / Lahore, Pakistan</p>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 text-center text-md-start" style="font-size: 0.85rem;">
                <p class="mb-0">© 2026 TutorConnect. All rights reserved.</p>
                <div class="d-flex gap-3">
                    <a href="/admin/login" style="color:#34D399; font-weight:600;"><i class="fa-solid fa-lock me-1"></i> Admin Access</a>
                    <a href="/about">Privacy Policy</a>
                    <a href="/about">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleMobileMenu() {
            const navLinks = document.getElementById('navLinks');
            if (navLinks) {
                navLinks.classList.toggle('show');
            }
        }
    </script>
</body>
</html>