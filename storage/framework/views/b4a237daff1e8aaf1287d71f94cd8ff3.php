

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="stats-grid">
    <div class="stat-card"><div class="stat-number"><?php echo e($totalStudents); ?></div><div class="stat-label">Total Students</div></div>
    <div class="stat-card"><div class="stat-number"><?php echo e($totalTutors); ?></div><div class="stat-label">Total Tutors</div></div>
    <div class="stat-card"><div class="stat-number"><?php echo e($totalRequests); ?></div><div class="stat-label">Total Requests</div></div>
    <div class="stat-card"><div class="stat-number"><?php echo e($totalBookings); ?></div><div class="stat-label">Total Bookings</div></div>
    <div class="stat-card"><div class="stat-number"><?php echo e($pendingTutors); ?></div><div class="stat-label">Pending Tutors</div></div>
    <div class="stat-card"><div class="stat-number">$<?php echo e($totalRevenue); ?></div><div class="stat-label">Total Revenue</div></div>
</div>

<div class="section-card">
    <h3 class="section-title">📋 Recent Bookings</h3>
    <table>
        <thead><tr><th>Student</th><th>Tutor</th><th>Date</th><th>Status</th></tr></thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr><td><?php echo e($booking->student->name ?? 'N/A'); ?></td><td><?php echo e($booking->tutor->name ?? 'N/A'); ?></td><td><?php echo e($booking->preferred_date); ?></td><td><?php echo e(ucfirst($booking->status)); ?></td></tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="4" style="text-align:center">No bookings yet</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>