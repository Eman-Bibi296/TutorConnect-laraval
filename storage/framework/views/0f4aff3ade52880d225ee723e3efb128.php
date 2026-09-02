<?php $__env->startSection('title', 'Session Bookings - Tutor Portal - TutorConnect'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .bookings-container {
        padding: 35px 5%;
        background: #F8FAFC;
        min-height: calc(100vh - 180px);
        font-family: 'Poppins', sans-serif;
    }
    .bookings-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    .main-content {
        flex: 1;
        min-width: 0;
    }
    
    .page-header {
        background: linear-gradient(135deg, #111827 0%, #1e293b 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: white;
        margin-bottom: 28px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .page-header h1 {
        font-size: 1.6rem;
        font-weight: 800;
        margin: 0;
    }
    .page-header p {
        color: #94A3B8;
        margin: 8px 0 0;
        font-size: 0.95rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: white;
        border-radius: 18px;
        padding: 22px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
        transition: all 0.25s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        border-color: #10B981;
    }
    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: #059669;
        margin-bottom: 4px;
    }
    .stat-label {
        color: #64748B;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .data-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
    }
    .data-card h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-responsive {
        overflow-x: auto;
    }
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .custom-table th {
        text-align: left;
        padding: 12px 16px;
        background: #F8FAFC;
        color: #475569;
        font-size: 0.8rem;
        font-weight: 700;
        border-bottom: 1px solid #E2E8F0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .custom-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #F1F5F9;
        color: #334155;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
    }
    .status-confirmed { background: #ECFDF5; color: #059669; border: 1px solid #A7F3D0; }
    .status-completed { background: #EEF2FF; color: #4F46E5; border: 1px solid #C7D2FE; }
    .status-pending { background: #FFFBEB; color: #D97706; border: 1px solid #FDE68A; }

    .btn-table-action {
        padding: 6px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.82rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-action-complete { background: #3B82F6; color: white; }
    .btn-action-complete:hover { background: #2563EB; color: white; }
    .btn-action-chat { background: #111827; color: white; }
    .btn-action-chat:hover { background: #1E293B; color: white; }

    @media (max-width: 900px) {
        .bookings-wrapper {
            flex-direction: column;
        }
    }
</style>

<div class="bookings-container">
    <div class="bookings-wrapper">
        <!-- Tutor Sidebar -->
        <?php echo $__env->make('tutor.Partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1><i class="fa-solid fa-calendar-check"></i> Session Bookings</h1>
                <p>Manage and conduct scheduled tutoring sessions with enrolled students</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number"><?php echo e($bookings->count()); ?></div>
                    <div class="stat-label">Total Bookings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #059669;">
                        <?php echo e($bookings->where('status', 'confirmed')->count()); ?>

                    </div>
                    <div class="stat-label">Confirmed Sessions</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #D97706;">
                        <?php echo e($bookings->where('status', 'pending')->count()); ?>

                    </div>
                    <div class="stat-label">Pending Approval</div>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success rounded-4 mb-4 border-0 shadow-sm">
                    <i class="fa-solid fa-circle-check me-2"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger rounded-4 mb-4 border-0 shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <!-- Bookings List -->
            <div class="data-card">
                <h3><i class="fa-solid fa-calendar-days" style="color:var(--primary);"></i> Scheduled Sessions</h3>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Subject / Goal</th>
                                <th>Scheduled Time</th>
                                <th>Mode</th>
                                <th>Status</th>
                                <th style="text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $studentName = $booking->student->name ?? 'Student';
                                    $firstName = strtolower(explode(' ', $studentName)[0]);
                                    $studentAvatar = 'images/eman.jpg';
                                    if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
                                        $studentAvatar = 'images/' . $firstName . '.jpg';
                                    } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
                                        $studentAvatar = 'images/' . $firstName . '.png';
                                    }
                                ?>
                                <tr>
                                    <td style="font-weight: 700; color: #111827;">
                                        
                                        <?php echo e($studentName); ?>

                                    </td>
                                    <td><?php echo e($booking->topic ?? 'Course syllabus revision'); ?></td>
                                    <td>
                                        <strong><?php echo e($booking->preferred_date ? \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') : date('M d, Y')); ?></strong><br>
                                        <small class="text-muted"><?php echo e($booking->formatted_time); ?></small>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">Online 1-on-1</span></td>
                                    










                                    <td>
    <?php if($booking->status == 'confirmed' && !$booking->tutor_confirmed): ?>
        <span class="status-badge status-pending"><i class="fa-solid fa-clock"></i> Payment Received</span>
    <?php elseif($booking->status == 'confirmed' && $booking->tutor_confirmed): ?>
        <span class="status-badge status-confirmed"><i class="fa-solid fa-circle-check"></i> Confirmed</span>
    <?php elseif($booking->status == 'completed'): ?>
        <span class="status-badge status-completed"><i class="fa-solid fa-award"></i> Completed</span>
    <?php else: ?>
        <span class="status-badge status-pending"><i class="fa-solid fa-clock"></i> <?php echo e(ucfirst($booking->status)); ?></span>
    <?php endif; ?>
</td>
<td style="text-align:right;">
    <a href="/tutor/messages" class="btn-table-action btn-action-chat me-1">
        <i class="fa-solid fa-comment"></i> Chat
    </a>
    <?php if($booking->status == 'confirmed' && !$booking->tutor_confirmed): ?>
        <form action="/tutor/confirm-payment" method="POST" style="display:inline-block;">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="booking_id" value="<?php echo e($booking->id); ?>">
            <button type="submit" class="btn-table-action btn-action-complete">
                <i class="fa-solid fa-circle-check"></i> Confirm Payment
            </button>
        </form>
    <?php elseif($booking->status == 'confirmed' && $booking->tutor_confirmed): ?>
        <form action="/tutor/complete-session" method="POST" style="display:inline-block;">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="booking_id" value="<?php echo e($booking->id); ?>">
            <button type="submit" class="btn-table-action btn-action-complete">
                <i class="fa-solid fa-award"></i> Complete
            </button>
        </form>
    <?php endif; ?>
</td>






                                    
                                    
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No scheduled sessions found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/tutor/bookings.blade.php ENDPATH**/ ?>