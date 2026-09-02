@extends('admin.layout')

@section('title', 'Students Directory - Admin Control Center')

@section('content')
<div class="topbar-card" style="display: flex; align-items: center; justify-content: space-between; background: white; padding: 20px 24px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); border: 1px solid #E2E8F0; margin-bottom: 25px; flex-wrap: wrap; gap: 12px;">
    <div>
        <h2 style="font-size: 1.45rem; font-weight: 800; color: #111827; margin: 0;">
            <i class="fa-solid fa-user-graduate text-success me-2"></i> Students Directory
        </h2>
        <p style="font-size: 0.85rem; color: #64748B; margin: 2px 0 0;">Manage enrolled student accounts, active requests, and locations</p>
    </div>
    <div style="display: flex; align-items: center; gap: 12px;">
        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2" style="font-size: 0.85rem; font-weight: 700;">
            Total Registered: {{ $students->count() }}
        </span>
    </div>
</div>

<div class="section-card">
    <div style="margin-bottom: 20px;">
        <input type="text" id="adminStudentSearch" placeholder="Filter students by name, email, or city..." class="form-control" style="padding: 12px 18px; border-radius: 12px; border: 1.5px solid #CBD5E1; font-size: 0.92rem;">
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Email Address</th>
                    <th>Location / City</th>
                    <th>Joined Date</th>
                    <th>Active Requests</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody id="adminStudentsTableBody">
                @forelse($students as $student)
                    @php
                        $firstName = strtolower(explode(' ', $student->name)[0]);
                        $studentAvatar = 'images/eman.jpg';
                        if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
                            $studentAvatar = 'images/' . $firstName . '.jpg';
                        } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
                            $studentAvatar = 'images/' . $firstName . '.png';
                        }
                    @endphp
                    <tr>
                        <td style="font-weight: 700; color: #111827;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ asset($studentAvatar) }}" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid #10B981;" alt="{{ $student->name }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=ECFDF5&color=059669'">
                                <div>
                                    <div>{{ $student->name }}</div>
                                    <small class="text-muted" style="font-weight: 400; font-size: 0.75rem;">ID: #ST-{{ $student->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $student->email }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $student->location ?? 'Islamabad' }}</span></td>
                        <td>{{ $student->created_at ? $student->created_at->format('M d, Y') : 'Recently' }}</td>
                        <td>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1">
                                {{ $student->requests ? $student->requests->count() : 0 }} Requests
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <form action="/admin/student/delete/{{ $student->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to permanently delete student: {{ addslashes($student->name) }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" title="Delete Student">
                                    <i class="fa-solid fa-trash-can me-1"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #94A3B8; padding: 35px;">
                            No registered students found in the database.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('adminStudentSearch')?.addEventListener('keyup', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('#adminStudentsTableBody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(term) ? '' : 'none';
        });
    });
</script>
@endsection