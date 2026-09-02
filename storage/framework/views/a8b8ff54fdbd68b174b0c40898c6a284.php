<?php $__env->startSection('title', 'My Requests - TutorConnect'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .requests-container {
        padding: 35px 5%;
        background: #F8FAFC;
        min-height: calc(100vh - 180px);
        font-family: 'Poppins', sans-serif;
    }
    .dashboard-wrapper {
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
    .status-accepted { background: #ECFDF5; color: #059669; border: 1px solid #A7F3D0; }
    .status-pending { background: #FFFBEB; color: #D97706; border: 1px solid #FDE68A; }
    .status-rejected { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }

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
    }
    .btn-action-view { background: #ECFDF5; color: #059669; border: 1px solid #A7F3D0; }
    .btn-action-view:hover { background: #059669; color: white; }
    .btn-action-chat { background: #111827; color: white; }
    .btn-action-chat:hover { background: #1E293B; color: white; }

    .empty-state {
        text-align: center;
        padding: 45px 20px;
        color: #64748B;
    }
    .empty-state i {
        font-size: 3rem;
        color: #94A3B8;
        margin-bottom: 12px;
    }

    @media (max-width: 900px) {
        .dashboard-wrapper {
            flex-direction: column;
        }
    }
</style>

<div class="requests-container">
    <div class="dashboard-wrapper">
        <!-- Student Sidebar -->
        <?php echo $__env->make('student.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1><i class="fa-solid fa-paper-plane"></i> My Tutor Requests</h1>
                <p>Track connection requests sent to tutors and their acceptance status</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number"><?php echo e($requests->count()); ?></div>
                    <div class="stat-label">Total Requests</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #059669;">
                        <?php echo e($requests->where('status', 'accepted')->count()); ?>

                    </div>
                    <div class="stat-label">Accepted</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #D97706;">
                        <?php echo e($requests->where('status', 'pending')->count()); ?>

                    </div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>

            <!-- Request History Table -->
            <div class="data-card">
                <h3><i class="fa-solid fa-list-check" style="color: #059669;"></i> Request History</h3>
                
                <?php if($requests->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Tutor Name</th>
                                    <th>Subject</th>
                                    <th>Hourly Rate</th>
                                    <th>Date Sent</th>
                                    <th>Status</th>
                                    <th style="text-align:right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $t = $req->tutor;
                                        $tutorAvatar = 'images/burhan.png';
                                        if ($t) {
                                            if (!empty($t->profile_picture) && file_exists(public_path($t->profile_picture))) {
                                                $tutorAvatar = $t->profile_picture;
                                            } else {
                                                $firstName = strtolower(explode(' ', str_replace(['Dr.', 'Prof.', 'Mr.', 'Ms.'], '', $t->name))[0] ?? 'burhan');
                                                if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
                                                    $tutorAvatar = 'images/' . $firstName . '.jpg';
                                                } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
                                                    $tutorAvatar = 'images/' . $firstName . '.png';
                                                }
                                            }
                                        }
                                    ?>
                                    <tr>
                                        <td style="font-weight: 700; color: #111827;">
                                        
                                            <?php echo e($t->name ?? 'Tutor'); ?>

                                        </td>
                                        <td><?php echo e($t->subject ?? 'Computer Science'); ?></td>
                                        <td style="font-weight:700; color:#059669;">Rs <?php echo e(number_format($t->hourly_rate ?? 1500)); ?>/hr</td>
                                        <td><?php echo e($req->created_at->format('M d, Y')); ?></td>
                                        <td>
                                            <?php if($req->status == 'accepted'): ?>
                                                <span class="status-badge status-accepted"><i class="fa-solid fa-circle-check"></i> Accepted</span>
                                            <?php elseif($req->status == 'pending'): ?>
                                                <span class="status-badge status-pending"><i class="fa-solid fa-clock"></i> Pending</span>
                                            <?php else: ?>
                                                <span class="status-badge status-rejected"><i class="fa-solid fa-circle-xmark"></i> Declined</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align:right;">
                                            <?php if($t): ?>
                                                <?php if($req->status == 'accepted'): ?>
                                                    <a href="<?php echo e(url('/student/chat-only/' . $t->id)); ?>" class="btn-table-action btn-action-chat me-1" title="Direct Chat">
                                                        <i class="fa-solid fa-comments"></i> Chat
                                                    </a>
                                                    <a href="<?php echo e(url('/student/tutor/' . $t->id)); ?>" class="btn-table-action btn-action-view">
                                                        <i class="fa-solid fa-calendar-plus"></i> Book
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(url('/student/tutor/' . $t->id)); ?>" class="btn-table-action btn-action-view">
                                                        <i class="fa-solid fa-user"></i> View Profile
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fa-regular fa-paper-plane"></i>
                        <h4 class="mt-2" style="font-weight:700; color:#111827;">No Requests Sent Yet</h4>
                        <p class="text-muted small mb-3">Browse instructors and send connection requests to begin learning.</p>
                        <a href="/student/dashboard" class="btn btn-success rounded-pill px-4 fw-bold">
                            <i class="fa-solid fa-magnifying-glass me-1"></i> Find Tutors
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/student/my-requests.blade.php ENDPATH**/ ?>