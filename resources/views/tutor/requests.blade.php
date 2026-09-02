@extends('layouts.app')

@section('title', 'Student Requests - Tutor Portal - TutorConnect')

@section('content')
<style>
    .requests-container {
        padding: 35px 5%;
        background: #F8FAFC;
        min-height: calc(100vh - 180px);
        font-family: 'Poppins', sans-serif;
    }
    .requests-wrapper {
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

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: white;
        border-radius: 18px;
        padding: 22px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
        transition: all 0.25s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        border-color: #10B981;
    }
    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: #059669;
        margin-bottom: 4px;
    }
    .stat-label {
        color: #64748B;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .data-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
    }
    .data-card h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 20px;
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

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
    }
    .status-accepted { background: #ECFDF5; color: #059669; border: 1px solid #A7F3D0; }
    .status-pending { background: #FFFBEB; color: #D97706; border: 1px solid #FDE68A; }
    .status-rejected { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }

    .btn-table-action {
        padding: 6px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.82rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-action-accept { background: #ECFDF5; color: #059669; border: 1px solid #A7F3D0; }
    .btn-action-accept:hover { background: #059669; color: white; }
    .btn-action-reject { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }
    .btn-action-reject:hover { background: #DC2626; color: white; }

    @media (max-width: 900px) {
        .requests-wrapper {
            flex-direction: column;
        }
    }
</style>

<div class="requests-container">
    <div class="requests-wrapper">
        <!-- Tutor Sidebar -->
        @include('tutor.Partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1><i class="fa-solid fa-inbox"></i> Incoming Student Requests</h1>
                <p>Accept or decline student inquiries seeking tutoring in your subjects</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $requests->count() }}</div>
                    <div class="stat-label">Total Received</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #D97706;">
                        {{ $requests->where('status', 'pending')->count() }}
                    </div>
                    <div class="stat-label">Action Pending</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #059669;">
                        {{ $requests->where('status', 'accepted')->count() }}
                    </div>
                    <div class="stat-label">Accepted</div>
                </div>
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

            <!-- Requests Table -->
            <div class="data-card">
                <h3><i class="fa-solid fa-users" style="color:var(--primary);"></i> Students Requesting Guidance</h3>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Email / Location</th>
                                <th>Date Received</th>
                                <th>Status</th>
                                <th style="text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $req)
                                @php
                                    $studentName = $req->student->name ?? 'Student';
                                    $firstName = strtolower(explode(' ', $studentName)[0]);
                                    $studentAvatar = 'images/eman.jpg';
                                    if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
                                        $studentAvatar = 'images/' . $firstName . '.jpg';
                                    } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
                                        $studentAvatar = 'images/' . $firstName . '.png';
                                    }
                                @endphp
                                <tr>
                                    <td style="font-weight: 700; color: #111827;">
                                        
                                        {{ $studentName }}
                                    </td>
                                    <td>{{ $req->student->email ?? 'student@email.com' }} • {{ $req->student->location ?? 'Online' }}</td>
                                    <td>{{ $req->created_at ? $req->created_at->format('M d, Y') : 'Recently' }}</td>
                                    <td>
                                        @if($req->status == 'pending')
                                            <span class="status-badge status-pending"><i class="fa-solid fa-clock"></i> Pending</span>
                                        @elseif($req->status == 'accepted')
                                            <span class="status-badge status-accepted"><i class="fa-solid fa-circle-check"></i> Accepted</span>
                                        @else
                                            <span class="status-badge status-rejected"><i class="fa-solid fa-circle-xmark"></i> Declined</span>
                                        @endif
                                    </td>
                                    <td style="text-align:right;">
                                        @if($req->status == 'pending')
                                            <form action="/tutor/update-status" method="POST" style="display:inline-block;">
                                                @csrf
                                                <input type="hidden" name="request_id" value="{{ $req->id }}">
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="btn-table-action btn-action-accept me-1"><i class="fa-solid fa-check"></i> Accept</button>
                                            </form>
                                            <form action="/tutor/update-status" method="POST" style="display:inline-block;">
                                                @csrf
                                                <input type="hidden" name="request_id" value="{{ $req->id }}">
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn-table-action btn-action-reject"><i class="fa-solid fa-xmark"></i> Decline</button>
                                            </form>
                                        @elseif($req->status == 'accepted')
                                            <a href="/tutor/messages" class="btn-table-action btn-action-accept"><i class="fa-solid fa-comment"></i> Open Chat</a>
                                        @else
                                            <span class="text-muted small">Declined</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No student connection requests found.</td>
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