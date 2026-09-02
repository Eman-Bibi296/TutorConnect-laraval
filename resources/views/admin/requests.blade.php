@extends('admin.layout')

@section('title', 'Student Requests - Admin Control Center')

@section('content')
<div class="topbar-card" style="display: flex; align-items: center; justify-content: space-between; background: white; padding: 20px 24px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); border: 1px solid #E2E8F0; margin-bottom: 25px; flex-wrap: wrap; gap: 12px;">
    <div>
        <h2 style="font-size: 1.45rem; font-weight: 800; color: #111827; margin: 0;">
            <i class="fa-solid fa-inbox text-success me-2"></i> Student Connection Requests
        </h2>
        <p style="font-size: 0.85rem; color: #64748B; margin: 2px 0 0;">Track match requests and student-instructor outreach across all subjects</p>
    </div>
    <div style="display: flex; align-items: center; gap: 12px;">
        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2" style="font-size: 0.85rem; font-weight: 700;">
            Total Requests: {{ $requests->count() }}
        </span>
    </div>
</div>

<div class="section-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Requested Tutor</th>
                    <th>Subject</th>
                    <th>Date Received</th>
                    <th>Status</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                    @php
                        $studentName = $req->student->name ?? 'Student';
                        $tutorName = $req->tutor->name ?? 'Tutor';
                    @endphp
                    <tr>
                        <td style="font-weight: 700; color: #111827;">
                            <i class="fa-solid fa-user-graduate text-success me-1"></i> {{ $studentName }}
                        </td>
                        <td style="font-weight: 700; color: #111827;">
                            <i class="fa-solid fa-chalkboard-user text-primary me-1"></i> {{ $tutorName }}
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $req->tutor->subject ?? 'General' }}</span></td>
                        <td>{{ $req->created_at ? $req->created_at->format('M d, Y') : 'Recently' }}</td>
                        <td>
                            @if($req->status == 'accepted')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 font-weight-bold">
                                    <i class="fa-solid fa-circle-check me-1"></i> Accepted
                                </span>
                            @elseif($req->status == 'pending')
                                <span class="badge bg-warning bg-opacity-10 text-dark rounded-pill px-3 py-1 font-weight-bold">
                                    <i class="fa-solid fa-clock me-1"></i> Pending
                                </span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1 font-weight-bold">
                                    <i class="fa-solid fa-times-circle me-1"></i> Declined
                                </span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <form action="/admin/request/delete/{{ $req->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this request record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" title="Delete Record">
                                    <i class="fa-solid fa-trash-can me-1"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #94A3B8; padding: 35px;">
                            No student connection requests found in the system.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection