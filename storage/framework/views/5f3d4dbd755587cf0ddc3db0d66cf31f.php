

<?php $__env->startSection('title', 'Edit Profile'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .edit-container {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 30px 5%;
    }
    
    .edit-wrapper {
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
        display: flex;
        justify-content: center;
    }
    
    /* Edit Card - Light Gray */
    .edit-card {
        background: #dacdd5;
        border-radius: 25px;
        padding: 35px;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
    
    .edit-card h2 {
        margin: 0 0 8px;
        font-size: 1.5rem;
        color: #1a1a2e;
        text-align: center;
        font-weight: 700;
    }
    
    .edit-card p {
        color: #666;
        margin-bottom: 25px;
        text-align: center;
        font-size: 0.85rem;
    }
    
    /* Profile Picture */
    .profile-section {
        text-align: center;
        margin-bottom: 25px;
    }
    
    .profile-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto 15px;
        border: 4px solid #4a6cf7;
        overflow: hidden;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 15px rgba(74,108,247,0.2);
    }
    
    .profile-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-preview .no-image {
        font-size: 2.5rem;
        color: #999;
    }
    
    .upload-btn label {
        background: #4a6cf7;
        color: white;
        padding: 6px 20px;
        border-radius: 25px;
        cursor: pointer;
        display: inline-block;
        font-size: 0.8rem;
        transition: all 0.3s;
    }
    
    .upload-btn label:hover {
        background: #3a5bd0;
        transform: translateY(-2px);
    }
    
    .upload-btn input {
        display: none;
    }
    
    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-size: 0.85rem;
    }
    
    .form-group input, .form-group select, .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e8e8e8;
        border-radius: 12px;
        font-size: 0.9rem;
        transition: all 0.3s;
        background: white;
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
    
    /* Save Button */
    .btn-save {
        width: 100%;
        background: linear-gradient(135deg, #3a9793, #6c5ce7);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 10px;
        transition: all 0.3s;
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(74,108,247,0.4);
    }
    
    .alert {
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    @media (max-width: 768px) {
        .edit-wrapper {
            flex-direction: column;
        }
        .sidebar {
            width: 100%;
            position: static;
        }
        .form-row {
            grid-template-columns: 1fr;
        }
        .edit-card {
            padding: 25px;
        }
    }
</style>

<div class="edit-container">
    <div class="edit-wrapper">
        
        <?php echo $__env->make('tutor.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <div class="main-content">
            <div class="edit-card">
                <h2>Edit Profile</h2>
                <p>Update your personal information</p>
                
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
                <?php endif; ?>
                
                <div class="profile-section">
                    <div class="profile-preview" id="preview">
                        <?php if($tutor->profile_picture): ?>
                            <img src="<?php echo e($tutor->profile_picture); ?>" alt="Profile">
                        <?php else: ?>
                            <div class="no-image">📷</div>
                        <?php endif; ?>
                    </div>
                    <div class="upload-btn">
                        <label>
                            📸 Change Profile Picture
                            <input type="file" id="profilePic" accept="image/*">
                        </label>
                    </div>
                </div>
                
                <form action="/tutor/profile/update" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo e(old('name', $tutor->name)); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo e(old('email', $tutor->email)); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Bio / About Me</label>
                        <textarea name="bio" rows="3"><?php echo e(old('bio', $tutor->bio)); ?></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label> Hourly Rate (Rs)</label>
                            <input type="number" name="hourly_rate" value="<?php echo e(old('hourly_rate', $tutor->hourly_rate)); ?>" placeholder="1500">
                        </div>
                        <div class="form-group">
                            <label> Availability</label>
                            <select name="availability">
                                <option value="">Select</option>
                                <option value="Weekdays" <?php echo e($tutor->availability == 'Weekdays' ? 'selected' : ''); ?>>Weekdays</option>
                                <option value="Weekends" <?php echo e($tutor->availability == 'Weekends' ? 'selected' : ''); ?>>Weekends</option>
                                <option value="Both" <?php echo e($tutor->availability == 'Both' ? 'selected' : ''); ?>>Both</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label> Subject</label>
                        <input type="text" name="subject" value="<?php echo e(old('subject', $tutor->subject)); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Qualification</label>
                        <input type="text" name="qualification" value="<?php echo e(old('qualification', $tutor->qualification)); ?>" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Experience (Years)</label>
                            <input type="number" name="experience" value="<?php echo e(old('experience', $tutor->experience)); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" value="<?php echo e(old('location', $tutor->location)); ?>" required>
                        </div>
                    </div>
                    
                    <input type="hidden" name="profile_picture" id="profilePictureBase64">
                    
                    <button type="submit" class="btn-save">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('profilePic').onchange = function(e) {
        const file = e.target.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('preview').innerHTML = `<img src="${ev.target.result}">`;
                document.getElementById('profilePictureBase64').value = ev.target.result;
            };
            reader.readAsDataURL(file);
        }
    };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/tutor/edit-profile.blade.php ENDPATH**/ ?>