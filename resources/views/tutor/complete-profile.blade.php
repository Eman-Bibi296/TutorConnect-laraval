@extends('layouts.app')

@section('title', 'Complete Your Profile - TutorConnect')

@section('content')
<style>
    :root {
        --primary: #059669;
        --primary-hover: #047857;
        --primary-light: #ECFDF5;
        --accent: #10B981;
        --bg-dark: #111827;
        --bg-dark-secondary: #1E293B;
        --bg-light: #F8FAFC;
        --bg-card: #FFFFFF;
        --text-main: #111827;
        --text-muted: #64748B;
        --border-color: #E2E8F0;
    }

    .profile-container {
        background: var(--bg-light);
        min-height: calc(100vh - 180px);
        padding: 40px 5%;
        font-family: 'Poppins', sans-serif;
    }
    .profile-card {
        background: var(--bg-card);
        border-radius: 24px;
        max-width: 760px;
        margin: 0 auto;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid var(--border-color);
    }
    .profile-header {
        background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-dark-secondary) 100%);
        padding: 35px 30px;
        text-align: center;
        color: white;
    }
    .profile-header h2 {
        margin: 0;
        font-size: 1.6rem;
        font-weight: 800;
    }
    .profile-header p {
        margin: 6px 0 0;
        color: #94A3B8;
        font-size: 0.92rem;
    }
    .profile-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 24px auto 14px;
        border: 3px solid var(--accent);
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        color: var(--primary);
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
    }
    .profile-preview img { width: 100%; height: 100%; object-fit: cover; }
    .upload-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #F1F5F9;
        color: var(--text-main);
        padding: 8px 20px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s;
        border: 1px solid var(--border-color);
    }
    .upload-btn:hover {
        background: var(--primary-light);
        color: var(--primary);
        border-color: var(--accent);
    }
    .upload-btn input { display: none; }
    .profile-body { padding: 30px 35px 35px; }
    .form-group { margin-bottom: 20px; }
    .form-group label {
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
        color: var(--text-main);
        font-size: 0.9rem;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
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
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .btn-save {
        width: 100%;
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        margin-top: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(5, 150, 105, 0.35);
    }
    .alert { padding: 12px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 0.9rem; }
    .alert-success { background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; }
    .alert-danger { background: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; }
    @media (max-width: 768px) {
        .form-row { grid-template-columns: 1fr; }
        .profile-body { padding: 22px; }
    }
</style>

<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <h2><i class="fa-solid fa-id-card"></i> Complete Your Profile</h2>
            <p>Finish setting up your credentials to start receiving student booking requests</p>
        </div>

        <div class="profile-preview" id="preview">
            @if($tutor->profile_picture)
                <img src="{{ $tutor->profile_picture }}" alt="Profile">
            @else
                <i class="fa-solid fa-camera"></i>
            @endif
        </div>
        <div style="text-align: center;">
            <label class="upload-btn">
                <i class="fa-solid fa-upload"></i> Upload Profile Picture
                <input type="file" id="profilePic" accept="image/*">
            </label>
        </div>

        <div class="profile-body">
            @if(session('success'))
                <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}</div>
            @endif

            <form action="/tutor/profile/complete" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label><i class="fa-regular fa-user"></i> Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $tutor->name) }}" required>
                </div>

                <div class="form-group">
                    <label><i class="fa-regular fa-envelope"></i> Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $tutor->email) }}" required>
                </div>

                <div class="form-group">
                    <label><i class="fa-regular fa-file-lines"></i> Bio / About Me</label>
                    <textarea name="bio" rows="3" placeholder="Tell students about your teaching experience and approach...">{{ old('bio', $tutor->bio) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fa-solid fa-tag"></i> Hourly Rate (Rs)</label>
                        <input type="number" name="hourly_rate" value="{{ old('hourly_rate', $tutor->hourly_rate) }}" placeholder="1500">
                    </div>
                    <div class="form-group">
                        <label><i class="fa-regular fa-clock"></i> Availability</label>
                        <select name="availability">
                            <option value="">Select Schedule</option>
                            <option value="Weekdays" {{ $tutor->availability == 'Weekdays' ? 'selected' : '' }}>Weekdays</option>
                            <option value="Weekends" {{ $tutor->availability == 'Weekends' ? 'selected' : '' }}>Weekends</option>
                            <option value="Both" {{ $tutor->availability == 'Both' ? 'selected' : '' }}>Both (Weekdays & Weekends)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-book"></i> Subject Expertise</label>
                    <input type="text" name="subject" value="{{ old('subject', $tutor->subject) }}" required>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-graduation-cap"></i> Qualification</label>
                    <input type="text" name="qualification" value="{{ old('qualification', $tutor->qualification) }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fa-solid fa-briefcase"></i> Experience (Years)</label>
                        <input type="number" name="experience" value="{{ old('experience', $tutor->experience) }}" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fa-solid fa-location-dot"></i> Location</label>
                        <input type="text" name="location" value="{{ old('location', $tutor->location) }}" required>
                    </div>
                </div>

                <input type="hidden" name="profile_picture" id="profilePictureBase64">
                <button type="submit" class="btn-save">
                    <i class="fa-solid fa-check"></i> <span>Save & Complete Profile</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('profilePic')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('preview').innerHTML = `<img src="${ev.target.result}">`;
                document.getElementById('profilePictureBase64').value = ev.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection