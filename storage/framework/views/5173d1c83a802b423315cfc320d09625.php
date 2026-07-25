

<?php $__env->startSection('title', 'Admin Login'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px;
        background: linear-gradient(135deg, #d5d5e2, #dbdfe9);
    }
    .login-card {
        background: white;
        border-radius: 30px;
        padding: 40px;
        max-width: 450px;
        width: 100%;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
    .login-card h2 {
        text-align: center;
        margin-bottom: 10px;
        color: #1a1a2e;
    }
    .login-card p {
        text-align: center;
        color: #666;
        margin-bottom: 30px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .form-group input {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
    }
    .btn-login {
        width: 100%;
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
        padding: 12px;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
    }
    .alert {
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
    }
</style>

<div class="login-container">
    <div class="login-card">
        <h2>Admin Login</h2>
        <p>Enter your credentials to access dashboard</p>
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        
        <form action="/admin/login" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="admin@tutorconnect.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="********" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/admin/login.blade.php ENDPATH**/ ?>