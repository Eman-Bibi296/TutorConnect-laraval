

<?php $__env->startSection('title', 'Complete Your Profile'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .profile-container {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 50px 5%;
    }
    .profile-card {
        background: white;
        border-radius: 30px;
        max-width: 700px;
        margin: 0 auto;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .profile-header {
        background: #ffffff;
        padding: 30px;
        text-align: center;
        color: #1a1a2e;
        border-bottom: 2px solid #f0f4f8;
    }
    .profile-header h2 {
        margin: 0;
        font-size: 1.8rem;
        color: #1a1a2e;
    }
    .profile-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 10px auto 20px;
        border: 4px solid #4a6cf7;
        background: #f0f4f8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #999;
        overflow: hidden;
    }
    .profile-preview img { width: 100%; height: 100%; object-fit: cover; }
    .upload-btn { display: inline-block; background: #4a6cf7; color: white; padding: 5px 15px; border-radius: 20px; cursor: pointer; font-size: 0.8rem; margin-top: 10px; text-align: center; }
    .upload-btn input { display: none; }
    .profile-body { padding: 30px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { font-weight: 600; display: block; margin-bottom: 8px; color: #333; }
    .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 1rem; }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: #4a6cf7; outline: none; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
    .btn-save { width: 100%; background: linear-gradient(135deg, #4a6cf7, #6c5ce7); color: white; padding: 12px; border: none; border-radius: 10px; font-size: 1rem; cursor: pointer; margin-top: 10px; }
    .btn-save:hover { transform: translateY(-2px); }
    .alert { padding: 10px; border-radius: 8px; margin-bottom: 15px; }
    .alert-success { background: #d4edda; color: #155724; }
    .alert-danger { background: #f8d7da; color: #721c24; }
    @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }
</style>

<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <h2>Complete Your Profile</h2>
        </div>

        <div class="profile-preview" id="preview">
            <?php if($tutor->profile_picture): ?>
                <img src="<?php echo e($tutor->profile_picture); ?>">
            <?php else: ?>
                📷
            <?php endif; ?>
        </div>
        <div style="text-align: center;">
            <label class="upload-btn">
                📸 Upload Picture
                <input type="file" id="profilePic" accept="image/*">
            </label>
        </div>

        <div class="profile-body">
            <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>
            <?php if($errors->any()): ?><div class="alert alert-danger"><?php echo e($errors->first()); ?></div><?php endif; ?>

            <form action="/tutor/profile/complete" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $tutor->name)); ?>" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $tutor->email)); ?>" required>
                </div>

                <div class="form-group">
                    <label>📖 Bio / About Me</label>
                    <textarea name="bio" rows="3" placeholder="Tell students about your teaching experience..."><?php echo e(old('bio', $tutor->bio)); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>💰 Hourly Rate (Rs)</label>
                        <input type="number" name="hourly_rate" value="<?php echo e(old('hourly_rate', $tutor->hourly_rate)); ?>" placeholder="1500">
                    </div>
                    <div class="form-group">
                        <label>⏰ Availability</label>
                        <select name="availability">
                            <option value="">Select</option>
                            <option value="Weekdays" <?php echo e($tutor->availability == 'Weekdays' ? 'selected' : ''); ?>>Weekdays</option>
                            <option value="Weekends" <?php echo e($tutor->availability == 'Weekends' ? 'selected' : ''); ?>>Weekends</option>
                            <option value="Both" <?php echo e($tutor->availability == 'Both' ? 'selected' : ''); ?>>Both</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>📚 Subject</label>
                    <input type="text" name="subject" value="<?php echo e(old('subject', $tutor->subject)); ?>" required>
                </div>

                <div class="form-group">
                    <label>🎓 Qualification</label>
                    <input type="text" name="qualification" value="<?php echo e(old('qualification', $tutor->qualification)); ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>📅 Experience (Years)</label>
                        <input type="number" name="experience" value="<?php echo e(old('experience', $tutor->experience)); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>📍 Location</label>
                        <input type="text" name="location" value="<?php echo e(old('location', $tutor->location)); ?>" required>
                    </div>
                </div>

                <input type="hidden" name="profile_picture" id="profilePictureBase64">
                <button type="submit" class="btn-save">✅ Save Profile</button>
            </form>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/tutor/complete-profile.blade.php ENDPATH**/ ?>