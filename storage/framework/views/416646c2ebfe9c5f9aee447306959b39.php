<!-- ============================================================ -->
<!-- STUDENT SIDEBAR - 1:1 VISUAL & DYNAMIC PARITY                 -->
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
    
    .student-profile-badge {
        text-align: center;
        padding-bottom: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid #F1F5F9;
    }
    
    .student-avatar {
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

    .student-profile-badge h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .student-profile-badge p {
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
    .badge-mat { background: #0284C7; }

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

<?php
    use App\Models\Student;
    use App\Models\RequestModel;
    use App\Models\Message;
    use App\Models\Booking;
    use App\Models\StudyMaterial;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;

    $studentId = Session::get('student_id');
    $studentUser = $studentId ? Student::find($studentId) : null;

    $studentAvatar = null;
    if ($studentUser) {
        $firstName = strtolower(explode(' ', $studentUser->name)[0]);
        if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
            $studentAvatar = 'images/' . $firstName . '.jpg';
        } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
            $studentAvatar = 'images/' . $firstName . '.png';
        }
    }

    $unreadMsgCount = $studentId ? DB::table('messages')
        ->where('receiver_id', $studentId)
        ->where('receiver_type', 'student')
        ->where('is_read', 0)
        ->count() : 0;

    $unreadReqCount = $studentId ? RequestModel::where('student_id', $studentId)
        ->where('status', '!=', 'pending')
        ->where('is_viewed', 0)
        ->count() : 0;

    $unreadBkCount = $studentId ? Booking::where('student_id', $studentId)
        ->where('status', 'confirmed')
        ->where('student_viewed', 0)
        ->count() : 0;

    $acceptedTutorIds = $studentId ? RequestModel::where('student_id', $studentId)
        ->where('status', 'accepted')
        ->pluck('tutor_id')
        ->toArray() : [];

    $unreadMatCount = (!empty($acceptedTutorIds)) ? StudyMaterial::whereIn('tutor_id', $acceptedTutorIds)
        ->where('is_viewed', 0)
        ->count() : 0;
?>

<div class="sidebar">
    <div class="student-profile-badge">
    <img src="<?php echo e($studentAvatar ? asset($studentAvatar) : 'https://ui-avatars.com/api/?name=' . urlencode($studentUser->name ?? 'Student') . '&background=ECFDF5&color=059669'); ?>" alt="Student Avatar" class="student-avatar">
        <h4><?php echo e($studentUser->name ?? 'Student'); ?></h4>
        <p><?php echo e($studentUser->email ?? 'student@tutorconnect.com'); ?></p>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="/student/dashboard" class="<?php echo e(request()->is('student/dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-th-large"></i>
                <span>Find Tutors</span>
            </a>
        </li>
        <li>
            <a href="/student/my-requests" class="<?php echo e(request()->is('student/my-requests*') ? 'active' : ''); ?>">
                <i class="fas fa-paper-plane"></i>
                <span>My Requests</span>
                <?php if($unreadReqCount > 0): ?>
                    <span class="badge-count badge-req"><?php echo e($unreadReqCount); ?></span>
                <?php endif; ?>
            </a>
        </li>
        <li>
            <a href="/student/messages" class="<?php echo e(request()->is('student/messages*') ? 'active' : ''); ?>">
                <i class="fas fa-comments"></i>
                <span>Messages</span>
                <?php if($unreadMsgCount > 0): ?>
                    <span class="badge-count badge-msg"><?php echo e($unreadMsgCount); ?></span>
                <?php endif; ?>
            </a>
        </li>
        <li>
            <a href="/student/my-bookings" class="<?php echo e(request()->is('student/my-bookings*') ? 'active' : ''); ?>">
                <i class="fas fa-calendar-alt"></i>
                <span>My Bookings</span>
                <?php if($unreadBkCount > 0): ?>
                    <span class="badge-count badge-bk"><?php echo e($unreadBkCount); ?></span>
                <?php endif; ?>
            </a>
        </li>
        <li>
            <a href="/student/study-materials" class="<?php echo e(request()->is('student/study-materials*') ? 'active' : ''); ?>">
                <i class="fas fa-book-open"></i>
                <span>Study Materials</span>
                <?php if($unreadMatCount > 0): ?>
                    <span class="badge-count badge-mat"><?php echo e($unreadMatCount); ?></span>
                <?php endif; ?>
            </a>
        </li>
        <li>
            <a href="/student/reviews" class="<?php echo e(request()->is('student/reviews*') ? 'active' : ''); ?>">
                <i class="fas fa-star"></i>
                <span>Reviews</span>
            </a>
        </li>
        <li class="logout-item">
            <a href="/logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/student/partials/sidebar.blade.php ENDPATH**/ ?>