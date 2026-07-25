<!-- ============================================================ -->
<!-- STUDENT SIDEBAR - COMPLETE CODE                               -->
<!-- ============================================================ -->

<style>
    /* ===== SIDEBAR CONTAINER ===== */
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
    
    /* ===== PROFILE SECTION (TOP) ===== */
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
    
    /* ===== MENU ITEMS ===== */
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
        color: rgba(255, 255, 255, 0.7);;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 0.95rem;
        position: relative;
    }
    
    .sidebar-menu a:hover {
        background: rgba(255,255,255,0.08);
        color: #ffffff;  ;
        transform: translateX(5px);
    }
    
    /* ===== ACTIVE LINK - BLUE GRADIENT ===== */
    .sidebar-menu a.active {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
        box-shadow: 0 4px 15px rgba(74, 108, 247, 0.3);
    }
    
    .sidebar-menu a.active:hover {
        transform: translateX(5px);
    }
     /* ===== ICON STYLES - CHOTA SIZE ===== */
    .sidebar-menu a .icon {
        width: 28px;
        height: 28px;
        object-fit: contain;
        flex-shrink: 0;
        filter: none;

        transition: filter 0.3s ease;
    }
    
    .sidebar-menu a:hover .icon {
        filter: invert(1);
    }
    
    .sidebar-menu a.active .icon {
        filter: invert(1);
    }
    
    /* ===== BADGES (NOTIFICATIONS) ===== */
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
    
    .badge-message {
        background: #4a6cf7;
    }
    
    .badge-request {
        background: #ffc107;
        color: #333;
    }
    
    .badge-booking {
        background: #28a745;
    }
    .badge-materials {
    background: #28a745;  /* ⭐ YELLOW */
    color: #333;
}

    
    /* ===== LOGOUT SECTION (BOTTOM) ===== */
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
    
    /* ===== RESPONSIVE ===== */
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

<!-- ============================================================ -->
<!-- SIDEBAR HTML                                                  -->
<!-- ============================================================ -->

<div class="sidebar">
    
    <!-- ===== PROFILE SECTION ===== -->
    <?php
        use App\Models\Student;
        $studentId = Session::get('student_id');
        $student = Student::find($studentId);
    ?>
    
    <div class="profile-section">
        <a href="/student/dashboard">
            <img src="<?php echo e(asset('images/icon.png')); ?>" alt="Profile" class="profile-icon">
        </a>
        <h3 class="profile-name"><?php echo e($student->name ?? 'Student'); ?></h3>
        <p class="profile-email"><?php echo e($student->email ?? 'student@email.com'); ?></p>
    </div>
    
    <!-- ===== NOTIFICATION COUNTS ===== -->
    <?php
        use Illuminate\Support\Facades\DB;
        use App\Models\RequestModel;
        use App\Models\Message;
        use App\Models\Booking;
        use App\Models\StudyMaterial;  
        $studentId = Session::get('student_id');
        
        // New Messages
        $newMessagesCount = DB::table('messages')
            ->where('receiver_id', $studentId)
            ->where('receiver_type', 'student')
            ->where('is_read', 0)
            ->count();
        
        // New Request Status Changes
        $newRequestChanges = RequestModel::where('student_id', $studentId)
            ->where('status', '!=', 'pending')
            ->where('is_viewed', 0)
            ->count();
        
        // New Bookings Confirmed
        $newBookings = Booking::where('student_id', $studentId)
            ->where('status', 'confirmed')
            ->where('is_viewed', 0)
            ->count();

         // ⭐⭐⭐⭐⭐ YEH 5 LINES ADD KARO ⭐⭐⭐⭐⭐
        
    $acceptedTutorIds = RequestModel::where('student_id', $studentId)
        ->where('status', 'accepted')
        ->pluck('tutor_id')
        ->toArray();
    
    $newMaterials = StudyMaterial::whereIn('tutor_id', $acceptedTutorIds)
        ->where('is_viewed', 0)
        ->count();

               $unreadRequestChanges = $newRequestChanges;
               $unreadBookings = $newBookings;
                  $unreadMaterials = $newMaterials;  // ⭐ YEH LINE IMPORTANT HAI!
    ?>
    
    <!-- ===== MENU ===== -->
    <ul class="sidebar-menu">
        
        <!-- Dashboard -->
        <li>
            <a href="/student/dashboard" class="<?php echo e(request()->is('student/dashboard') ? 'active' : ''); ?>">
                <img src="<?php echo e(asset('images/computer.png')); ?>" alt="Dashboard" class="icon">
                Dashboard
            </a>
        </li>
        
        <!-- My Requests -->
        <li>
            <a href="/student/my-requests" class="<?php echo e(request()->is('student/my-requests*') ? 'active' : ''); ?>">
              <img src="<?php echo e(asset('images/Myrequest.png')); ?>" alt="My Requests" class="icon">
                My Requests
                <?php if(isset($unreadRequestChanges) && $unreadRequestChanges > 0): ?>
                    <span class="badge badge-request"><?php echo e($newRequestChanges); ?></span>
                <?php endif; ?>
            </a>
        </li>
        
        <!-- Messages -->
        <li>
            <a href="/student/messages" class="<?php echo e(request()->is('student/messages*') ? 'active' : ''); ?>">
                 <img src="<?php echo e(asset('images/messages.png')); ?>" alt="Messages" class="icon">
                Messages
                <?php if($newMessagesCount > 0): ?>
                    <span class="badge badge-message"><?php echo e($newMessagesCount); ?></span>
                <?php endif; ?>
            </a>
        </li>
        
        <!-- My Bookings -->
        <li>
            <a href="/student/my-bookings" class="<?php echo e(request()->is('student/my-bookings*') ? 'active' : ''); ?>">
                 <img src="<?php echo e(asset('images/bookingicon.png')); ?>" alt="My Bookings" class="icon">
                 My Booking
                <?php if(isset($unreadBookings) && $unreadBookings > 0): ?>
                    <span class="badge badge-booking"><?php echo e($newBookings); ?></span>
                <?php endif; ?>
            </a>
        </li>
        
        <!-- Study Materials -->
        <li>
            <a href="/student/study-materials" class="<?php echo e(request()->is('student/study-materials*') ? 'active' : ''); ?>">
               <img src="<?php echo e(asset('images/studymaterial.png')); ?>" alt="Study Materials" class="icon">
                Study Materials
                 <?php if(isset($unreadMaterials) && $unreadMaterials > 0): ?>
                <span class="badge badge-materials"><?php echo e($unreadMaterials); ?></span>
            <?php endif; ?>
            </a>
        </li>
        
        <!-- Reviews -->
        <li>
            <a href="/student/reviews" class="<?php echo e(request()->is('student/reviews*') ? 'active' : ''); ?>">
                 <img src="<?php echo e(asset('images/reviewsicon.png')); ?>" alt="Reviews" class="icon">
                Reviews
            </a>
        </li>
        
    </ul>
    
    <!-- ===== LOGOUT ===== -->
    <div class="logout-link">
        <ul class="sidebar-menu">
            <li>
                <a href="/logout">
                    <img src="<?php echo e(asset('images/logout.png')); ?>" alt="Logout" class="icon">
                    Logout
                </a>
            </li>
        </ul>
    </div>
    
</div><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/student/partials/sidebar.blade.php ENDPATH**/ ?>