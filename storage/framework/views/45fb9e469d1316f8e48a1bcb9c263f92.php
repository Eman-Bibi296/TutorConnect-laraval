<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Tutor Connect - <?php echo $__env->yieldContent('title'); ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fc;
            overflow-x: hidden;
        }
        
        .navbar {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            padding: 0.8rem 5%;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        
        .navbar-brand .logo-text {
            font-size: 1.6rem;
            font-weight: 700;
            color: white;
        }
        
        .navbar-brand .logo-text span {
            color: #4a6cf7;
        }
        
        .nav-links {
            display: flex;
            gap: 20px;
            margin-left: auto;
            align-items: center;
        }
        
        .nav-link-custom {
            padding: 8px 0;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .nav-link-custom:hover {
            color: white;
        }
        
        .btn-login-navbar {
            background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
            color: white;
            padding: 8px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .btn-login-navbar:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74,108,247,0.4);
            color: white;
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.8rem;
            cursor: pointer;
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
                padding: 20px;
                align-items: flex-start;
            }
            .nav-links.show {
                display: flex;
            }
            .mobile-menu-btn {
                display: block;
            }
        }
        
        .footer {
            background: #D2B48C;
            color: #fff;
            padding: 60px 5% 30px;
            margin-top: 60px;
        }
        
        .footer a {
            color: #f5f5dc;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: #8B4513;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <div class="logo-text">Tutor<span>Connect</span></div>
            </a>
            
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="nav-links" id="navLinks">
                <a href="/" class="nav-link-custom">Home</a>
                <a href="/about" class="nav-link-custom">About Us</a>
                <a href="/login" class="btn-login-navbar">Login</a>
            </div>
        </div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Tutor Connect</h4>
                    <p>Connecting students with expert tutors for personalized learning.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/login">Login</a></li>
                        <li><a href="/admin/login">Admin Login</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <p>📧 info@tutorconnect.com</p>
                    <p>📞 3166325085</p>
                    <p>📍 Sheikhupura, Pakistan</p>
                </div>
            </div>
            <hr>
            <p class="text-center">© 2026 Tutor Connect. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleMobileMenu() {
            document.getElementById('navLinks').classList.toggle('show');
        }
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/layouts/app.blade.php ENDPATH**/ ?>