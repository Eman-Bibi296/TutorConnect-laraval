@extends('layouts.app')

@section('title', 'My Bookings - TutorConnect')

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
    .status-unpaid { background: #FFFBEB; color: #D97706; border: 1px solid #FDE68A; }
    .status-cancelled { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }

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
    }
    .btn-action-pay { background: linear-gradient(135deg, #059669 0%, #10B981 100%); color: white; }
    .btn-action-pay:hover { color: white; transform: translateY(-1px); }
    .btn-action-view { background: #F1F5F9; color: #334155; }
    .btn-action-view:hover { background: #E2E8F0; color: #111827; }

    .empty-state {
        text-align: center;
        padding: 45px 20px;
        color: #64748B;
    }
    .empty-state i {
        font-size: 3rem;
        color: #94A3B8;
        margin-bottom: 12px;
    }

    @media (max-width: 900px) {
        .bookings-wrapper {
            flex-direction: column;
        }
    }
</style>

@php
    $totalFee = 0;
    foreach($bookings as $b) {
        $rate = $b->tutor->hourly_rate ?? 1500;
        $totalFee += $rate;
    }
@endphp

<div class="bookings-container">
    <div class="bookings-wrapper">
        <!-- Student Sidebar -->
        @include('student.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1><i class="fa-solid fa-calendar-check"></i> My Scheduled Bookings</h1>
                <p>Manage confirmed tutoring sessions, view payment status, and join classes</p>
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
                        Rs {{ number_format($totalFee) }}
                    </div>
                    <div class="stat-label">Total Fee Value</div>
                </div>
            </div>

            <!-- Bookings List Card -->
            <div class="data-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="m-0"><i class="fa-solid fa-calendar-days" style="color: #059669;"></i> Active Tutoring Sessions</h3>
                    <a href="/student/dashboard" class="btn btn-sm btn-outline-success rounded-pill px-3"><i class="fas fa-plus me-1"></i> Book New Tutor</a>
                </div>

                @if($bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Tutor Name</th>
                                    <th>Subject</th>
                                    <th>Schedule Date & Time</th>
                                    <th>Mode</th>
                                    <th>Fee Rate</th>
                                    <th>Status</th>
                                    <th style="text-align:right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $b)
                                    @php
                                        $t = $b->tutor;
                                        $tutorAvatar = 'images/burhan.png';
                                        if ($t) {
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
                                        }
                                    @endphp
                                    <tr>
                                        <td style="font-weight: 700; color: #111827;">
                                            
                                            {{ $t->name ?? 'Instructor' }}
                                        </td>
                                        <td>{{ $t->subject ?? 'Computer Science' }}</td>
                                        <td>
                                            <strong>{{ $b->preferred_date ? \Carbon\Carbon::parse($b->preferred_date)->format('M d, Y') : date('M d, Y') }}</strong><br>
                                            <small class="text-muted">{{ $b->formatted_time }}</small>
                                        </td>
                                        <td><span class="badge bg-light text-dark border"><i class="fa-solid fa-video me-1 text-success"></i> Online 1-on-1</span></td>
                                        <td style="font-weight:700; color:#059669;">Rs {{ number_format($t->hourly_rate ?? 1500) }}</td>
                                        <td>
                                            @if($b->status == 'confirmed' && !$b->tutor_confirmed)
    <span class="status-badge status-unpaid"><i class="fa-solid fa-clock"></i> Awaiting Tutor Confirmation</span>
@elseif($b->status == 'confirmed' && $b->tutor_confirmed)
    <span class="status-badge status-confirmed"><i class="fa-solid fa-circle-check"></i> Confirmed</span>
                                                
                                            @elseif($b->status == 'completed')
                                                <span class="status-badge status-confirmed" style="background:#EEF2FF; color:#4F46E5; border-color:#C7D2FE;"><i class="fa-solid fa-award"></i> Completed</span>
                                            @elseif($b->status == 'cancelled')
                                                <span class="status-badge status-cancelled"><i class="fa-solid fa-circle-xmark"></i> Cancelled</span>
                                            @else
                                                <span class="status-badge status-unpaid"><i class="fa-solid fa-clock"></i> Pending Confirmation</span>
                                            @endif
                                        </td>
                                        <td style="text-align:right;">
                                            @if($t)
                                                <a href="{{ url('/student/chat-only/' . $t->id) }}" class="btn-table-action btn-action-view me-1" title="Chat with Tutor">
                                                    <i class="fa-solid fa-comments"></i> Chat
                                                </a>
                                            @endif
                                            @if($b->status == 'confirmed' || $b->status == 'pending')
                                                <a href="{{ url('/payment/' . $b->id) }}" class="btn-table-action btn-action-pay me-1">
                                                    <i class="fa-solid fa-credit-card"></i> Pay Fee
                                                </a>
                                                <form action="/student/cancel-booking" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                                    @csrf
                                                    <input type="hidden" name="booking_id" value="{{ $b->id }}">
                                                    <button type="submit" class="btn-table-action btn-action-view text-danger" title="Cancel Booking">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fa-regular fa-calendar-xmark"></i>
                        <h4 class="mt-2" style="font-weight:700; color:#111827;">No Scheduled Bookings Found</h4>
                        <p class="text-muted small mb-3">Browse instructors and book your first 1-on-1 tutoring session today.</p>
                        <a href="/student/dashboard" class="btn btn-success rounded-pill px-4 fw-bold">
                            <i class="fa-solid fa-magnifying-glass me-1"></i> Book a Session
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection