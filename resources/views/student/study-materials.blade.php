@extends('layouts.app')

@section('title', 'Study Materials - TutorConnect')

@section('content')
<style>
    .materials-container {
        padding: 35px 5%;
        background: #F8FAFC;
        min-height: calc(100vh - 180px);
        font-family: 'Poppins', sans-serif;
    }
    .materials-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    .main-content {
        flex: 1;
        min-width: 0;
    }
    
    .page-header {
        background: linear-gradient(135deg, #111827 0%, #1e293b 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: white;
        margin-bottom: 28px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .page-header h1 {
        font-size: 1.6rem;
        font-weight: 800;
        margin: 0;
    }
    .page-header p {
        color: #94A3B8;
        margin: 8px 0 0;
        font-size: 0.95rem;
    }

    .data-card {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
    }

    .materials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 22px;
    }
    .material-card {
        background: #F8FAFC;
        border-radius: 16px;
        padding: 22px;
        border: 1px solid #E2E8F0;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .material-card:hover {
        background: white;
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(5, 150, 105, 0.12);
        border-color: #10B981;
    }
    .material-icon {
        font-size: 2.2rem;
        margin-bottom: 12px;
    }
    .material-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
    }
    .material-type {
        font-size: 0.8rem;
        color: #059669;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .material-meta {
        font-size: 0.78rem;
        color: #64748B;
        margin-bottom: 12px;
    }
    .material-description {
        font-size: 0.85rem;
        color: #475569;
        margin-bottom: 18px;
        line-height: 1.5;
    }
    .btn-download {
        background: #059669;
        color: white;
        padding: 10px 18px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.85rem;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-download:hover {
        background: #047857;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #94A3B8;
    }
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 12px;
    }

    @media (max-width: 900px) {
        .materials-wrapper {
            flex-direction: column;
        }
    }
</style>

<div class="materials-container">
    <div class="materials-wrapper">
        <!-- Student Sidebar -->
        @include('student.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1><i class="fa-solid fa-book-open"></i> Shared Study Materials</h1>
                <p>Download handouts, formula sheets, past exam papers, and guides uploaded by your tutors</p>
            </div>

            <div class="data-card">
                @if($materials && $materials->count() > 0)
                    <div class="materials-grid">
                        @foreach($materials as $mat)
                            @php
                                $ext = strtolower(pathinfo($mat->file_path ?? '', PATHINFO_EXTENSION));
                                $icon = '📄';
                                if($ext == 'pdf') $icon = '📄';
                                elseif(in_array($ext, ['doc', 'docx'])) $icon = '📋';
                                elseif(in_array($ext, ['zip', 'rar'])) $icon = '📦';
                                elseif(in_array($ext, ['xls', 'xlsx'])) $icon = '📊';
                            @endphp
                            <div class="material-card">
                                <div>
                                    <div class="material-icon">{{ $icon }}</div>
                                    <div class="material-title">{{ $mat->title }}</div>
                                    <div class="material-type">
                                        {{ strtoupper($ext ?: 'PDF') }} Resource • {{ $mat->tutor->name ?? 'Faculty Instructor' }}
                                    </div>
                                    <div class="material-meta">
                                        <i class="fa-regular fa-clock"></i> Uploaded {{ $mat->created_at ? $mat->created_at->format('M d, Y') : 'Recently' }}
                                    </div>
                                    <div class="material-description">
                                        {{ $mat->description ?? 'Comprehensive learning and revision material shared by instructor.' }}
                                    </div>
                                </div>
                                <a href="{{ url('/student/material/download/' . $mat->id) }}" class="btn-download">
                                    <i class="fa-solid fa-download"></i> Download Resource
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fa-regular fa-folder-open"></i>
                        <h4 class="mt-2" style="font-weight:700; color:#111827;">No Study Materials Shared Yet</h4>
                        <p class="text-muted small">When your verified tutors upload notes, exercises, or exam guides, they will appear here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection