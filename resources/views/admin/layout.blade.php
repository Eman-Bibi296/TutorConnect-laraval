<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #059669;
            --primary-dark: #047857;
            --accent: #10B981;
            --bg-dark: #111827;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #F1F5F9; color: var(--text-main); }
        
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .admin-sidebar {
            width: 280px;
            background: var(--bg-dark);
            color: white;
            padding: 24px 18px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            border-right: 1px solid rgba(255,255,255,0.08);
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .brand-text { display: flex; flex-direction: column; }
        .brand-name { font-size: 1.35rem; font-weight: 800; color: #FFFFFF; line-height: 1.1; }
        .brand-accent { color: var(--accent); }
        .brand-tag { font-size: 0.65rem; font-weight: 700; color: #34D399; letter-spacing: 1px; text-transform: uppercase; }

        .admin-badge-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.05);
            padding: 10px 14px;
            border-radius: 14px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #059669, #10B981);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid #34D399;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #94A3B8;
            text-decoration: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255,255,255,0.08);
            color: white;
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, #059669 0%, #10B981 100%);
            box-shadow: 0 4px 14px rgba(5, 150, 105, 0.35);
        }
        
        /* Main Content */
        .admin-main {
            margin-left: 280px;
            padding: 30px;
            width: calc(100% - 280px);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            border: 1px solid var(--border-color);
            transition: all 0.2s;
        }

        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #111827;
            line-height: 1;
            margin-bottom: 6px;
        }
        
        .stat-label {
            color: var(--text-muted);
            font-size: 0.82rem;
            font-weight: 600;
        }
        
        .section-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            border: 1px solid var(--border-color);
        }
        
        .section-title {
            margin-top: 0;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
            font-size: 1.15rem;
            font-weight: 800;
            color: #111827;
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #F1F5F9;
            font-size: 0.88rem;
        }
        
        th {
            background: #F8FAFC;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            font-size: 0.78rem;
            letter-spacing: 0.5px;
        }
        
        .btn-sm {
            padding: 6px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        
        .btn-success { background: #059669; border-color: #059669; }
        .btn-danger { background: #DC2626; border-color: #DC2626; }
        
        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <a href="/" class="sidebar-brand">
                <svg width="36" height="36" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="10" fill="url(#adminBladeLogoGrad)"/>
                    <path d="M20 10L9 16L20 22L31 16L20 10Z" fill="#FFFFFF"/>
                    <path d="M12 18.5V24.5C12 24.5 15.5 28 20 28C24.5 28 28 24.5 28 24.5V18.5L20 23L12 18.5Z" fill="#A7F3D0"/>
                    <defs>
                        <linearGradient id="adminBladeLogoGrad" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#059669"/>
                            <stop offset="1" stop-color="#10B981"/>
                        </linearGradient>
                    </defs>
                </svg>
                <div class="brand-text">
                    <span class="brand-name">Tutor<span class="brand-accent">Connect</span></span>
                    <span class="brand-tag">Administration</span>
                </div>
            </a>

            <div class="admin-badge-profile">
                <div class="admin-avatar">A</div>
                <div>
                    <h6 style="color:white; margin:0; font-weight:700; font-size:0.85rem;">Super Admin</h6>
                    <small style="color:#34D399; font-size:0.7rem;">● Online Control</small>
                </div>
            </div>
            
            <ul class="sidebar-menu">
                <li><a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li><a href="/admin/tutors" class="{{ request()->is('admin/tutors*') ? 'active' : '' }}"><i class="fa-solid fa-chalkboard-user"></i> Tutors</a></li>
                <li><a href="/admin/students" class="{{ request()->is('admin/students*') ? 'active' : '' }}"><i class="fa-solid fa-user-graduate"></i> Students</a></li>
                <li><a href="/admin/bookings" class="{{ request()->is('admin/bookings*') ? 'active' : '' }}"><i class="fa-solid fa-calendar-check"></i> Bookings</a></li>
                <li><a href="/admin/requests" class="{{ request()->is('admin/requests*') ? 'active' : '' }}"><i class="fa-solid fa-envelope-open-text"></i> Requests</a></li>
                <li><a href="/admin/messages" class="{{ request()->is('admin/messages*') ? 'active' : '' }}"><i class="fa-solid fa-comments"></i> Messages</a></li>
                <li><a href="/admin/reviews" class="{{ request()->is('admin/reviews*') ? 'active' : '' }}"><i class="fa-solid fa-star"></i> Reviews</a></li>
            </ul>
            
            <div style="margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
                <ul class="sidebar-menu">
                    <li><a href="/" style="color:#34D399;"><i class="fa-solid fa-globe"></i> View Website</a></li>
                    <li><a href="/admin/logout" style="color:#EF4444;"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
                </ul>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="admin-main">
            @if(session('success'))
                <div class="alert alert-success"><i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}</div>
            @endif
            
            @yield('content')
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>