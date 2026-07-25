

<?php $__env->startSection('title', 'Study Materials'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .materials-container {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 30px 5%;
    }
    
    .materials-wrapper {
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
    
    .card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .card-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 20px;
        border-left: 4px solid #4a6cf7;
        padding-left: 15px;
    }
    
    .materials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .material-card {
        background: #f8f9fc;
        border-radius: 15px;
        padding: 20px;
        transition: transform 0.3s;
    }
    
    .material-card:hover {
        transform: translateY(-5px);
    }
    
    .material-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }
    
    .material-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 5px;
    }
    
    .material-type {
        font-size: 0.8rem;
        color: #4a6cf7;
        margin-bottom: 8px;
    }
    
    .material-meta {
        font-size: 0.7rem;
        color: #999;
        margin-bottom: 12px;
    }
    
    .btn-download {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
        padding: 8px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.8rem;
        display: inline-block;
    }
</style>

<div class="materials-container">
    <div class="materials-wrapper">
        
        <?php echo $__env->make('student.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <div class="main-content">
            <div class="card">
                <h3 class="card-title">📚 Study Materials</h3>
                
                <div class="materials-grid">
                    <?php $__empty_1 = true; $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="material-card">
                        <div class="material-icon">
                            <?php if(str_contains($material->material_type, 'PDF')): ?> 📄
                            <?php elseif(str_contains($material->material_type, 'Assignment')): ?> 📝
                            <?php elseif(str_contains($material->material_type, 'Paper')): ?> 📋
                            <?php elseif(str_contains($material->material_type, 'MCQ')): ?> ❓
                            <?php elseif(str_contains($material->material_type, 'Slide')): ?> 📊
                            <?php else: ?> 📁
                            <?php endif; ?>
                        </div>
                        <div class="material-title"><?php echo e($material->title); ?></div>
                        <div class="material-type"><?php echo e($material->material_type); ?></div>
                        <div class="material-meta">
                            By: <?php echo e($material->tutor->name); ?> • <?php echo e($material->created_at->format('M d, Y')); ?>

                        </div>
                        <div class="material-description" style="font-size:0.8rem; color:#666; margin-bottom:12px;">
                            <?php echo e(Str::limit($material->description, 60)); ?>

                        </div>
                        <a href="/student/material/download/<?php echo e($material->id); ?>" class="btn-download">📥 Download</a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div style="text-align:center; padding:50px; color:#999; grid-column:1/-1;">
                        No study materials available yet. Check back later!
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/student/study-materials.blade.php ENDPATH**/ ?>