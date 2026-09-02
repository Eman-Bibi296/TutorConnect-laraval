<!-- ============================================================ -->
<!-- TUTOR SIDEBAR - 1:1 VISUAL & DYNAMIC PARITY                   -->
<!-- ============================================================ -->

<style>
    :root {
        --primary: #059669;
        --primary-hover: #047857;
        --primary-light: #ECFDF5;
        --accent: #10B981;
        --bg-light: #F8FAFC;
        --bg-card: #FFFFFF;
        --text-main: #111827;
        --text-muted: #64748B;
        --border-color: #E2E8F0;
    }

    .sidebar {
        width: 280px;
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid #E2E8F0;
        height: fit-content;
        position: sticky;
        top: 90px;
        font-family: 'Poppins', sans-serif;
    }
    
    .tutor-profile-badge {
        text-align: center;
        padding-bottom: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid #F1F5F9;
    }
    
    .tutor-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #10B981;
        margin: 0 auto 12px;
        display: block;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);
        background: #ECFDF5;
    }

    .tutor-profile-badge h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .tutor-profile-badge p {
        font-size: 0.8rem;
        color: #64748B;
        margin: 3px 0 0;
        word-break: break-all;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-menu li {
        margin-bottom: 6px;
    }
    
    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 16px;
        color: #475569;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.92rem;
        transition: all 0.2s ease;
        position: relative;
    }
    
    .sidebar-menu a:hover {
        background: #F1F5F9;
        color: #059669;
        transform: translateX(4px);
    }
    
    .sidebar-menu a.active {
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.25);
    }

    .sidebar-menu a.active:hover {
        transform: translateX(4px);
        color: #ffffff;
    }

    .sidebar-menu a i {
        width: 20px;
        text-align: center;
        font-size: 1rem;
    }

    .badge-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 0.72rem;
        font-weight: 700;
        margin-left: auto;
        color: white;
        min-width: 20px;
        height: 20px;
    }
    
    .badge-msg { background: #059669; }
    .badge-req { background: #F59E0B; color: #111827; }
    .badge-bk { background: #10B981; }
    .badge-rev { background: #EC4899; }

    .sidebar-menu a.active .badge-count {
        background: #ffffff;
        color: #059669;
    }
    
    .logout-item {
        margin-top: 18px;
        padding-top: 14px;
        border-top: 1px solid #F1F5F9;
    }
    
    .logout-item a {
        color: #64748B;
    }
    
    .logout-item a:hover {
        color: #EF4444;
        background: #FEF2F2;
    }

    @media (max-width: 900px) {
        .sidebar {
            width: 100%;
            position: static;
            top: auto;
            margin-bottom: 24px;
        }
    }
</style>

@php
    use App\Models\Tutor;
    use App\Models\RequestModel;
    use App\Models\Message;
    use App\Models\Booking;
    use App\Models\Feedback;
    use Illuminate\Support\Facades\Session;

    $tutorId = Session::get('tutor_id');
    $tutorUser = $tutorId ? Tutor::find($tutorId) : null;

    $tutorAvatar = 'images/burhan.png';
    if ($tutorUser) {
        if (!empty($tutorUser->profile_picture) && file_exists(public_path($tutorUser->profile_picture))) {
            $tutorAvatar = $tutorUser->profile_picture;
        } else {
            $firstName = strtolower(explode(' ', str_replace(['Dr.', 'Prof.', 'Mr.', 'Ms.'], '', $tutorUser->name))[0] ?? 'burhan');
            if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
                $tutorAvatar = 'images/' . $firstName . '.jpg';
            } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
                $tutorAvatar = 'images/' . $firstName . '.png';
            }
        }
    }

    $unreadTutorMsgs = $tutorId ? Message::where('receiver_id', $tutorId)
        ->where('receiver_type', 'tutor')
        ->where('is_read', 0)
        ->count() : 0;

    $newTutorReqs = $tutorId ? RequestModel::where('tutor_id', $tutorId)
        ->where('status', 'pending')
        ->where('is_viewed', 0)
        ->count() : 0;

    $newTutorBookings = $tutorId ? Booking::where('tutor_id', $tutorId)
        ->where('status', 'confirmed')
        ->where('is_viewed', 0)
        ->count() : 0;

    $unreadTutorReviews = $tutorId ? Feedback::where('tutor_id', $tutorId)
        ->where('is_read', 0)
        ->count() : 0;
@endphp

<div class="sidebar">
    <div class="tutor-profile-badge">
        <img src="{{ asset($tutorAvatar) }}" alt="Tutor Avatar" class="tutor-avatar" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($tutorUser->name ?? 'Tutor') }}&background=ECFDF5&color=059669'">
        <h4>{{ $tutorUser->name ?? 'Tutor' }}</h4>
        <p>{{ $tutorUser->email ?? 'tutor@tutorconnect.com' }}</p>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="/tutor/dashboard" class="{{ request()->is('tutor/dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="/tutor/profile/edit" class="{{ request()->is('tutor/profile/edit*') ? 'active' : '' }}">
                <i class="fas fa-user-edit"></i>
                <span>Edit Profile</span>
            </a>
        </li>
        <li>
            <a href="/tutor/requests" class="{{ request()->is('tutor/requests*') ? 'active' : '' }}">
                <i class="fas fa-paper-plane"></i>
                <span>Student Requests</span>
                @if($newTutorReqs > 0)
                    <span class="badge-count badge-req">{{ $newTutorReqs }}</span>
                @endif
            </a>
        </li>
        <li>
            <a href="/tutor/messages" class="{{ request()->is('tutor/messages*') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span>Messages</span>
                @if($unreadTutorMsgs > 0)
                    <span class="badge-count badge-msg">{{ $unreadTutorMsgs }}</span>
                @endif
            </a>
        </li>
        <li>
            <a href="/tutor/bookings" class="{{ request()->is('tutor/bookings*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Booking Requests</span>
                @if($newTutorBookings > 0)
                    <span class="badge-count badge-bk">{{ $newTutorBookings }}</span>
                @endif
            </a>
        </li>
        <li>
            <a href="/tutor/study-materials" class="{{ request()->is('tutor/study-materials*') ? 'active' : '' }}">
                <i class="fas fa-book-open"></i>
                <span>Study Materials</span>
            </a>
        </li>
        <li>
            <a href="/tutor/reviews" class="{{ request()->is('tutor/reviews*') ? 'active' : '' }}">
                <i class="fas fa-star"></i>
                <span>Reviews & Ratings</span>
                @if($unreadTutorReviews > 0)
                    <span class="badge-count badge-rev">{{ $unreadTutorReviews }}</span>
                @endif
            </a>
        </li>
        <li class="logout-item">
            <a href="/logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>