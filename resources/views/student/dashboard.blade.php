@extends('layouts.app')

@section('title', 'Student Dashboard - TutorConnect')

@section('content')
<style>
    .dashboard-container {
        padding: 35px 5%;
        min-height: calc(100vh - 180px);
        background: #F8FAFC;
    }
    .dashboard-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    .main-content {
        flex: 1;
        min-width: 0;
    }
    
    .welcome-banner {
        background: linear-gradient(135deg, #111827 0%, #1e293b 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: white;
        margin-bottom: 25px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .welcome-banner h2 {
        font-size: 1.6rem;
        font-weight: 800;
        margin: 0;
    }
    .welcome-banner p {
        color: #94A3B8;
        margin: 6px 0 0;
        font-size: 0.95rem;
    }

    .search-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
    }
    .search-row {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    .search-input {
        flex: 1;
        min-width: 200px;
        padding: 12px 16px;
        border: 1.5px solid #CBD5E1;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.2s;
    }
    .search-input:focus {
        border-color: #059669;
        outline: none;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12);
    }
    .search-btn {
        background: #059669;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }
    .search-btn:hover {
        background: #047857;
    }

    .tutors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
    }
    .tutor-card {
        background: white;
        border-radius: 20px;
        padding: 22px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .tutor-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(5, 150, 105, 0.12);
        border-color: #10B981;
    }
    
    .tutor-header {
        display: flex;
        gap: 15px;
        align-items: center;
        margin-bottom: 15px;
    }
    .tutor-img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2.5px solid #10B981;
        background: #ECFDF5;
        flex-shrink: 0;
    }
    .tutor-info h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    .tutor-badge {
        background: #ECFDF5;
        color: #059669;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 12px;
        display: inline-block;
        margin-top: 3px;
    }
    
    .tutor-stats {
        display: flex;
        justify-content: space-between;
        background: #F8FAFC;
        padding: 10px 14px;
        border-radius: 12px;
        margin-bottom: 15px;
        font-size: 0.85rem;
    }
    .tutor-actions {
        display: flex;
        gap: 10px;
    }
    .btn-book {
        flex: 1;
        background: #059669;
        color: white;
        text-align: center;
        padding: 9px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-book:hover {
        background: #047857;
        color: white;
    }
    .btn-chat {
        background: #F1F5F9;
        color: #1E293B;
        padding: 9px 15px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-chat:hover {
        background: #E2E8F0;
        color: #1E293B;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 45px 20px;
        background: white;
        border-radius: 20px;
        border: 1px dashed #CBD5E1;
    }
    .empty-state i {
        font-size: 2.5rem;
        color: #94A3B8;
        margin-bottom: 12px;
    }
    .empty-state h4 {
        color: #334155;
        font-weight: 700;
        margin-bottom: 6px;
    }
    .empty-state p {
        color: #64748B;
        font-size: 0.9rem;
        margin: 0;
    }

    @media (max-width: 900px) {
        .dashboard-wrapper {
            flex-direction: column;
        }
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        <!-- Student Sidebar -->
        @include('student.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <h2>Hello, <span>{{ explode(' ', $student->name ?? 'Student')[0] }}</span>! 👋</h2>
                <p>Find and book verified tutors for computer science, mathematics, engineering, and science.</p>
            </div>

            <!-- Search Card -->
            <div class="search-card">
                <div class="search-row">
                    <select id="dashSubjectFilter" class="search-input" onchange="filterDashTutors()">
                        <option value="all">All Subjects</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Mathematics">Mathematics & Calculus</option>
                        <option value="Physics">Physics & Electronics</option>
                        <option value="Chemistry">Chemistry</option>
                        <option value="English">English</option>
                    </select>
                    <input type="text" id="dashKeywordInput" class="search-input" placeholder="Search by tutor name, keyword or city..." oninput="filterDashTutors()">
                    <button type="button" class="search-btn" onclick="filterDashTutors()"><i class="fas fa-search me-1"></i> Search</button>
                </div>
            </div>

            <!-- Live Dynamic Tutors Grid -->
            <div class="tutors-grid" id="dashTutorsGrid">
                @forelse($tutors as $t)
                    @php
                        $tutorAvatar = 'images/burhan.png';
                        if (!empty($t->profile_picture) && file_exists(public_path($t->profile_picture))) {
                            $tutorAvatar = $t->profile_picture;
                        } else {
                            $firstName = strtolower(explode(' ', str_replace(['Dr.', 'Prof.', 'Mr.', 'Ms.'], '', $t->name))[0] ?? 'burhan');
                            if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
                                $tutorAvatar = 'images/' . $firstName . '.jpg';
                            } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
                                $tutorAvatar = 'images/' . $firstName . '.png';
                            }
                        }
                        $avg = $t->avgRating();
                        $revCount = $t->feedback ? $t->feedback->count() : 0;
                    @endphp
                    <div class="tutor-card" data-name="{{ strtolower($t->name) }}" data-subject="{{ strtolower($t->subject) }}" data-location="{{ strtolower($t->location ?? '') }}" data-bio="{{ strtolower($t->bio ?? '') }}">
                        <div>
                            <div class="tutor-header">
                                <img src="{{ asset($tutorAvatar) }}" alt="{{ $t->name }}" class="tutor-img" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($t->name) }}&background=ECFDF5&color=059669'">
                                <div class="tutor-info">
                                    <h4>{{ $t->name }}</h4>
                                    <span class="tutor-badge">✓ Verified Expert</span>
                                </div>
                            </div>
                            <p class="text-muted small mb-2"><strong>Subject:</strong> {{ $t->subject }}</p>
                            <p class="text-muted small mb-3">{{ Str::limit($t->bio ?? 'Experienced instructor ready to help you succeed in your studies.', 85) }}</p>
                            <div class="tutor-stats">
                                <span>⭐ {{ number_format($avg, 1) }} ({{ $revCount }} reviews)</span>
                                <span style="color:#059669; font-weight:800;">Rs {{ number_format($t->hourly_rate ?? 1500) }}/hr</span>
                            </div>
                        </div>
                        <div class="tutor-actions">
                            <a href="{{ url('/student/tutor/' . $t->id) }}" class="btn-book">
                                <i class="fas fa-calendar-plus me-1"></i> View & Book
                            </a>
                            <a href="{{ url('/student/chat-only/' . $t->id) }}" class="btn-chat" title="Chat with {{ $t->name }}">
                                <i class="fas fa-comment"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-user-graduate"></i>
                        <h4>No instructors found matching your criteria</h4>
                        <p>Try clearing filters or search for another subject.</p>
                    </div>
                @endforelse
            </div>
            
            <div id="noResultsNotice" class="empty-state mt-3" style="display:none;">
                <i class="fas fa-search"></i>
                <h4>No instructors found matching your criteria</h4>
                <p>Try clearing filters or search for another subject.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function filterDashTutors() {
        const subject = document.getElementById('dashSubjectFilter').value.toLowerCase().trim();
        const keyword = (document.getElementById('dashKeywordInput').value || '').toLowerCase().trim();
        const cards = document.querySelectorAll('#dashTutorsGrid .tutor-card');
        const noResults = document.getElementById('noResultsNotice');
        
        let visibleCount = 0;
        cards.forEach(card => {
            const cName = card.getAttribute('data-name') || '';
            const cSubject = card.getAttribute('data-subject') || '';
            const cLoc = card.getAttribute('data-location') || '';
            const cBio = card.getAttribute('data-bio') || '';
            
            const matchSubject = (subject === 'all') || cSubject.includes(subject);
            const matchKeyword = !keyword || cName.includes(keyword) || cSubject.includes(keyword) || cLoc.includes(keyword) || cBio.includes(keyword);
            
            if (matchSubject && matchKeyword) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (noResults) {
            noResults.style.display = (visibleCount === 0 && cards.length > 0) ? 'block' : 'none';
        }
    }
</script>
@endsection