@extends('layouts.app')

@section('title', 'Session Bookings - Tutor Portal - TutorConnect')

@section('content')
<style>
    .bookings-container {
        padding: 35px 5%;
        background: #F8FAFC;
        min-height: calc(100vh - 180px);
        font-family: 'Poppins', sans-serif;
    }
    .bookings-wrapper {
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
    .status-confirmed { background: #ECFDF5; color: #059669; border: 1px solid #A7F3D0; }
    .status-completed { background: #EEF2FF; color: #4F46E5; border: 1px solid #C7D2FE; }
    .status-pending { background: #FFFBEB; color: #D97706; border: 1px solid #FDE68A; }

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
    .btn-action-complete { background: #3B82F6; color: white; }
    .btn-action-complete:hover { background: #2563EB; color: white; }
    .btn-action-chat { background: #111827; color: white; }
    .btn-action-chat:hover { background: #1E293B; color: white; }

    @media (max-width: 900px) {
        .bookings-wrapper {
            flex-direction: column;
        }
    }
</style>

<div class="bookings-container">
    <div class="bookings-wrapper">
        <!-- Tutor Sidebar -->
        @include('tutor.Partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1><i class="fa-solid fa-calendar-check"></i> Session Bookings</h1>
                <p>Manage and conduct scheduled tutoring sessions with enrolled students</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $bookings->count() }}</div>
                    <div class="stat-label">Total Bookings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #059669;">
                        {{ $bookings->where('status', 'confirmed')->count() }}
                    </div>
                    <div class="stat-label">Confirmed Sessions</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #D97706;">
                        {{ $bookings->where('status', 'pending')->count() }}
                    </div>
                    <div class="stat-label">Pending Approval</div>
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

            <!-- Bookings List -->
            <div class="data-card">
                <h3><i class="fa-solid fa-calendar-days" style="color:var(--primary);"></i> Scheduled Sessions</h3>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Subject / Goal</th>
                                <th>Scheduled Time</th>
                                <th>Mode</th>
                                <th>Status</th>
                                <th style="text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                @php
                                    $studentName = $booking->student->name ?? 'Student';
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
                                    <td>{{ $booking->topic ?? 'Course syllabus revision' }}</td>
                                    <td>
                                        <strong>{{ $booking->preferred_date ? \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') : date('M d, Y') }}</strong><br>
                                        <small class="text-muted">{{ $booking->formatted_time }}</small>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">Online 1-on-1</span></td>
                                    










                                    <td>
    @if($booking->status == 'confirmed' && !$booking->tutor_confirmed)
        <span class="status-badge status-pending"><i class="fa-solid fa-clock"></i> Payment Received</span>
    @elseif($booking->status == 'confirmed' && $booking->tutor_confirmed)
        <span class="status-badge status-confirmed"><i class="fa-solid fa-circle-check"></i> Confirmed</span>
    @elseif($booking->status == 'completed')
        <span class="status-badge status-completed"><i class="fa-solid fa-award"></i> Completed</span>
    @else
        <span class="status-badge status-pending"><i class="fa-solid fa-clock"></i> {{ ucfirst($booking->status) }}</span>
    @endif
</td>
<td style="text-align:right;">
    <a href="/tutor/messages" class="btn-table-action btn-action-chat me-1">
        <i class="fa-solid fa-comment"></i> Chat
    </a>
    @if($booking->status == 'confirmed' && !$booking->tutor_confirmed)
        <form action="/tutor/confirm-payment" method="POST" style="display:inline-block;">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <button type="submit" class="btn-table-action btn-action-complete">
                <i class="fa-solid fa-circle-check"></i> Confirm Payment
            </button>
        </form>
    @elseif($booking->status == 'confirmed' && $booking->tutor_confirmed)
        <form action="/tutor/complete-session" method="POST" style="display:inline-block;">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <button type="submit" class="btn-table-action btn-action-complete">
                <i class="fa-solid fa-award"></i> Complete
            </button>
        </form>
    @endif
</td>






                                    
                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No scheduled sessions found.</td>
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