<!-- ============================================================ -->
<!-- TUTOR SIDEBAR - WITH NOTIFICATIONS                           -->
<!-- ============================================================ -->

<style>
    .sidebar {
        width: 280px;
        background: #1a1a2e;
        min-height: 100vh;
        padding: 30px 20px;
        color: white;
        position: sticky;
        top: 0;
        border-radius: 0 30px 30px 0;
        box-shadow: 4px 0 20px rgba(0,0,0,0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .profile-section {
        text-align: center;
        margin-bottom: 35px;
        padding-bottom: 25px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    
    .profile-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid #4a6cf7;
        padding: 5px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
        object-fit: cover;
        background: rgba(255,255,255,0.05);
    }
    
    .profile-icon:hover {
        transform: scale(1.05);
        border-color: #6c5ce7;
        box-shadow: 0 0 25px rgba(74, 108, 247, 0.3);
    }
    
    .profile-name {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
    }
    
    .profile-email {
        margin: 5px 0 0;
        font-size: 0.8rem;
        color: rgba(255,255,255,0.4);
    }
    
    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-menu li {
        margin-bottom: 5px;
    }
    
    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 18px;
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 0.95rem;
        position: relative;
    }
    
    .sidebar-menu a:hover {
        background: rgba(255,255,255,0.08);
        color: #ffffff;
        transform: translateX(5px);
    }
    
    .sidebar-menu a.active {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
        box-shadow: 0 4px 15px rgba(74, 108, 247, 0.3);
    }

    /* ===== ICON STYLES - WHITE ICONS ===== */
.sidebar-menu a .icon {
    width: 28px;    /* ⭐ SIZE YAHAN SET HAI */
    height: 28px;   /* ⭐ SIZE YAHAN SET HAI */
    object-fit: contain;
    flex-shrink: 0;
    filter: none;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.sidebar-menu a:hover .icon {
    opacity: 1;
}

.sidebar-menu a.active .icon {
    opacity: 1;
}
    
    .badge {
        display: inline-block;
        padding: 2px 9px;
        border-radius: 50%;
        font-size: 0.65rem;
        font-weight: 700;
        margin-left: auto;
        color: white;
        min-width: 22px;
        text-align: center;
        animation: pulse-badge 2s infinite;
    }
    
    @keyframes pulse-badge {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    .badge-message { background: #4a6cf7; }
    .badge-request { background: #ffc107; color: #333; }
    .badge-booking { background: #28a745; }
    .badge-review { background: #ff69b4; }
    
    .logout-link {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid rgba(255,255,255,0.08);
    }
    
    .logout-link a {
        color: rgba(255,255,255,0.4) !important;
    }
    
    .logout-link a:hover {
        color: #ff6b6b !important;
        background: rgba(255,107,107,0.1) !important;
        transform: translateX(5px);
    }
    
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            border-radius: 0;
            min-height: auto;
            padding: 20px;
            position: relative;
        }
        .sidebar-menu a {
            padding: 10px 15px;
            font-size: 0.9rem;
        }
        .profile-icon {
            width: 60px;
            height: 60px;
        }
    }
</style>

<div class="sidebar">
    
    <!-- ===== PROFILE SECTION ===== -->
    @php
        use App\Models\Tutor;
        $tutorId = Session::get('tutor_id');
        $tutor = Tutor::find($tutorId);
    @endphp
    
    <div class="profile-section">
        <a href="/tutor/dashboard">
            <img src="{{ asset('images/icon.png') }}" alt="Profile" class="profile-icon">
        </a>
        <h3 class="profile-name">{{ $tutor->name ?? 'Tutor' }}</h3>
        <p class="profile-email">{{ $tutor->email ?? 'tutor@email.com' }}</p>
    </div>
    
    <!-- ===== MENU ===== -->
    <ul class="sidebar-menu">
        
        <!-- Dashboard -->
        <li>
            <a href="/tutor/dashboard" class="{{ request()->is('tutor/dashboard') ? 'active' : '' }}">
                <img src="{{ asset('images/computer.png') }}" alt="Dashboard" class="icon">
                Dashboard 
            </a>
        </li>
        
        <!-- Edit Profile -->
        <li>
            <a href="/tutor/profile/edit" class="{{ request()->is('tutor/profile/edit*') ? 'active' : '' }}">
                <img src="{{ asset('images/Editprofile.png') }}" alt="Edit Profile" class="icon">
                Edit Profile
            </a>
        </li>
        
        <!-- Student Requests -->
        <li>
            <a href="/tutor/requests" class="{{ request()->is('tutor/requests*') ? 'active' : '' }}">
                 <img src="{{ asset('images/Myrequest.png') }}" alt="Student Requests" class="icon">
                Student Requests
                @if(isset($newRequests) && $newRequests > 0)
                    <span class="badge badge-request">{{ $newRequests }}</span>
                @endif
            </a>
        </li>
        
        <!-- Messages -->
        <li>
            <a href="/tutor/messages" class="{{ request()->is('tutor/messages*') ? 'active' : '' }}">
                 <img src="{{ asset('images/messages.png') }}" alt="Messages" class="icon">
                Messages
                @if(isset($unreadMessages) && $unreadMessages > 0)
                    <span class="badge badge-message">{{ $unreadMessages }}</span>
                @endif
            </a>
        </li>
        
        <!-- Booking Requests -->
        <li>
            <a href="/tutor/bookings" class="{{ request()->is('tutor/bookings*') ? 'active' : '' }}">
                    <img src="{{ asset('images/bookingicon.png') }}" alt="Booking Requests" class="icon">
                Booking Requests
                @if(isset($newBookings) && $newBookings > 0)
                    <span class="badge badge-booking">{{ $newBookings }}</span>
                @endif
            </a>
        </li>
        
        <!-- Study Materials -->
        <li>
            <a href="/tutor/study-materials" class="{{ request()->is('tutor/study-materials*') ? 'active' : '' }}">
                       <img src="{{ asset('images/studymaterial.png') }}" alt="Study Materials" class="icon">
                Study Materials
            </a>
        </li>
        
        <!-- ⭐ REVIEWS & RATINGS - USING $unreadReviews -->
        <li>
            <a href="/tutor/reviews" class="{{ request()->is('tutor/reviews*') ? 'active' : '' }}">
                  <img src="{{ asset('images/reviewsicon.png') }}" alt="Reviews" class="icon">
                Reviews & Ratings
                @if(isset($unreadReviews) && $unreadReviews > 0)
                    <span class="badge badge-review">{{ $unreadReviews }}</span>
                @endif
            </a>
        </li>
        
    </ul>
    
    <!-- ===== LOGOUT ===== -->
    <div class="logout-link">
        <ul class="sidebar-menu">
            <li>
                <a href="/logout">
                    <img src="{{ asset('images/logout.png') }}" alt="Logout" class="icon">
                    Logout
                </a>
            </li>
        </ul>
    </div>
    
</div>