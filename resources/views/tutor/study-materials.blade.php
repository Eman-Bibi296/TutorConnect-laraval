@extends('layouts.app')

@section('title', 'Study Materials - Tutor Portal - TutorConnect')

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

    .upload-section-card {
        background: white;
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 28px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid #E2E8F0;
    }
    .upload-section-card h3 {
        margin: 0 0 20px;
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 16px;
    }
    .form-group {
        margin-bottom: 16px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #111827;
        font-size: 0.9rem;
    }
    .form-group input, .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #CBD5E1;
        border-radius: 12px;
        font-size: 0.95rem;
        outline: none;
        transition: all 0.2s ease;
        background: white;
        font-family: inherit;
    }
    .form-group input:focus, .form-group textarea:focus {
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }

    .btn-upload {
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.25);
        transition: all 0.2s;
    }
    .btn-upload:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(5, 150, 105, 0.35);
    }

    .materials-table-card {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid #E2E8F0;
    }
    .materials-table-card h3 {
        margin: 0 0 20px;
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-responsive {
        overflow-x: auto;
    }
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .custom-table th {
        text-align: left;
        padding: 12px 16px;
        background: #F8FAFC;
        color: #475569;
        font-size: 0.8rem;
        font-weight: 700;
        border-bottom: 1px solid #E2E8F0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .custom-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #F1F5F9;
        color: #334155;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    .btn-action-delete {
        background: #FEF2F2;
        color: #DC2626;
        border: 1px solid #FECACA;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background: #DC2626;
        color: white;
    }

    @media (max-width: 900px) {
        .materials-wrapper {
            flex-direction: column;
        }
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="materials-container">
    <div class="materials-wrapper">
        <!-- Tutor Sidebar -->
        @include('tutor.Partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1><i class="fa-solid fa-folder-open"></i> Upload Study Materials</h1>
                <p>Share lecture slides, practice questions, and notes with your connected students</p>
            </div>

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

            <!-- Upload Section -->
            <div class="upload-section-card">
                <h3><i class="fa-solid fa-cloud-arrow-up" style="color:var(--primary);"></i> Publish New Resource</h3>
                <form action="/tutor/material/upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label><i class="fa-solid fa-heading"></i> Document Title</label>
                            <input type="text" name="title" placeholder="e.g. Laravel Full-Stack MVC Architecture Notes" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fa-solid fa-file-arrow-up"></i> Choose File (PDF / Doc / Slides)</label>
                            <input type="file" name="file" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-align-left"></i> Summary / Instructions for Students</label>
                        <textarea name="description" rows="2" placeholder="Explain what concepts this material covers..."></textarea>
                    </div>

                    <button type="submit" class="btn-upload">
                        <i class="fa-solid fa-upload"></i> <span>Upload & Share with Students</span>
                    </button>
                </form>
            </div>

            <!-- Uploaded Materials Table -->
            <div class="materials-table-card">
                <h3><i class="fa-solid fa-list" style="color:var(--primary);"></i> Uploaded Materials</h3>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Document Title</th>
                                <th>Summary</th>
                                <th>Upload Date</th>
                                <th style="text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($materials as $mat)
                                @php
                                    $ext = strtolower(pathinfo($mat->file_path ?? '', PATHINFO_EXTENSION));
                                @endphp
                                <tr>
                                    <td style="font-weight: 700; color: #111827;">
                                        <i class="fa-solid fa-file-pdf text-danger me-2"></i>
                                        {{ $mat->title }}
                                        <span class="badge bg-light text-muted border ms-1" style="font-size:0.7rem;">{{ strtoupper($ext ?: 'PDF') }}</span>
                                    </td>
                                    <td>{{ $mat->description ?? 'Standard study notes and lecture guide.' }}</td>
                                    <td>{{ $mat->created_at ? $mat->created_at->format('M d, Y') : 'Recently' }}</td>
                                    <td style="text-align:right;">
                                        <form action="/tutor/material/delete/{{ $mat->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this study material?');" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete">
                                                <i class="fa-solid fa-trash-can me-1"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        You haven't uploaded any study resources yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection