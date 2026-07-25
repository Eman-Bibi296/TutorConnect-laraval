@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<style>
    .dashboard-container {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 30px 5%;
    }
    .dashboard-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
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
    .sidebar-logo span { color: #4a6cf7; }
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
    .sidebar-menu li { margin-bottom: 8px; }
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
    .main-content { flex: 1; }
    .welcome-card {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        border-radius: 20px;
        padding: 25px;
        color: white;
        margin-bottom: 30px;
    }
    .welcome-card h1 {
        margin: 0;
        font-size: 1.5rem;
    }
    .welcome-card p {
        margin: 10px 0 0;
        opacity: 0.9;
    }
    .search-section {
        background: white;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .search-row {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    .search-input-group {
        flex: 1;
        min-width: 200px;
    }
    .search-input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 1rem;
    }
    .search-input:focus {
        border-color: #4a6cf7;
        outline: none;
    }
    .search-btn {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        border: none;
        border-radius: 12px;
        padding: 12px 25px;
        color: white;
        font-weight: 600;
        cursor: pointer;
    }
    .tutors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 25px;
    }
    .tutor-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s;
        display: flex;
        gap: 20px;
        align-items: center;
    }
    .tutor-card:hover { transform: translateY(-5px); }
    .tutor-avatar {
        width: 140px;
        height: 140px;
        border-radius: 20px;
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }
    .tutor-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
    }
    .tutor-info { flex: 1; }
    .tutor-name {
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0 0 5px;
    }
    .tutor-qualification {
        font-size: 0.85rem;
        color: #4a6cf7;
        margin-bottom: 5px;
    }
    .tutor-experience {
        font-size: 0.8rem;
        color: #666;
        margin-bottom: 10px;
    }
    .tutor-subjects {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 15px;
    }
    .subject-tag {
        background: #e8f0fe;
        color: #4a6cf7;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
    }
    .tutor-price {
        font-size: 1.2rem;
        font-weight: 800;
        color: #4a6cf7;
        margin-top: 10px;
    }
    .btn-view {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        border-radius: 10px;
        padding: 8px 20px;
        color: white;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        font-size: 0.8rem;
    }
    @media (max-width: 768px) {
        .dashboard-wrapper { flex-direction: column; }
        .sidebar { width: 100%; position: static; }
        .tutors-grid { grid-template-columns: 1fr; }
        .tutor-card { flex-direction: column; text-align: center; }
        .tutor-avatar { width: 120px; height: 120px; margin: 0 auto; }
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        
        @include('student.partials.sidebar')
        
        <div class="main-content">
            <div class="welcome-card">
                <h1>Welcome back, {{ $student->name }}! 😊</h1>
                <p>Find your perfect tutor and start learning today.</p>
            </div>
            
            <div class="search-section">
                <div class="search-row">
                    <div class="search-input-group">
                        <input type="text" id="searchSubject" class="search-input" placeholder="Search by subject...">
                    </div>
                    <div class="search-input-group">
                        <input type="text" id="searchLocation" class="search-input" placeholder="Search by location...">
                    </div>
                    <div>
                        <button class="search-btn" onclick="searchTutors()">🔍 Search</button>
                    </div>
                </div>
            </div>
            
            <div id="tutorsList" class="tutors-grid">
                @foreach($tutors as $tutor)
                <div class="tutor-card">
                    <div class="tutor-avatar">
                        <!-- ⭐ DATABASE SE PICTURE SHOW KARO -->
                        @if($tutor->profile_picture)
                            <img src="{{ asset($tutor->profile_picture) }}" 
                                 alt="{{ $tutor->name }}" 
                                 style="width:100%; height:100%; object-fit:cover; border-radius:20px;">
                        @else
                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:3rem; background:linear-gradient(135deg, #4a6cf7, #6c5ce7); color:white;">
                                👨‍🏫
                            </div>
                        @endif
                    </div>
                    <div class="tutor-info">
                        <h3 class="tutor-name">{{ $tutor->name }}</h3>
                        <div class="tutor-qualification">{{ $tutor->qualification }}</div>
                        <div class="tutor-experience">⭐ {{ $tutor->experience }}+ Years Experience</div>
                        <div class="tutor-subjects">
                            <span class="subject-tag">{{ $tutor->subject }}</span>
                            
                        </div>
                        <div class="tutor-price">Rs {{ $tutor->hourly_rate ?? $tutor->experience * 100 + 1000 }}/hour</div>
                        <a href="/student/tutor/{{ $tutor->id }}" class="btn-view">View Profile →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
function searchTutors() {
    let subject = document.getElementById('searchSubject').value;
    let location = document.getElementById('searchLocation').value;
    
    fetch(`/student/search?subject=${subject}&location=${location}`)
        .then(response => response.json())
        .then(data => {
            let tutorsList = document.getElementById('tutorsList');
            if(data.length === 0) {
                tutorsList.innerHTML = '<div style="text-align:center;padding:50px;color:#888;">No tutors found</div>';
                return;
            }
            tutorsList.innerHTML = data.map(tutor => `
                <div class="tutor-card">
                    <div class="tutor-avatar">
                        ${tutor.profile_picture ? 
                            `<img src="/${tutor.profile_picture}" alt="${tutor.name}" style="width:100%; height:100%; object-fit:cover; border-radius:20px;">` :
                            `<div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:3rem; background:linear-gradient(135deg, #4a6cf7, #6c5ce7); color:white;">👨‍🏫</div>`
                        }
                    </div>
                    <div class="tutor-info">
                        <h3 class="tutor-name">${tutor.name}</h3>
                        <div class="tutor-qualification">${tutor.qualification || 'N/A'}</div>
                        <div class="tutor-experience">⭐ ${tutor.experience || 0}+ Years Experience</div>
                        <div class="tutor-subjects">
                            <span class="subject-tag">${tutor.subject || 'General'}</span>
                            <span class="subject-tag">${tutor.subject || 'General'} Tutoring</span>
                        </div>
                        <div class="tutor-price">Rs ${tutor.hourly_rate || (tutor.experience || 0) * 100 + 1000}/hour</div>
                        <a href="/student/tutor/${tutor.id}" class="btn-view">View Profile →</a>
                    </div>
                </div>
            `).join('');
        });
}
</script>
@endsection