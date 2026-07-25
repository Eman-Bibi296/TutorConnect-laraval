

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
    
    /* ========== SIDEBAR STYLES - SAME AS DASHBOARD ========== */
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
    
    .badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 50%;
        font-size: 0.7rem;
        font-weight: 600;
        margin-left: 10px;
        color: white;
    }
    .badge-message { background: #4a6cf7; }
    .badge-request { background: #ffc107; color: #333; }
    .badge-booking { background: #28a745; }
    
    .logout-link {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    /* ========== END SIDEBAR STYLES ========== */
    
    .main-content {
        flex: 1;
    }
    
    .card {
        background: #dab6b6;
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
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
    }
    
    .form-group input, .form-group select, .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
    }
    
    .btn-upload {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
    }
    
    .materials-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .materials-table th, .materials-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    
    .btn-delete {
        background: #dc3545;
        color: white;
        padding: 5px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.8rem;
    }
    
    .alert {
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
    }
</style>

<div class="materials-container">
    <div class="materials-wrapper">
        
        <?php echo $__env->make('tutor.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <div class="main-content">
            <div class="card">
                <h3 class="card-title">Upload Study Material</h3>
                <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>
                <form action="/tutor/upload-material" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group"><label>Title</label><input type="text" name="title" required></div>
                    <div class="form-group">
                        <label>Material Type</label>
                        <select name="material_type" required>
                            <option value="">Select Type</option>
                            <option value="PDF Notes">📄 PDF Notes</option>
                            <option value="Assignment">📝 Assignment</option>
                            <option value="Past Paper">📋 Past Paper</option>
                            <option value="MCQs">❓ MCQs</option>
                            <option value="Lecture Slides">📊 Lecture Slides</option>
                            <option value="Word Document">📃 Word Document</option>
                            <option value="Practice Exercise">✏️ Practice Exercise</option>
                            <option value="Study Guide">📖 Study Guide</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Description (Optional)</label><textarea name="description" rows="3"></textarea></div>
                    <div class="form-group"><label>File (PDF, DOC, DOCX, PPT, PPTX, TXT - Max 10MB)</label><input type="file" name="file" required></div>
                    <button type="submit" class="btn-upload"> Upload Material</button>
                </form>
            </div>
            
            <div class="card">
                <h3 class="card-title">My Uploaded Materials</h3>
                <table class="materials-table">
                    <thead><tr><th>Title</th><th>Type</th><th>Uploaded</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr><td><?php echo e($material->title); ?></td><td><?php echo e($material->material_type); ?></td><td><?php echo e($material->created_at->format('M d, Y')); ?></td><td><a href="/tutor/material/delete/<?php echo e($material->id); ?>" class="btn-delete" onclick="return confirm('Delete?')">Delete</a></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <td><td colspan="4" style="text-align:center;">No materials uploaded yet</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/tutor/study-materials.blade.php ENDPATH**/ ?>