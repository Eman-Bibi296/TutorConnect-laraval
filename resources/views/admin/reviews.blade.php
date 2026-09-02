@extends('admin.layout')

@section('title', 'Reviews & Feedback Moderation - Admin Control Center')

@section('content')
<div class="topbar-card" style="display: flex; align-items: center; justify-content: space-between; background: white; padding: 20px 24px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); border: 1px solid #E2E8F0; margin-bottom: 25px; flex-wrap: wrap; gap: 12px;">
    <div>
        <h2 style="font-size: 1.45rem; font-weight: 800; color: #111827; margin: 0;">
            <i class="fa-solid fa-star text-warning me-2"></i> Reviews &amp; Ratings Moderation
        </h2>
        <p style="font-size: 0.85rem; color: #64748B; margin: 2px 0 0;">Inspect student evaluations, star ratings, and feedback comments for quality assurance</p>
    </div>
    <div style="display: flex; align-items: center; gap: 12px;">
        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2" style="font-size: 0.85rem; font-weight: 700;">
            Total Reviews: {{ $feedbacks->count() }}
        </span>
    </div>
</div>

<div class="section-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Reviewed Tutor</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Submitted Date</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedbacks as $feedback)
                    @php
                        $studentName = $feedback->student->name ?? 'Student';
                        $tutorName = $feedback->tutor->name ?? 'Instructor';
                    @endphp
                    <tr>
                        <td style="font-weight: 700; color: #111827;">
                            <i class="fa-solid fa-user-graduate text-success me-1"></i> {{ $studentName }}
                        </td>
                        <td style="font-weight: 700; color: #111827;">
                            <i class="fa-solid fa-chalkboard-user text-primary me-1"></i> {{ $tutorName }}
                        </td>
                        <td>
                            <span style="color: #F59E0B; font-weight: 700; font-size: 0.95rem;">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $feedback->rating ? '★' : '☆' }}
                                @endfor
                                <span class="text-dark small ms-1">({{ number_format((float)$feedback->rating, 1) }})</span>
                            </span>
                        </td>
                        <td style="max-width: 320px; font-size: 0.88rem; color: #475569; font-style: italic;">
                            "{{ $feedback->comment }}"
                        </td>
                        <td>{{ $feedback->created_at ? $feedback->created_at->format('M d, Y') : 'Recently' }}</td>
                        <td style="text-align: right;">
                            <form action="/admin/review/delete/{{ $feedback->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this review comment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" title="Delete Review">
                                    <i class="fa-solid fa-trash-can me-1"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #94A3B8; padding: 35px;">
                            No student reviews or feedback submitted yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection