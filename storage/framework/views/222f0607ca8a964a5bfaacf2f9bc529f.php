

<?php $__env->startSection('title', 'My Bookings'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .bookings-container {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 30px 5%;
    }
    
    .bookings-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Sidebar Styles */
    .sidebar {
        width: 280px;
        background: white;
        border-radius: 25px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        height: fit-content;
        position: sticky;
        top: 30px;
    }
    
    .sidebar-logo {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f4f8;
    }
    
    .sidebar-logo h2 {
        margin: 0;
        font-size: 1.5rem;
        color: #1a1a2e;
    }
    
    .sidebar-logo span {
        color: #4a6cf7;
    }
    
    .sidebar-logo p {
        font-size: 0.7rem;
        color: #999;
        margin: 5px 0 0;
    }
    
    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-menu li {
        margin-bottom: 8px;
    }
    
    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        color: #555;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s;
        font-weight: 500;
    }
    
    .sidebar-menu a:hover {
        background: #f0f4f8;
        color: #4a6cf7;
    }
    
    .sidebar-menu a.active {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
    }
    
    .logout-link {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    
    /* Main Content */
    .main-content {
        flex: 1;
    }
    
    .page-header {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        border-radius: 20px;
        padding: 25px;
        color: white;
        margin-bottom: 30px;
    }
    
    .page-header h1 {
        margin: 0;
        font-size: 1.5rem;
    }
    
    .page-header p {
        margin: 10px 0 0;
        opacity: 0.9;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #4a6cf7;
    }
    
    .stat-label {
        color: #666;
        font-size: 0.8rem;
        margin-top: 5px;
    }
    
    .bookings-table {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th {
        text-align: left;
        padding: 12px;
        background: #f8f9fc;
        border-bottom: 2px solid #eee;
    }
    
    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }
    
    .status-pending {
        background: #ffc107;
        color: #333;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        display: inline-block;
    }
    
    .status-confirmed {
        background: #28a745;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        display: inline-block;
    }
    
    .status-cancelled {
        background: #dc3545;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        display: inline-block;
    }
    
    .btn-cancel {
        background: #dc3545;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        cursor: pointer;
    }
    
    .no-bookings {
        text-align: center;
        padding: 50px;
        color: #999;
    }
</style>

<div class="bookings-container">
    <div class="bookings-wrapper">
        
        <?php echo $__env->make('student.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <div class="main-content">
            <div class="page-header">
                <h1>📅 My Bookings</h1>
                <p>View and manage your tutoring session bookings</p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number"><?php echo e($totalBookings ?? 0); ?></div>
                    <div class="stat-label">TOTAL BOOKINGS</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo e($pendingBookings ?? 0); ?></div>
                    <div class="stat-label">PENDING</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo e($confirmedBookings ?? 0); ?></div>
                    <div class="stat-label">CONFIRMED</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo e($upcomingBookings ?? 0); ?></div>
                    <div class="stat-label">UPCOMING</div>
                </div>
            </div>
            
            <div class="bookings-table">
                <h3 style="margin-top:0;">📋 Booking List</h3>
                <tr>
                    <thead>
                        <tr>
                            <th>Tutor</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Mode</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($booking->tutor->name ?? 'N/A'); ?></td>
                            <td><?php echo e($booking->tutor->subject ?? 'N/A'); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y')); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($booking->preferred_time)->format('h:i A')); ?></td>
                            <td><?php echo e($booking->mode); ?></td>
                            <td>
                                <?php if($booking->status == 'pending'): ?>
                                    <span class="status-pending">Pending</span>
                                <?php elseif($booking->status == 'confirmed'): ?>
                                    <span class="status-confirmed">Confirmed ✓</span>
                                <?php else: ?>
                                    <span class="status-cancelled">Cancelled</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($booking->status == 'pending'): ?>
                                <form action="/student/cancel-booking" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="booking_id" value="<?php echo e($booking->id); ?>">
                                    <button type="submit" class="btn-cancel" onclick="return confirm('Cancel this booking?')">Cancel</button>
                                </form>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="no-bookings">No bookings yet. Book a session with a tutor!</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // ==================== MARK BOOKINGS AS VIEWED WHEN PAGE LOADS ====================
    fetch('/student/mark-bookings-viewed', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/student/my-bookings.blade.php ENDPATH**/ ?>