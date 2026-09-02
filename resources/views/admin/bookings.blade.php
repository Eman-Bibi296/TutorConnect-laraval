@extends('admin.layout')

@section('title', 'Session Bookings - Admin Control Center')

@section('content')
<div class="topbar-card" style="display: flex; align-items: center; justify-content: space-between; background: white; padding: 20px 24px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); border: 1px solid #E2E8F0; margin-bottom: 25px; flex-wrap: wrap; gap: 12px;">
    <div>
        <h2 style="font-size: 1.45rem; font-weight: 800; color: #111827; margin: 0;">
            <i class="fa-solid fa-calendar-check text-success me-2"></i> Session Bookings &amp; Schedules
        </h2>
        <p style="font-size: 0.85rem; color: #64748B; margin: 2px 0 0;">Manage scheduled sessions, tutor payments, and completed session records</p>
    </div>
    <div style="display: flex; align-items: center; gap: 12px;">
        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2" style="font-size: 0.85rem; font-weight: 700;">
            Total Bookings: {{ $bookings->count() }}
        </span>
    </div>
</div>

<div class="section-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Instructor</th>
                    <th>Date &amp; Time</th>
                    <th>Subject &amp; Goal</th>
                    <th>Fee Rate</th>
                    <th>Status</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    @php
                        $studentName = $booking->student->name ?? 'Student';
                        $tutorName = $booking->tutor->name ?? 'Instructor';
                        $hourlyRate = $booking->tutor->hourly_rate ?? 1500;
                    @endphp
                    <tr>
                        <td style="font-weight: 700; color: #111827;">
                            <i class="fa-solid fa-user-graduate text-success me-1"></i> {{ $studentName }}
                        </td>
                        <td style="font-weight: 700; color: #111827;">
                            <i class="fa-solid fa-chalkboard-user text-primary me-1"></i> {{ $tutorName }}
                        </td>
                        <td>
                            <strong>{{ $booking->preferred_date ? \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') : date('M d, Y') }}</strong><br>
                            <small class="text-muted">{{ $booking->formatted_time }}</small>
                        </td>
                        <td>{{ $booking->topic ?? ($booking->tutor->subject ?? 'Computer Science') }}</td>
                        <td style="font-weight: 700; color: #059669;">Rs {{ number_format((float)$hourlyRate) }}</td>
                        <td>
                            @if($booking->status == 'confirmed')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 font-weight-bold">
                                    <i class="fa-solid fa-circle-check me-1"></i> Confirmed
                                </span>
                            @elseif($booking->status == 'completed')
                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1 font-weight-bold" style="color:#0284C7 !important;">
                                    <i class="fa-solid fa-award me-1"></i> Completed
                                </span>
                            @elseif($booking->status == 'pending')
                                <span class="badge bg-warning bg-opacity-10 text-dark rounded-pill px-3 py-1 font-weight-bold">
                                    <i class="fa-solid fa-clock me-1"></i> Pending
                                </span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1 font-weight-bold">
                                    <i class="fa-solid fa-ban me-1"></i> Cancelled
                                </span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <form action="/admin/booking/cancel/{{ $booking->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to cancel / remove this booking record?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" title="Cancel Booking">
                                    <i class="fa-solid fa-ban me-1"></i> Cancel
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: #94A3B8; padding: 35px;">
                            No session bookings recorded yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection