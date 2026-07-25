

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px;
        background: #f0f4f8;
    }
    
    .login-card {
        background: white;
        border-radius: 30px;
        padding: 40px;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    
    .login-card h2 {
        text-align: center;
        margin-bottom: 10px;
        color: #1a1a2e;
        font-weight: 700;
    }
    
    .login-card p {
        text-align: center;
        color: #666;
        margin-bottom: 30px;
    }
    
    .user-type {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        justify-content: center;
    }
    
    .user-option {
        flex: 1;
        text-align: center;
        padding: 15px;
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s;
        background: white;
    }
    
    .user-option:hover {
        border-color: #8B5A2B;
        background: #f8f9fc;
    }
    
    .user-option.selected {
        border-color: #8B5A2B;
        background: #8B5A2B;
        color: white;
    }
    
    .user-label {
        font-weight: 600;
        font-size: 1rem;
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
    
    .form-group input {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 1rem;
    }
    
    .form-group input:focus {
        border-color: #8B5A2B;
        outline: none;
    }
    
    .btn-login {
        width: 100%;
        background: #8B5A2B;
        color: white;
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 10px;
    }
    
    .btn-login:hover {
        background: #6B4220;
        transform: translateY(-2px);
    }
    
    .register-link {
        text-align: center;
        margin-top: 20px;
        color: #666;
    }
    
    .register-link a {
        color: #8B5A2B;
        text-decoration: none;
        font-weight: 600;
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
    
    .alert-success {
        background: #d4edda;
        color: #155724;
    }
</style>

<div class="login-container">
    <div class="login-card">
        <h2>Welcome Back</h2>
        <p>Login to your account</p>
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        
        <div class="user-type">
            <div class="user-option" id="studentOption" onclick="selectUserType('student')">
                <span class="user-label">Student</span>
            </div>
            <div class="user-option" id="tutorOption" onclick="selectUserType('tutor')">
                <span class="user-label">Tutor</span>
            </div>
        </div>
        
        <form id="loginForm" action="" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" class="btn-login">Login</button>
            
            <div class="register-link">
                Don't have an account? <a href="#" id="registerLink">Register here</a>
            </div>
        </form>
    </div>
</div>

<script>
    let selectedType = 'student';
    
    function selectUserType(type) {
        selectedType = type;
        
        const studentOption = document.getElementById('studentOption');
        const tutorOption = document.getElementById('tutorOption');
        
        if (type === 'student') {
            studentOption.classList.add('selected');
            tutorOption.classList.remove('selected');
            document.getElementById('loginForm').action = '/student/login';
            document.getElementById('registerLink').href = '/student/register';
        } else {
            tutorOption.classList.add('selected');
            studentOption.classList.remove('selected');
            document.getElementById('loginForm').action = '/tutor/login';
            document.getElementById('registerLink').href = '/tutor/register';
        }
    }
    
    selectUserType('student');
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/auth/login.blade.php ENDPATH**/ ?>