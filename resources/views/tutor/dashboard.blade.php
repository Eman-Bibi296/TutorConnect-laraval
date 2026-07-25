@extends('layouts.app')

@section('title', 'Tutor Dashboard')

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
    .main-content {
        flex: 1;
    }
    .welcome-card {
        background: linear-gradient(135deg, #bb911e, #bb911e);
        border-radius: 20px;
        padding: 25px;
        color: white;
        margin-bottom: 30px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: #69e09b;
        border-radius: 20px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #4a6cf7;
    }
    .requests-table {
        background: #69e09b;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th {
        text-align: left;
        padding: 12px;
        background: #69e09b;
        border-bottom: 2px solid #eee;
    }
    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }
    .status-pending {
        background: #119c62;
        color: #333;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        display: inline-block;
    }
    .status-accepted {
        background: #28a745;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        display: inline-block;
    }
    .btn-accept {
        background: #77c98a;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        cursor: pointer;
    }
    .btn-reject {
        background: #dc3545;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        cursor: pointer;
    }
    .booking-table {
        background: #69e09b;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .btn-confirm {
        background: #28a745;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        cursor: pointer;
    }
    .btn-complete {
        background: #17a2b8;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        cursor: pointer;
    }
    .status-confirmed {
        background: #28a745;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        display: inline-block;
    }
    .status-completed {
        background: #17a2b8;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        display: inline-block;
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-wrapper">
        
        @include('tutor.partials.sidebar')
        
        <div class="main-content">
            <div class="welcome-card">
                <h1>Welcome back, {{ Session::get('tutor_name') }}! </h1>
                <p>Here's what's happening with your tutoring sessions today.</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card"><div class="stat-number">{{ $totalRequests ?? 0 }}</div><div>Total Requests</div></div>
                <div class="stat-card"><div class="stat-number">{{ $activeStudents ?? 0 }}</div><div>Active Students</div></div>
                <div class="stat-card"><div class="stat-number">{{ $pendingRequests ?? 0 }}</div><div>Pending Action</div></div>
            </div>

            <div class="requests-table">
                <h3>Student Requests Management</h3>
                <table>
                    <thead>
                        <tr><th>STUDENT NAME</th><th>SUBJECT</th><th>LOCATION/AREA</th><th>REQUESTED DATE</th><th>STATUS</th><th>ACTIONS</th></tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                        <tr>
                            <td>{{ $req->student->name ?? 'N/A' }}</td>
                            <td>{{ $req->tutor->subject ?? 'N/A' }}</td>
                            <td>{{ $req->student->location ?? 'N/A' }}</td>
                            <td>{{ $req->created_at->format('M d, Y') }}</td>
                            <td>@if($req->status == 'pending')<span class="status-pending">Pending</span>@elseif($req->status == 'accepted')<span class="status-accepted">Accepted ✓</span>@else<span class="status-pending" style="background:#dc3545; color:white;">Rejected</span>@endif</td>
                            <td>@if($req->status == 'pending')
                                <form action="/tutor/update-status" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="request_id" value="{{ $req->id }}">
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="btn-accept">Accept</button>
                                </form>
                                <form action="/tutor/update-status" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="request_id" value="{{ $req->id }}">
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn-reject">Reject</button>
                                </form>
                                @else<span style="color:green;">✓ {{ ucfirst($req->status) }}</span>@endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" style="text-align:center;">No requests yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="booking-table">
                <h3>Booking Requests from Students</h3>
                <table>
                    <thead>
                        <tr><th>STUDENT NAME</th><th>DATE</th><th>TIME</th><th>MODE</th><th>SESSIONS/WEEK</th><th>STATUS</th><th>ACTION</th></tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->student->name ?? 'N/A' }}</td>
                            <td>{{ $booking->preferred_date }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->preferred_time)->format('h:i A') }}</td>
                            <td>{{ $booking->mode }}</td>
                            <td>{{ $booking->sessions_per_week }}</td>
                            <td>@if($booking->status == 'pending')<span class="status-pending">Pending</span>@elseif($booking->status == 'confirmed')<span class="status-confirmed">Confirmed ✓</span>@elseif($booking->status == 'completed')<span class="status-completed">Completed ✓</span>@else<span class="status-pending" style="background:#dc3545; color:white;">Cancelled</span>@endif</td>
                            <td>@if($booking->status == 'pending')
                                <form action="/tutor/update-booking-status" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="btn-confirm">Accept Booking</button>
                                </form>
                                @elseif($booking->status == 'confirmed')
                                <form action="/tutor/complete-session" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                    <button type="submit" class="btn-complete">Complete Session</button>
                                </form>
                                @elseif($booking->status == 'completed')<span style="color:#17a2b8;">✓ Completed</span>
                                @else<span style="color:#999;">Cancelled</span>@endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" style="text-align:center; padding:30px;">No booking requests yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection