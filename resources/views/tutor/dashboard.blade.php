@extends('layouts.app')

@section('title', 'Tutor Dashboard - TutorConnect')

@section('content')
<style>
    .dashboard-container {
        background: #F8FAFC;
        min-height: calc(100vh - 180px);
        padding: 35px 5%;
        font-family: 'Poppins', sans-serif;
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
    .welcome-card {
        background: linear-gradient(135deg, #111827 0%, #1e293b 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: white;
        margin-bottom: 28px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .welcome-card h1 {
        margin: 0;
        font-size: 1.6rem;
        font-weight: 700;
    }
    .welcome-card p {
        margin: 8px 0 0;
        color: #94A3B8;
        font-size: 0.95rem;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: white;
        border-radius: 18px;
        padding: 22px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(5, 150, 105, 0.1);
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
        font-weight: 600;
        font-size: 0.9rem;
    }
    .data-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 30px;
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
        letter-spacing: 0.5px;
        border-bottom: 1px solid #E2E8F0;
        text-transform: uppercase;
    }
    .custom-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #F1F5F9;
        color: #334155;
        font-size: 0.92rem;
        vertical-align: middle;
    }
    .custom-table tr:hover td {
        background: #F8FAFC;
    }
    .badge-pending {
        background: #FEF3C7;
        color: #92400E;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .badge-accepted, .badge-confirmed {
        background: #DCFCE7;
        color: #166534;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .badge-completed {
        background: #E0E7FF;
        color: #3730A3;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .badge-rejected {
        background: #FEE2E2;
        color: #991B1B;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-action-accept {
        background: #059669;
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-action-accept:hover {
        background: #047857;
    }
    .btn-action-reject {
        background: #EF4444;
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-action-reject:hover {
        background: #DC2626;
    }
    .btn-action-complete {
        background: #3B82F6;
        color: white;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-action-complete:hover {
        background: #2563EB;
    }

    @media (max-width: 900px) {
        .dashboard-wrapper {
            flex-direction: column;
        }
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        <!-- Tutor Sidebar -->
        @include('tutor.Partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="welcome-card">
                <h1>Welcome back, {{ $tutor->name ?? 'Instructor' }}! 👨‍🏫</h1>
                <p>Here's what is happening with your tutoring sessions and students today.</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $totalRequests }}</div>
                    <div class="stat-label">Total Requests</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $activeStudents }}</div>
                    <div class="stat-label">Active Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #D97706;">{{ $pendingRequests }}</div>
                    <div class="stat-label">Pending Requests</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: #059669;">
                        ⭐ {{ number_format($avgRating ?? 5.0, 1) }}
                    </div>
                    <div class="stat-label">{{ $totalReviews }} Student Reviews</div>
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
                <h3><i class="fas fa-user-clock text-success"></i> Student Requests Management</h3>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>STUDENT NAME</th>
                                <th>SUBJECT</th>
                                <th>LOCATION</th>
                                <th>REQUESTED DATE</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
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
                                    <td>
                                        <img src="{{ asset($studentAvatar) }}" style="width:30px;height:30px;border-radius:50%;object-fit:cover;margin-right:8px;vertical-align:middle;border:1.5px solid #10B981;" alt="{{ $studentName }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($studentName) }}&background=ECFDF5&color=059669'">
                                        <strong>{{ $studentName }}</strong>
                                    </td>
                                    <td>{{ $tutor->subject ?? 'Computer Science' }}</td>
                                    <td>{{ $req->student->location ?? 'Islamabad' }}</td>
                                    <td>{{ $req->created_at ? $req->created_at->format('M d, Y') : 'Recently' }}</td>
                                    <td>
                                        @if($req->status == 'pending')
                                            <span class="badge-pending"><i class="fas fa-clock"></i> Pending</span>
                                        @elseif($req->status == 'accepted')
                                            <span class="badge-accepted"><i class="fas fa-check-circle"></i> Accepted</span>
                                        @else
                                            <span class="badge-rejected"><i class="fas fa-times-circle"></i> Declined</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($req->status == 'pending')
                                            <form action="/tutor/update-status" method="POST" style="display:inline-block;">
                                                @csrf
                                                <input type="hidden" name="request_id" value="{{ $req->id }}">
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="btn-action-accept me-1"><i class="fas fa-check"></i> Accept</button>
                                            </form>
                                            <form action="/tutor/update-status" method="POST" style="display:inline-block;">
                                                @csrf
                                                <input type="hidden" name="request_id" value="{{ $req->id }}">
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn-action-reject"><i class="fas fa-times"></i> Reject</button>
                                            </form>
                                        @else
                                            <span class="text-muted small"><i class="fas fa-check text-success me-1"></i> Processed</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No student connection requests found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bookings Table -->
            <div class="data-card">
                <h3><i class="fas fa-calendar-check text-primary"></i> Live Session Bookings</h3>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>STUDENT</th>
                                <th>DATE & TIME</th>
                                <th>MODE</th>
                                <th>FEE</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
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
                                    <td>
                                        <img src="{{ asset($studentAvatar) }}" style="width:30px;height:30px;border-radius:50%;object-fit:cover;margin-right:8px;vertical-align:middle;border:1.5px solid #10B981;" alt="{{ $studentName }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($studentName) }}&background=ECFDF5&color=059669'">
                                        <strong>{{ $studentName }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $booking->date ?? $booking->preferred_date ?? 'Upcoming' }}</strong><br>
                                        <small class="text-muted">{{ $booking->time ?? '04:00 PM - 05:00 PM' }}</small>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">Online 1-on-1</span></td>
                                    <td style="font-weight:700; color:#059669;">Rs {{ number_format($tutor->hourly_rate ?? 1500) }}</td>
                                    <td>
                                        @if($booking->status == 'confirmed')
                                            <span class="badge-confirmed"><i class="fas fa-check-circle"></i> Confirmed</span>
                                        @elseif($booking->status == 'completed')
                                            <span class="badge-completed"><i class="fas fa-award"></i> Completed</span>
                                        @else
                                            <span class="badge-pending"><i class="fas fa-clock"></i> {{ ucfirst($booking->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->status == 'confirmed')
                                            <form action="/tutor/complete-session" method="POST" style="display:inline-block;">
                                                @csrf
                                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                <button type="submit" class="btn-action-complete"><i class="fas fa-award me-1"></i> Mark Completed</button>
                                            </form>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No active session bookings found.</td>
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