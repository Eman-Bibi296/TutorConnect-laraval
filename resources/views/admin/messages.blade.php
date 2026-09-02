@extends('admin.layout')

@section('title', 'System Messages - Admin Control Center')

@section('content')
<div class="topbar-card" style="display: flex; align-items: center; justify-content: space-between; background: white; padding: 20px 24px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); border: 1px solid #E2E8F0; margin-bottom: 25px; flex-wrap: wrap; gap: 12px;">
    <div>
        <h2 style="font-size: 1.45rem; font-weight: 800; color: #111827; margin: 0;">
            <i class="fa-solid fa-comments text-primary me-2"></i> System Message Logs
        </h2>
        <p style="font-size: 0.85rem; color: #64748B; margin: 2px 0 0;">Audit live chat message exchanges between students and instructors</p>
    </div>
    <div style="display: flex; align-items: center; gap: 12px;">
        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2" style="font-size: 0.85rem; font-weight: 700;">
            Total Messages: {{ $messages->count() }}
        </span>
    </div>
</div>

<div class="section-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>Message Content</th>
                    <th>Sent Time</th>
                    <th>Status</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                    @php
                        $senderLabel = $msg->sender_type === 'student' ? 'Student' : 'Instructor';
                        $receiverLabel = $msg->receiver_type === 'student' ? 'Student' : 'Instructor';
                    @endphp
                    <tr>
                        <td style="font-weight: 700; color: #111827;">
                            <span class="badge {{ $msg->sender_type === 'student' ? 'bg-success' : 'bg-primary' }} bg-opacity-10 text-{{ $msg->sender_type === 'student' ? 'success' : 'primary' }} rounded-pill px-2 py-1 me-1">
                                {{ $senderLabel }}
                            </span>
                            #ID: {{ $msg->sender_id }}
                        </td>
                        <td style="font-weight: 700; color: #111827;">
                            <span class="badge {{ $msg->receiver_type === 'student' ? 'bg-success' : 'bg-primary' }} bg-opacity-10 text-{{ $msg->receiver_type === 'student' ? 'success' : 'primary' }} rounded-pill px-2 py-1 me-1">
                                {{ $receiverLabel }}
                            </span>
                            #ID: {{ $msg->receiver_id }}
                        </td>
                        <td style="max-width: 380px; font-size: 0.88rem; color: #334155;">
                            {{ $msg->message }}
                        </td>
                        <td>{{ $msg->created_at ? $msg->created_at->format('M d, Y h:i A') : 'Recently' }}</td>
                        <td>
                            @if($msg->is_read)
                                <span class="badge bg-light text-muted border"><i class="fa-solid fa-check-double text-success me-1"></i> Read</span>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-dark border"><i class="fa-solid fa-envelope me-1"></i> Unread</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <form action="/admin/message/delete/{{ $msg->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this message log?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" title="Delete Message">
                                    <i class="fa-solid fa-trash-can me-1"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #94A3B8; padding: 35px;">
                            No chat messages recorded in the system yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection