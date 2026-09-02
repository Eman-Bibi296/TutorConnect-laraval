@extends('admin.layout')

@section('title', 'Control Center')

@section('content')
<!-- TOPBAR -->
<div style="display: flex; align-items: center; justify-content: space-between; background: white; padding: 18px 24px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); border: 1px solid #E2E8F0; margin-bottom: 28px; flex-wrap: wrap; gap: 12px;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 800; color: #111827; margin: 0;">Admin Control Center</h2>
        <p style="font-size: 0.88rem; color: #64748B; margin: 2px 0 0;">Platform monitoring, tutor verifications, student orders, and system analytics</p>
    </div>
    <div style="display: flex; align-items: center; gap: 12px;">
        <a href="/" class="btn btn-sm btn-outline-dark rounded-pill px-3" style="font-weight:600; padding: 8px 16px;">
            <i class="fa-solid fa-globe me-1"></i> View Live Site
        </a>
        <a href="/admin/dashboard" class="btn btn-sm text-white rounded-pill px-3" style="background:#059669; font-weight:600; padding: 8px 16px;">
            <i class="fa-solid fa-arrows-rotate me-1"></i> Refresh Data
        </a>
    </div>
</div>

<!-- STATS GRID -->
<div class="stats-grid">
    <div class="stat-card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <div class="stat-label">TOTAL STUDENTS</div>
            <div style="width: 44px; height: 44px; border-radius: 14px; background: #EFF6FF; color: #3B82F6; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
        </div>
        <div class="stat-number">{{ $totalStudents }}</div>
        <small style="color: #10B981; font-weight: 600;"><i class="fa-solid fa-arrow-trend-up"></i> Registered Learners</small>
    </div>

    <div class="stat-card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <div class="stat-label">VERIFIED TUTORS</div>
            <div style="width: 44px; height: 44px; border-radius: 14px; background: #ECFDF5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
        </div>
        <div class="stat-number">{{ $totalTutors }}</div>
        <small style="color: #059669; font-weight: 600;">{{ $pendingTutors }} Pending Verification</small>
    </div>

    <div class="stat-card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <div class="stat-label">TOTAL BOOKINGS</div>
            <div style="width: 44px; height: 44px; border-radius: 14px; background: #FEF3C7; color: #D97706; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>
        <div class="stat-number">{{ $totalBookings }}</div>
        <small style="color: #D97706; font-weight: 600;">Active & Completed Sessions</small>
    </div>

    <div class="stat-card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <div class="stat-label">TOTAL REVENUE</div>
            <div style="width: 44px; height: 44px; border-radius: 14px; background: #F3E8FF; color: #9333EA; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fa-solid fa-money-bill-trend-up"></i>
            </div>
        </div>
        <div class="stat-number">Rs {{ number_format($totalRevenue, 0) }}</div>
        <small style="color: #10B981; font-weight: 600;">Platform settled volume</small>
    </div>
</div>

<!-- SECTION 1: RECENT TUTORS -->
<div class="section-card">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
        <h3 class="section-title" style="margin: 0; border: none; padding: 0;">
            <i class="fa-solid fa-chalkboard-user text-success me-2"></i> Faculty & Instructors
        </h3>
        <a href="/admin/tutors" class="btn btn-sm btn-outline-success rounded-pill px-3">View All Tutors ({{ $totalTutors }})</a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Instructor</th>
                    <th>Subject</th>
                    <th>Qualification</th>
                    <th>Rate / Hour</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTutors as $tutor)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            @if($tutor->profile_picture)
                                <img src="{{ asset($tutor->profile_picture) }}" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid #10B981;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($tutor->name) }}&background=ECFDF5&color=059669'">
                            @else
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: #ECFDF5; color: #059669; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; border: 2px solid #10B981;">
                                    {{ substr($tutor->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <strong>{{ $tutor->name }}</strong>
                                <div style="font-size: 0.75rem; color: #64748B;">{{ $tutor->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-light text-dark border">{{ $tutor->subject ?? 'General' }}</span></td>
                    <td>{{ $tutor->qualification ?? 'Certified' }}</td>
                    <td style="font-weight: 700; color: #059669;">Rs {{ number_format((float)($tutor->hourly_rate ?? 1500), 0) }}/hr</td>
                    <td>
                        @if($tutor->is_verified)
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1"><i class="fa-solid fa-circle-check me-1"></i> Verified</span>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-dark rounded-pill px-2 py-1"><i class="fa-solid fa-clock me-1"></i> Pending</span>
                        @endif
                    </td>
                    <td style="text-align: right;">
                        @if(!$tutor->is_verified)
                        <form action="/admin/tutor/verify/{{ $tutor->id }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success" title="Verify Tutor">
                                <i class="fa-solid fa-check"></i> Verify
                            </button>
                        </form>
                        @endif
                        <form action="/admin/tutor/delete/{{ $tutor->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this tutor?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete Tutor">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align: center; color: #94A3B8; padding: 25px;">No tutors registered yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- SECTION 2: RECENT BOOKINGS -->
<div class="section-card">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
        <h3 class="section-title" style="margin: 0; border: none; padding: 0;">
            <i class="fa-solid fa-calendar-check text-primary me-2"></i> Recent Session Bookings
        </h3>
        <a href="/admin/bookings" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All Bookings ({{ $totalBookings }})</a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Assigned Tutor</th>
                    <th>Date & Time</th>
                    <th>Mode</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBookings as $booking)
                <tr>
                    <td><strong>{{ $booking->student->name ?? 'N/A' }}</strong></td>
                    <td>{{ $booking->tutor->name ?? 'N/A' }}</td>
                    <td>{{ $booking->preferred_date }} @ {{ $booking->preferred_time ? \Carbon\Carbon::parse($booking->preferred_time)->format('h:i A') : 'N/A' }}</td>
                    <td><span class="badge bg-light text-dark border">{{ ucfirst($booking->mode ?? 'Online') }}</span></td>
                    <td>
                        @if($booking->status == 'confirmed')
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1"><i class="fa-solid fa-circle-check me-1"></i> Confirmed</span>
                        @elseif($booking->status == 'completed')
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1"><i class="fa-solid fa-award me-1"></i> Completed</span>
                        @elseif($booking->status == 'pending')
                            <span class="badge bg-warning bg-opacity-10 text-dark rounded-pill px-2 py-1"><i class="fa-solid fa-clock me-1"></i> Pending</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-1">Cancelled</span>
                        @endif
                    </td>
                    <td style="text-align: right;">
                        @if($booking->status != 'cancelled')
                        <form action="/admin/booking/cancel/{{ $booking->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Cancel this booking?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-ban"></i> Cancel
                            </button>
                        </form>
                        @else
                            <span class="text-muted small">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align: center; color: #94A3B8; padding: 25px;">No session bookings recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- SECTION 3: RECENT REGISTERED STUDENTS -->
<div class="section-card">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
        <h3 class="section-title" style="margin: 0; border: none; padding: 0;">
            <i class="fa-solid fa-user-graduate text-info me-2"></i> Enrolled Students
        </h3>
        <a href="/admin/students" class="btn btn-sm btn-outline-info rounded-pill px-3">View Directory ({{ $totalStudents }})</a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Registered</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentStudents as $student)
                <tr>
                    <td><strong>{{ $student->name }}</strong></td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->location ?? 'Islamabad' }}</td>
                    <td>{{ $student->created_at->format('M d, Y') }}</td>
                    <td style="text-align: right;">
                        <form action="/admin/student/delete/{{ $student->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this student record?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash-can"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align: center; color: #94A3B8; padding: 25px;">No students enrolled yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- SECTION 4: RECENT REVIEWS -->
<div class="section-card">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
        <h3 class="section-title" style="margin: 0; border: none; padding: 0;">
            <i class="fa-solid fa-star text-warning me-2"></i> Student Feedback & Reviews
        </h3>
        <a href="/admin/reviews" class="btn btn-sm btn-outline-warning rounded-pill px-3 text-dark">Moderate Reviews</a>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Instructor</th>
                    <th>Rating</th>
                    <th>Feedback Comment</th>
                    <th>Date</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentReviews as $review)
                <tr>
                    <td><strong>{{ $review->student->name ?? 'Student' }}</strong></td>
                    <td><strong>{{ $review->tutor->name ?? 'Tutor' }}</strong></td>
                    <td style="color: #F59E0B; font-weight: 700;">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= $review->rating ? '★' : '☆' }}
                        @endfor
                        <span style="color: #111827; font-size: 0.8rem;">({{ $review->rating }}.0)</span>
                    </td>
                    <td style="max-width: 320px; white-space: normal;">"{{ $review->comment }}"</td>
                    <td style="color: #64748B; font-size: 0.82rem;">{{ $review->created_at->format('M d, Y') }}</td>
                    <td style="text-align: right;">
                        <form action="/admin/review/delete/{{ $review->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this review?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align: center; color: #94A3B8; padding: 25px;">No reviews submitted yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection