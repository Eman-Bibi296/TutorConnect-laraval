

<?php $__env->startSection('title', 'Student Register'); ?>

<?php $__env->startSection('content'); ?>
<div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 50px;">
    <div style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); width: 100%; max-width: 500px;">
        <h2 style="text-align: center; margin-bottom: 30px;">Student Registration</h2>
        
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
        <?php endif; ?>
        
        <form action="/student/register" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Location</label>
                <input type="text" name="location" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class="text-center mt-3">Already have an account? <a href="/student/login">Login</a></p>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/auth/student-register.blade.php ENDPATH**/ ?>