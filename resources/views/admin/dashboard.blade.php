@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card"><div class="stat-number">{{ $totalStudents }}</div><div class="stat-label">Total Students</div></div>
    <div class="stat-card"><div class="stat-number">{{ $totalTutors }}</div><div class="stat-label">Total Tutors</div></div>
    <div class="stat-card"><div class="stat-number">{{ $totalRequests }}</div><div class="stat-label">Total Requests</div></div>
    <div class="stat-card"><div class="stat-number">{{ $totalBookings }}</div><div class="stat-label">Total Bookings</div></div>
    <div class="stat-card"><div class="stat-number">{{ $pendingTutors }}</div><div class="stat-label">Pending Tutors</div></div>
    <div class="stat-card"><div class="stat-number">${{ $totalRevenue }}</div><div class="stat-label">Total Revenue</div></div>
</div>

<div class="section-card">
    <h3 class="section-title">📋 Recent Bookings</h3>
    <table>
        <thead><tr><th>Student</th><th>Tutor</th><th>Date</th><th>Status</th></tr></thead>
        <tbody>
            @forelse($recentBookings as $booking)
            <tr><td>{{ $booking->student->name ?? 'N/A' }}</td><td>{{ $booking->tutor->name ?? 'N/A' }}</td><td>{{ $booking->preferred_date }}</td><td>{{ ucfirst($booking->status) }}</td></tr>
            @empty
            <tr><td colspan="4" style="text-align:center">No bookings yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection