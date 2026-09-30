<?php $__env->startSection('title', 'Login - TutorConnect'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .login-container {
        min-height: calc(100vh - 220px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 20px;
        background: #F8FAFC;
    }
    
    .login-card {
        background: white;
        border-radius: 24px;
        padding: 40px 35px;
        max-width: 480px;
        width: 100%;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
        border: 1px solid #E2E8F0;
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .login-card h2 {
        color: #111827;
        font-weight: 800;
        font-size: 1.8rem;
        margin-bottom: 6px;
    }
    
    .login-card p {
        color: #64748B;
        font-size: 0.95rem;
        margin-bottom: 0;
    }
    
    .user-type-toggle {
        display: flex;
        gap: 12px;
        margin-bottom: 25px;
        background: #F1F5F9;
        padding: 6px;
        border-radius: 16px;
    }
    
    .user-option {
        flex: 1;
        text-align: center;
        padding: 12px 10px;
        border: 2px solid transparent;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.25s ease;
        background: transparent;
        color: #475569;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        user-select: none;
    }
    
    .user-option:hover {
        color: #1E293B;
    }
    
    .user-option.selected {
        background: white;
        color: #059669;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        border-color: rgba(5, 150, 105, 0.2);
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #1E293B;
        font-size: 0.9rem;
    }
    
    .form-group input {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #CBD5E1;
        border-radius: 12px;
        font-size: 0.98rem;
        transition: all 0.2s ease;
        background: #FFFFFF;
        outline: none;
    }
    
    .form-group input:focus {
        border-color: #059669;
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.12);
    }
    
    .btn-login-submit {
        width: 100%;
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        padding: 13px;
        border: none;
        border-radius: 12px;
        font-size: 1.05rem;
        font-weight: 700;
        cursor: pointer;
        margin-top: 10px;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .btn-login-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(5, 150, 105, 0.45);
        color: white;
    }
    
    .register-link {
        text-align: center;
        margin-top: 22px;
        color: #64748B;
        font-size: 0.92rem;
    }
    
    .register-link a {
        color: #059669;
        text-decoration: none;
        font-weight: 700;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    .auth-alert {
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .auth-alert-danger {
        background: #FEF2F2;
        color: #991B1B;
        border: 1px solid #FECACA;
    }

    .auth-alert-success {
        background: #ECFDF5;
        color: #065F46;
        border: 1px solid #A7F3D0;
    }
     .password-wrapper {
     position: relative;
 }
 .password-wrapper input {
     padding-right: 45px;
 }
 .toggle-password {
     position: absolute;
    right: 14px;
     top: 50%;
     transform: translateY(-50%);
    cursor: pointer;
     color: #94A3B8;
     font-size: 1rem;
 }
 .toggle-password:hover {
     color: #059669;
 }
    
</style>

<div class="login-container">
    <div class="login-card animate-fade-in-up">
        <div class="login-header">
            <h2>Welcome Back</h2>
            <p>Access your TutorConnect account</p>
        </div>
        
        <?php if(session('error')): ?>
            <div class="auth-alert auth-alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div><?php echo e(session('error')); ?></div>
            </div>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <div class="auth-alert auth-alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <div><?php echo e(session('success')); ?></div>
            </div>
        <?php endif; ?>
        
        <div class="user-type-toggle">
            <div class="user-option selected" id="studentOption" onclick="selectUserType('student')">
                <i class="fas fa-user-graduate"></i>
                <span>Student</span>
            </div>
            <div class="user-option" id="tutorOption" onclick="selectUserType('tutor')">
                <i class="fas fa-chalkboard-user"></i>
                <span>Tutor</span>
            </div>
        </div>
        
        <form id="loginForm" action="/student/login" method="POST" autocomplete="off">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label><i class="fas fa-envelope me-1 text-muted"></i> Email Address</label>
                <input type="email" id="loginEmail" name="email" placeholder="name@example.com" autocomplete="off" required>
            </div>
            
            <div class="form-group">
                <label><i class="fas fa-lock me-1 text-muted"></i> Password</label>
                <div class="password-wrapper">
                <input type="password" name="password" id="loginPassword" placeholder="Enter your password" autocomplete="new-password" required>
               <i class="fa-solid fa-eye toggle-password" onclick="togglePasswordField('loginPassword', this)"></i>
        </div>
                 <div style="text-align: right; margin-top: 8px;">
        <a href="/forgot-password" style="color: #059669; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Forgot Password?</a>
    </div>
</div>
            
            
            <button type="submit" class="btn-login-submit">
                <i class="fas fa-sign-in-alt"></i> Login 
            </button>
            
            <div class="register-link">
                Don't have an account? 
                <a href="/student/register" id="primaryRegLink">Student Register</a> | 
                <a href="/tutor/register" id="secondaryRegLink">Tutor Register</a>
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
        const form = document.getElementById('loginForm');
        
        if (type === 'student') {
            studentOption.classList.add('selected');
            tutorOption.classList.remove('selected');
            form.action = '/student/login';
        } else {
            tutorOption.classList.add('selected');
            studentOption.classList.remove('selected');
            form.action = '/tutor/login';
        
       }
}

  function togglePasswordField(id, icon) {
      const input = document.getElementById(id);
      if (input.type === 'password') {
          input.type = 'text';
          icon.classList.remove('fa-eye');
         icon.classList.add('fa-eye-slash');
     } else {
          input.type = 'password';
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
     }
  
 }


    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/auth/login.blade.php ENDPATH**/ ?>