<?php $__env->startSection('title', 'Student Login - TutorConnect'); ?>

<?php $__env->startSection('content'); ?>
<style>
    :root {
        --primary: #059669;
        --primary-hover: #047857;
        --primary-light: #ECFDF5;
        --accent: #10B981;
        --bg-dark: #111827;
        --bg-light: #F8FAFC;
        --bg-card: #FFFFFF;
        --text-main: #111827;
        --text-muted: #64748B;
        --border-color: #E2E8F0;
    }

    .auth-container {
        min-height: calc(100vh - 220px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 20px;
        background: var(--bg-light);
        font-family: 'Poppins', sans-serif;
    }
    
    .auth-card {
        background: var(--bg-card);
        border-radius: 24px;
        padding: 40px 35px;
        max-width: 480px;
        width: 100%;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
        border: 1px solid var(--border-color);
    }
    
    .auth-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .auth-header-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin: 0 auto 16px;
        border: 2px solid var(--accent);
    }

    .auth-card h2 {
        color: var(--text-main);
        font-weight: 800;
        font-size: 1.8rem;
        margin-bottom: 6px;
    }
    
    .auth-card p {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 0;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-main);
        font-size: 0.9rem;
    }
    
    .form-group input {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #CBD5E1;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background: white;
        outline: none;
        font-family: inherit;
    }
    
    .form-group input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    
    .btn-auth-submit {
        width: 100%;
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        border: none;
        padding: 13px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);
        margin-top: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    
    .btn-auth-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(5, 150, 105, 0.45);
        color: white;
    }
    
    .auth-footer {
        text-align: center;
        margin-top: 25px;
        color: var(--text-muted);
        font-size: 0.9rem;
    }
    
    .auth-footer a {
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
    }
    
    .auth-footer a:hover {
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

<div class="auth-container">
    <div class="auth-card animate-fade-in-up">
        <div class="auth-header">
            <div class="auth-header-icon"><i class="fa-solid fa-graduation-cap"></i></div>
            <h2>Student Login</h2>
            <p>Welcome back! Sign in to access your student dashboard</p>
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
        
        <form action="/student/login" method="POST" autocomplete="off">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label><i class="fa-regular fa-envelope"></i> Email Address</label>
                <input type="email" name="email" placeholder="e.g. eman@student.com" autocomplete="off" required>
            </div>
            
            <div class="form-group">
                <label><i class="fa-solid fa-lock"></i> Password</label>
              <div class="password-wrapper">
        <input type="password" name="password" id="studentPassword" placeholder="••••••••" autocomplete="new-password" required>
      <i class="fa-solid fa-eye toggle-password" onclick="togglePasswordField('studentPassword', this)"></i>
      </div>
                
                <div style="text-align: right; margin-top: 8px;">
      <a href="/forgot-password?type=student" style="color: #059669; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Forgot Password?</a>
     </div>
            </div>
            
            <button type="submit" class="btn-auth-submit">
                <i class="fa-solid fa-right-to-bracket me-1"></i> Sign In to Dashboard
            </button>
        </form>
        
        <div class="auth-footer">
            Don't have an account? <a href="/student/register">Register as Student</a>
        </div>
    </div>
</div>
 <script>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/auth/student-login.blade.php ENDPATH**/ ?>