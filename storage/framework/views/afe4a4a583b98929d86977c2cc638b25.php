

<?php $__env->startSection('title', 'Book a Session'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .booking-container {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 30px 5%;
    }
    
    .booking-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Sidebar Styles - Same as Dashboard */
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
    
    .booking-card {
        background: white;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        max-width: 700px;
        margin: 0 auto;
    }
    
    .booking-header {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        padding: 30px;
        text-align: center;
        color: white;
    }
    
    .booking-header h2 {
        margin: 0;
        font-size: 1.8rem;
    }
    
    .booking-header p {
        margin: 10px 0 0;
        opacity: 0.9;
    }
    
    .tutor-info {
        display: flex;
        align-items: center;
        gap: 15px;
        background: #f8f9fc;
        padding: 20px;
        margin: 20px;
        border-radius: 20px;
    }
    
    .tutor-details h3 {
        margin: 0;
        font-size: 1.2rem;
    }
    
    .tutor-details p {
        margin: 5px 0 0;
        color: #666;
        font-size: 0.8rem;
    }
    
    .booking-form {
        padding: 20px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }
    
    .form-group input, .form-group select, .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 1rem;
    }
    
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        border-color: #4a6cf7;
        outline: none;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    
    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 20px;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
    }
    
    .back-btn {
        display: inline-block;
        margin: 20px;
        color: #4a6cf7;
        text-decoration: none;
    }
    
    .alert {
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 15px;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
    }
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
    }
    
    @media (max-width: 768px) {
        .booking-wrapper {
            flex-direction: column;
        }
        .sidebar {
            width: 100%;
            position: static;
        }
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="booking-container">
    <div class="booking-wrapper">
        
        <!-- Sidebar -->
        <?php echo $__env->make('student.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <div class="main-content">
            <div class="booking-card">
                <div class="booking-header">
                    <h2>📅 Book a Session</h2>
                    <p>Schedule your tutoring session</p>
                </div>
                
                <!-- Tutor Info -->
                <div class="tutor-info">
                    <div class="tutor-details">
                        <h3><?php echo e($tutor->name); ?></h3>
                        <p><?php echo e($tutor->subject); ?> • <?php echo e($tutor->location); ?></p>
                        <p style="color:#4a6cf7; font-weight:600;">Rs <?php echo e($tutor->hourly_rate ?? $tutor->experience * 100 + 1000); ?>/hour</p>
                    </div>
                </div>
                
                <form action="/student/book-session" method="POST" class="booking-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="tutor_id" value="<?php echo e($tutor->id); ?>">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label> Preferred Date</label>
                            <input type="date" name="preferred_date" required>
                        </div>
                        <div class="form-group">
                            <label>Preferred Time</label>
                            <input type="time" name="preferred_time" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label> Teaching Mode</label>
                            <select name="mode" required>
                                <option value="">Select Mode</option>
                                <option value="Online">Online</option>
                                <option value="On-site">On-site</option>
                                <option value="Both">Both</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Sessions per week</label>
                            <select name="sessions_per_week" required>
                                <option value="">Select</option>
                                <option value="1">1 session per week</option>
                                <option value="2">2 sessions per week</option>
                                <option value="3">3 sessions per week</option>
                                <option value="4">4 sessions per week</option>
                                <option value="5">5 sessions per week</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>💬 Message to Tutor</label>
                        <textarea name="message" rows="3" placeholder="Tell the tutor about your goals, level and what you want to focus on..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit">✅ Submit Booking Request</button>
                </form>
                
                <a href="/student/dashboard" class="back-btn">← Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/student/book-session-only.blade.php ENDPATH**/ ?>