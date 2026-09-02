@extends('admin.layout')

@section('title', 'Tutors Directory - Admin Control Center')

@section('content')
<div class="topbar-card" style="display: flex; align-items: center; justify-content: space-between; background: white; padding: 20px 24px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); border: 1px solid #E2E8F0; margin-bottom: 25px; flex-wrap: wrap; gap: 12px;">
    <div>
        <h2 style="font-size: 1.45rem; font-weight: 800; color: #111827; margin: 0;">
            <i class="fa-solid fa-chalkboard-user text-success me-2"></i> Faculty &amp; Instructors Directory
        </h2>
        <p style="font-size: 0.85rem; color: #64748B; margin: 2px 0 0;">Verify new tutor applications, manage hourly fees, and monitor teaching profiles</p>
    </div>
    <div style="display: flex; align-items: center; gap: 12px;">
        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2" style="font-size: 0.85rem; font-weight: 700;">
            Total Tutors: {{ $tutors->count() }}
        </span>
    </div>
</div>

<div class="section-card">
    <div style="margin-bottom: 20px; display: flex; gap: 15px; flex-wrap: wrap;">
        <input type="text" id="adminTutorSearch" placeholder="Filter tutors by name, subject, or location..." class="form-control" style="flex: 1; padding: 12px 18px; border-radius: 12px; border: 1.5px solid #CBD5E1; font-size: 0.92rem;">
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Instructor Name</th>
                    <th>Subject &amp; Field</th>
                    <th>Qualification</th>
                    <th>Hourly Rate</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody id="adminTutorsTableBody">
                @forelse($tutors as $tutor)
                    @php
                        $tutorAvatar = 'images/burhan.png';
                        if (!empty($tutor->profile_picture) && file_exists(public_path($tutor->profile_picture))) {
                            $tutorAvatar = $tutor->profile_picture;
                        } else {
                            $firstName = strtolower(explode(' ', str_replace(['Dr.', 'Prof.', 'Mr.', 'Ms.'], '', $tutor->name))[0] ?? 'burhan');
                            if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
                                $tutorAvatar = 'images/' . $firstName . '.jpg';
                            } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
                                $tutorAvatar = 'images/' . $firstName . '.png';
                            }
                        }
                    @endphp
                    <tr>
                        <td style="font-weight: 700; color: #111827;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ asset($tutorAvatar) }}" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 2px solid #10B981;" alt="{{ $tutor->name }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($tutor->name) }}&background=ECFDF5&color=059669'">
                                <div>
                                    <div>{{ $tutor->name }}</div>
                                    <small class="text-muted" style="font-weight: 400; font-size: 0.75rem;">{{ $tutor->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $tutor->subject ?? 'Computer Science' }}</span></td>
                        <td>{{ $tutor->qualification ?? 'Master Degree' }}</td>
                        <td style="font-weight: 700; color: #059669;">Rs {{ number_format((float)($tutor->hourly_rate ?? 1500)) }}/hr</td>
                        <td>{{ $tutor->location ?? 'Islamabad' }}</td>
                        <td>
                            @if($tutor->is_verified)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 font-weight-bold">
                                    <i class="fa-solid fa-circle-check me-1"></i> Verified
                                </span>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-dark rounded-pill px-3 py-1 font-weight-bold">
                                    <i class="fa-solid fa-clock me-1"></i> Pending
                                </span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            @if(!$tutor->is_verified)
                                <form action="/admin/tutor/verify/{{ $tutor->id }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 me-1" title="Approve & Verify">
                                        <i class="fa-solid fa-check me-1"></i> Verify
                                    </button>
                                </form>
                            @endif
                            <form action="/admin/tutor/delete/{{ $tutor->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to permanently delete tutor: {{ addslashes($tutor->name) }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" title="Delete Tutor">
                                    <i class="fa-solid fa-trash-can me-1"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: #94A3B8; padding: 35px;">
                            No registered tutors found in the database.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('adminTutorSearch')?.addEventListener('keyup', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('#adminTutorsTableBody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(term) ? '' : 'none';
        });
    });
</script>
@endsection