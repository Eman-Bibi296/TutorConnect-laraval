<div class="admin-sidebar">
    <a href="/admin/dashboard" class="sidebar-brand">
        <svg class="brand-svg-logo" width="36" height="36" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="40" height="40" rx="10" fill="url(#adminLogoGradUpper)"/>
            <path d="M20 10L9 16L20 22L31 16L20 10Z" fill="#FFFFFF"/>
            <path d="M12 18.5V24.5C12 24.5 15.5 28 20 28C24.5 28 28 24.5 28 24.5V18.5L20 23L12 18.5Z" fill="#A7F3D0"/>
            <circle cx="31" cy="18" r="1.5" fill="#34D399"/>
            <path d="M31 19.5V23.5" stroke="#34D399" stroke-width="1.5" stroke-linecap="round"/>
            <defs>
                <linearGradient id="adminLogoGradUpper" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#059669"/>
                    <stop offset="1" stop-color="#10B981"/>
                </linearGradient>
            </defs>
        </svg>
        <div class="brand-text">
            <span class="brand-name">Tutor<span class="brand-accent">Connect</span></span>
            <span class="brand-tag">Admin Control Center</span>
        </div>
    </a>

    <div class="admin-badge-profile">
        <div class="admin-avatar">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div>
            <div style="font-weight: 700; color: white; font-size: 0.92rem;">Administrator</div>
            <div style="font-size: 0.72rem; color: #34D399; font-weight: 600;">Full System Access</div>
        </div>
    </div>

    <ul class="admin-nav-menu">
        <li>
            <a href="/admin/dashboard" class="admin-nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i> <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="/admin/students" class="admin-nav-link {{ request()->is('admin/students*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-graduate"></i> <span>Students</span>
            </a>
        </li>
        <li>
            <a href="/admin/tutors" class="admin-nav-link {{ request()->is('admin/tutors*') ? 'active' : '' }}">
                <i class="fa-solid fa-chalkboard-user"></i> <span>Tutors</span>
            </a>
        </li>
        <li>
            <a href="/admin/requests" class="admin-nav-link {{ request()->is('admin/requests*') ? 'active' : '' }}">
                <i class="fa-solid fa-inbox"></i> <span>Requests</span>
            </a>
        </li>
        <li>
            <a href="/admin/bookings" class="admin-nav-link {{ request()->is('admin/bookings*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-check"></i> <span>Bookings</span>
            </a>
        </li>
        <li>
            <a href="/admin/reviews" class="admin-nav-link {{ request()->is('admin/reviews*') ? 'active' : '' }}">
                <i class="fa-solid fa-star"></i> <span>Reviews &amp; Ratings</span>
            </a>
        </li>
        <li>
            <a href="/admin/messages" class="admin-nav-link {{ request()->is('admin/messages*') ? 'active' : '' }}">
                <i class="fa-solid fa-comments"></i> <span>System Messages</span>
            </a>
        </li>
        <li style="margin-top: 15px; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 15px;">
            <a href="/admin/logout" class="admin-nav-link" style="color: #EF4444;">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Logout</span>
            </a>
        </li>
    </ul>
</div>