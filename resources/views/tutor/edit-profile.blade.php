@extends('layouts.app')

@section('title', 'Edit Profile - Tutor Portal - TutorConnect')

@section('content')
<style>
    .edit-container {
        padding: 35px 5%;
        background: #F8FAFC;
        min-height: calc(100vh - 180px);
        font-family: 'Poppins', sans-serif;
    }
    .edit-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    .main-content {
        flex: 1;
        min-width: 0;
    }
    
    .profile-card {
        background: #FFFFFF;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid #E2E8F0;
    }
    .profile-header {
        background: linear-gradient(135deg, #111827 0%, #1E293B 100%);
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
        width: 105px;
        height: 105px;
        border-radius: 50%;
        margin: 24px auto 14px;
        border: 3.5px solid #10B981;
        background: #ECFDF5;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.25);
    }
    .profile-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-body {
        padding: 30px 35px 35px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
        color: #111827;
        font-size: 0.9rem;
    }
    .form-group input, .form-group select, .form-group textarea {
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
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
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

    @media (max-width: 900px) {
        .edit-wrapper {
            flex-direction: column;
        }
        .form-row {
            grid-template-columns: 1fr;
        }
        .profile-body {
            padding: 22px;
        }
    }
</style>

@php
    $tutorAvatar = 'images/burhan.png';
    if (!empty($tutor->profile_picture) && file_exists(public_path($tutor->profile_picture))) {
        $tutorAvatar = $tutor->profile_picture;
    } else {
        $firstName = strtolower(explode(' ', str_replace(['Dr.', 'Prof.', 'Mr.', 'Ms.'], '', $tutor->name))[0] ?? 'burhan');
        if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
            $tutorAvatar = 'images/' . $firstName . '.jpg';
        } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
            $tutorAvatar = 'images/' . $firstName . '.png';
        }
    }
@endphp

<div class="edit-container">
    <div class="edit-wrapper">
        <!-- Tutor Sidebar -->
        @include('tutor.Partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="profile-card">
                <div class="profile-header">
                    <h2><i class="fa-solid fa-user-pen"></i> Edit Tutor Profile</h2>
                    <p>Keep your contact, qualifications, pricing, and availability up to date</p>
                </div>

                <!-- Avatar Preview -->
                <div class="profile-preview">
                    <img id="avatarPreviewImg" src="{{ asset($tutorAvatar) }}" alt="{{ $tutor->name }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($tutor->name) }}&background=ECFDF5&color=059669'">
                </div>
                
                <div style="text-align: center; margin-bottom: 24px;">
                    <label for="profilePicInput" class="btn btn-sm text-white" style="background: #059669; border-radius: 20px; padding: 7px 18px; font-size: 0.85rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-camera"></i> Change Profile Picture
                    </label>
                    <input type="file" id="profilePicInput" accept="image/png, image/jpeg, image/jpg, image/webp" style="display: none;" onchange="previewImage(event)">
                    <div class="text-muted small mt-1" style="font-size: 0.75rem;">PNG, JPG, WEBP (Max 5MB)</div>
                </div>

                <div class="profile-body">
                    @if(session('success'))
                        <div class="alert alert-success rounded-4 mb-4 border-0 shadow-sm">
                            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger rounded-4 mb-4 border-0 shadow-sm">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
                        </div>
                    @endif

                    <form action="/tutor/profile/update" method="POST">
                        @csrf
                        <input type="hidden" name="profile_picture" id="base64ProfilePic" value="">

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
                            <textarea name="bio" rows="3" required>{{ old('bio', $tutor->bio) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label><i class="fa-solid fa-tag"></i> Hourly Rate (Rs)</label>
                                <input type="number" name="hourly_rate" value="{{ old('hourly_rate', $tutor->hourly_rate ?? 1500) }}" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fa-solid fa-book"></i> Primary Subject</label>
                                <input type="text" name="subject" value="{{ old('subject', $tutor->subject) }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label><i class="fa-solid fa-graduation-cap"></i> Highest Qualification</label>
                                <input type="text" name="qualification" value="{{ old('qualification', $tutor->qualification) }}" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fa-solid fa-briefcase"></i> Experience (Years)</label>
                                <input type="number" name="experience" value="{{ old('experience', $tutor->experience) }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label><i class="fa-solid fa-location-dot"></i> City / Mode</label>
                                <input type="text" name="location" value="{{ old('location', $tutor->location) }}" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fa-solid fa-clock"></i> Weekly Availability</label>
                                <input type="text" name="availability" value="{{ old('availability', $tutor->availability ?? 'Monday - Friday: 4:00 PM - 8:00 PM') }}">
                            </div>
                        </div>

                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-floppy-disk"></i> Save Profile Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreviewImg').src = e.target.result;
                document.getElementById('base64ProfilePic').value = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection