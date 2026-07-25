<!-- ===== ADMIN NAVBAR ===== -->
<nav style="
    background: #1a1a2e;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    position: sticky;
    top: 0;
    z-index: 999;
">
    <!-- Logo -->
    <div>
        <a href="/admin/dashboard" style="
            color: white;
            font-size: 1.3rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        ">
            <span style="font-size: 1.5rem;">📚</span>
            Tutor<span style="color: #4a6cf7;">Connect</span>
            <span style="
                background: rgba(74, 108, 247, 0.2);
                color: #4a6cf7;
                font-size: 0.6rem;
                padding: 2px 10px;
                border-radius: 20px;
                font-weight: 600;
            ">ADMIN</span>
        </a>
    </div>
    
    <!-- Admin Info -->
    <div style="display: flex; align-items: center; gap: 20px;">
        <!-- Admin Name -->
        <span style="
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            font-weight: 500;
        ">
            👑 <?php echo e(Session::get('admin_name', 'Admin')); ?>

        </span>
        
        <!-- Logout Button -->
        <a href="/admin/logout" style="
            color: #ff6b6b;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 8px 20px;
            border: 1px solid #ff6b6b;
            border-radius: 8px;
            transition: all 0.3s;
        "
        onmouseover="this.style.background='#ff6b6b'; this.style.color='white';"
        onmouseout="this.style.background='transparent'; this.style.color='#ff6b6b';"
        onclick="return confirm('Are you sure you want to logout?')"
        >
            🚪 Logout
        </a>
    </div>
</nav><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/admin/partials/navbar.blade.php ENDPATH**/ ?>