@extends('layouts.app')

@section('title', 'Tutor Registration - TutorConnect')

@section('content')
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
        max-width: 600px;
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
        margin-bottom: 18px;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-main);
        font-size: 0.9rem;
    }
    
    .form-group input, .form-group textarea {
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
    
    .form-group input:focus, .form-group textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
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

    @media (max-width: 600px) {
        .form-row { grid-template-columns: 1fr; }
        .auth-card { padding: 25px 20px; }
    }
</style>

<div class="auth-container">
    <div class="auth-card animate-fade-in-up">
        <div class="auth-header">
            <div class="auth-header-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
            <h2>Register as a Tutor</h2>
            <p>Join our instructor network and connect with students needing your expertise</p>
        </div>
        
        @if(session('success'))
            <div class="auth-alert auth-alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif
        @if($errors->any())
            <div class="auth-alert auth-alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div>{{ $errors->first() }}</div>
            </div>
        @endif
        
        <form action="/tutor/register" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label><i class="fa-regular fa-user"></i> Full Name</label>
                    <input type="text" name="name" placeholder="e.g. Dr. Burhan Ahmad" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label><i class="fa-regular fa-envelope"></i> Email Address</label>
                    <input type="email" name="email" placeholder="e.g. burhan@example.com" value="{{ old('email') }}" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label><i class="fa-solid fa-lock"></i> Password</label>
                    <input type="password" name="password" placeholder="Create password (min 6 chars)" minlength="6" required>
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-lock"></i> Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm password" minlength="6" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label><i class="fa-solid fa-book"></i> Subject Expertise</label>
                    <input type="text" name="subject" placeholder="e.g. Computer Science, Physics, Math" value="{{ old('subject') }}" required>
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-graduation-cap"></i> Highest Qualification</label>
                    <input type="text" name="qualification" placeholder="e.g. PhD Computer Science, MPhil" value="{{ old('qualification') }}" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label><i class="fa-solid fa-briefcase"></i> Experience (Years)</label>
                    <input type="number" name="experience" placeholder="e.g. 5" min="1" max="40" value="{{ old('experience') }}" required>
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-money-bill-wave"></i> Hourly Rate (PKR)</label>
                    <input type="number" name="hourly_rate" placeholder="e.g. 1500" min="500" step="100" value="{{ old('hourly_rate', 1500) }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label><i class="fa-solid fa-location-dot"></i> City / Location</label>
                    <input type="text" name="location" placeholder="e.g. Sheikhupura, Lahore, Online" value="{{ old('location') }}" required>
                </div>
                <div class="form-group">
                    <label><i class="fa-solid fa-camera"></i> Custom Profile Picture</label>
                    <div style="display: flex; align-items: center; gap: 14px; background: #F8FAFC; padding: 10px 14px; border: 1.5px dashed #CBD5E1; border-radius: 12px;">
                        <div id="bladeAvatarPreview" style="width: 52px; height: 52px; border-radius: 50%; overflow: hidden; background: #E2E8F0; display: flex; align-items: center; justify-content: center; border: 2px solid #10B981; flex-shrink: 0; position: relative;">
                            <img id="bladePreviewImg" src="" alt="Preview" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                            <i id="bladePlaceholderIcon" class="fa-solid fa-user-tie" style="font-size: 1.4rem; color: #64748B;"></i>
                        </div>
                        <div style="flex: 1;">
                            <label for="bladeProfilePic" class="btn btn-sm text-white" style="background: #059669; border-radius: 8px; font-size: 0.82rem; font-weight: 600; cursor: pointer; padding: 5px 12px; margin-bottom: 2px; display: inline-block;">
                                <i class="fa-solid fa-upload me-1"></i> Choose Photo
                            </label>
                            <input type="file" id="bladeProfilePic" name="profile_picture" accept="image/png, image/jpeg, image/jpg, image/webp" style="display: none;" onchange="previewBladeAvatar(event)">
                            <div id="bladeFileName" class="text-muted small" style="font-size: 0.72rem; word-break: break-all;">PNG, JPG, WEBP (Max 5MB)</div>
                        </div>
                        <button type="button" id="bladeRemoveAvatarBtn" onclick="removeBladeAvatar()" style="display: none; background: transparent; border: none; color: #EF4444; font-size: 0.85rem; cursor: pointer;" title="Remove Photo">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label><i class="fa-solid fa-pencil"></i> Brief Teaching Bio</label>
                <textarea name="bio" rows="2" class="form-control" placeholder="Introduce yourself, teaching experience and methodology..." style="padding: 12px 16px; border: 1.5px solid #CBD5E1; border-radius: 12px; font-family: inherit; font-size: 0.95rem;">{{ old('bio') }}</textarea>
            </div>

            <button type="submit" class="btn-auth-submit">
                <i class="fa-solid fa-chalkboard-user me-1"></i> Register as a Tutor
            </button>
        </form>
        
        <div class="auth-footer">
            Already registered as a tutor? <a href="/tutor/login">Sign in here</a>
        </div>
    </div>
</div>

<script>
    function previewBladeAvatar(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 5 * 1024 * 1024) {
                alert('Image size exceeds 5MB. Please choose a smaller photo.');
                return;
            }
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.getElementById('bladePreviewImg');
                const placeholder = document.getElementById('bladePlaceholderIcon');
                const nameLabel = document.getElementById('bladeFileName');
                const removeBtn = document.getElementById('bladeRemoveAvatarBtn');

                img.src = event.target.result;
                img.style.display = 'block';
                placeholder.style.display = 'none';
                nameLabel.innerText = file.name.length > 20 ? file.name.substring(0, 18) + '...' : file.name;
                nameLabel.style.color = '#059669';
                nameLabel.style.fontWeight = '600';
                removeBtn.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    function removeBladeAvatar() {
        document.getElementById('bladeProfilePic').value = '';
        const img = document.getElementById('bladePreviewImg');
        const placeholder = document.getElementById('bladePlaceholderIcon');
        const nameLabel = document.getElementById('bladeFileName');
        const removeBtn = document.getElementById('bladeRemoveAvatarBtn');

        img.src = '';
        img.style.display = 'none';
        placeholder.style.display = 'block';
        nameLabel.innerText = 'PNG, JPG, WEBP (Max 5MB)';
        nameLabel.style.color = '#64748B';
        nameLabel.style.fontWeight = 'normal';
        removeBtn.style.display = 'none';
    }
</script>
@endsection