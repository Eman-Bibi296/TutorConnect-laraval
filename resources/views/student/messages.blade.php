@extends('layouts.app')

@section('title', 'Messages - Student Portal - TutorConnect')

@section('content')
<style>
    .chat-container {
        background: #F8FAFC;
        min-height: calc(100vh - 180px);
        padding: 35px 5%;
        font-family: 'Poppins', sans-serif;
    }
    .chat-wrapper {
        display: flex;
        gap: 25px;
        max-width: 1400px;
        margin: 0 auto;
        height: 680px;
    }
    .conversations-sidebar {
        width: 320px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .conv-header {
        padding: 20px 22px;
        border-bottom: 1px solid #F1F5F9;
    }
    .conv-header h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
    }
    .search-box {
        padding: 12px 18px;
        border-bottom: 1px solid #F1F5F9;
    }
    .search-box input {
        width: 100%;
        padding: 10px 16px;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        font-size: 0.88rem;
        outline: none;
        transition: all 0.2s;
    }
    .search-box input:focus {
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    .conversations-list {
        flex: 1;
        overflow-y: auto;
    }
    .conversation-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        cursor: pointer;
        transition: all 0.2s;
        border-bottom: 1px solid #F8FAFC;
    }
    .conversation-item:hover {
        background: #F8FAFC;
    }
    .conversation-item.active {
        background: #ECFDF5;
        border-left: 4px solid #10B981;
    }
    .conv-avatar-img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #10B981;
        flex-shrink: 0;
    }
    .conv-info { flex: 1; min-width: 0; }
    .conv-name {
        font-weight: 700;
        color: #111827;
        font-size: 0.95rem;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .conv-preview {
        font-size: 0.78rem;
        color: #64748B;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .chat-main {
        flex: 1;
        background: white;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
        min-width: 0;
    }
    .chat-header {
        padding: 16px 22px;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 14px;
        background: white;
    }
    .chat-avatar-img {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #10B981;
    }
    .chat-info h3 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
    }
    .chat-info p {
        margin: 2px 0 0;
        font-size: 0.8rem;
        color: #059669;
        font-weight: 600;
    }
    .messages-area {
        flex: 1;
        padding: 22px;
        overflow-y: auto;
        background: #F8FAFC;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .message-row {
        display: flex;
    }
    .message-row.sent {
        justify-content: flex-end;
    }
    .message-row.received {
        justify-content: flex-start;
    }
    .message-bubble {
        max-width: 65%;
        padding: 11px 18px;
        border-radius: 18px;
        font-size: 0.9rem;
        line-height: 1.45;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
    }
    .message-row.sent .message-bubble {
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        border-bottom-right-radius: 4px;
    }
    .message-row.received .message-bubble {
        background: white;
        border: 1px solid #E2E8F0;
        color: #1E293B;
        border-bottom-left-radius: 4px;
    }
    .message-time {
        font-size: 0.65rem;
        margin-top: 4px;
        opacity: 0.8;
    }
    .chat-input-area {
        padding: 16px 20px;
        background: white;
        border-top: 1px solid #F1F5F9;
        display: flex;
        gap: 12px;
        align-items: center;
    }
    .chat-input-area input {
        flex: 1;
        padding: 12px 18px;
        border: 1.5px solid #CBD5E1;
        border-radius: 25px;
        font-size: 0.92rem;
        outline: none;
        transition: all 0.2s;
    }
    .chat-input-area input:focus {
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    .send-btn {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        border: none;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
    }
    .send-btn:hover {
        transform: scale(1.05);
    }
    .no-messages {
        text-align: center;
        padding: 60px 20px;
        color: #94A3B8;
        font-size: 0.95rem;
    }
    @media (max-width: 900px) {
        .chat-wrapper { flex-direction: column; height: auto; }
        .conversations-sidebar { width: 100%; height: 260px; }
        .chat-main { height: 500px; }
    }
</style>

<div class="chat-container">
    <div class="chat-wrapper">
        <!-- Student Sidebar -->
        @include('student.partials.sidebar')
        
        <!-- Conversations Sidebar -->
        <div class="conversations-sidebar">
            <div class="conv-header">
                <h3>Messages</h3>
            </div>
            <div class="search-box">
                <input type="text" id="searchConversation" placeholder="Search conversations...">
            </div>
            <div class="conversations-list" id="conversationsList">
                @php
                    use App\Models\Tutor;
                    use App\Models\Message;
                    use App\Models\RequestModel;
                    $studentId = Session::get('student_id');
                    
                    $allTutors = collect([]);
                    if ($studentId) {
                        try {
                            $tutorIdsFromMsgs = Message::where('sender_id', $studentId)->where('sender_type', 'student')->pluck('receiver_id')
                                ->merge(Message::where('receiver_id', $studentId)->where('receiver_type', 'student')->pluck('sender_id'))
                                ->unique()->toArray();
                                
                            $tutorIdsFromReqs = RequestModel::where('student_id', $studentId)->pluck('tutor_id')->toArray();
                            $allTutorIds = array_unique(array_merge($tutorIdsFromMsgs, $tutorIdsFromReqs));
                            
                            if (empty($allTutorIds)) {
                                $allTutors = Tutor::where('is_verified', true)->limit(6)->get();
                            } else {
                                $allTutors = Tutor::whereIn('id', $allTutorIds)->get();
                                if ($allTutors->isEmpty()) {
                                    $allTutors = Tutor::where('is_verified', true)->limit(6)->get();
                                }
                            }
                        } catch (\Throwable $e) {
                            $allTutors = collect([]);
                        }
                    }
                    
                    $activeTutorId = request('tutor_id') ?? ($allTutors->first()->id ?? null);
                @endphp
                
                @forelse($allTutors as $conv)
                    @php
                        $tutorAvatar = 'images/burhan.png';
                        if (!empty($conv->profile_picture) && file_exists(public_path($conv->profile_picture))) {
                            $tutorAvatar = $conv->profile_picture;
                        } else {
                            $firstName = strtolower(explode(' ', str_replace(['Dr.', 'Prof.', 'Mr.', 'Ms.'], '', $conv->name))[0] ?? 'burhan');
                            if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
                                $tutorAvatar = 'images/' . $firstName . '.jpg';
                            } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
                                $tutorAvatar = 'images/' . $firstName . '.png';
                            }
                        }
                        
                        $lastMsg = Message::where(function($q) use ($studentId, $conv) {
                            $q->where('sender_id', $studentId)->where('receiver_id', $conv->id);
                        })->orWhere(function($q) use ($studentId, $conv) {
                            $q->where('sender_id', $conv->id)->where('receiver_id', $studentId);
                        })->orderBy('created_at', 'desc')->first();
                    @endphp
                    <div class="conversation-item {{ $conv->id == $activeTutorId ? 'active' : '' }}" 
                         id="conv-item-{{ $conv->id }}"
                         onclick="selectTutor({{ $conv->id }}, '{{ addslashes($conv->name) }}', '{{ addslashes($conv->subject) }}', '{{ asset($tutorAvatar) }}', this)">
                        <img src="{{ asset($tutorAvatar) }}" alt="{{ $conv->name }}" class="conv-avatar-img" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($conv->name) }}&background=ECFDF5&color=059669'">
                        <div class="conv-info">
                            <div class="conv-name">{{ $conv->name }}</div>
                            <div class="conv-preview">{{ $lastMsg ? $lastMsg->message : 'Click to chat with instructor' }}</div>
                        </div>
                    </div>
                @empty
                    <div style="padding: 30px; text-align: center; color: #999;">
                        No conversations yet.<br>Select a tutor from the dashboard.
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Main Chat Area -->
        <div class="chat-main" id="chatMain">
            <div class="chat-header" id="chatHeader">
                <img id="chatHeaderImg" src="{{ asset('images/burhan.png') }}" class="chat-avatar-img" style="display:none;" alt="Tutor">
                <div class="chat-info">
                    <h3 id="chatTutorName">Select a Tutor</h3>
                    <p id="chatTutorStatus">Online Verified Instructor</p>
                </div>
            </div>
            
            <div class="messages-area" id="messagesArea">
                <div class="no-messages">Loading messages...</div>
            </div>
            
            <div class="chat-input-area" id="chatInputArea">
                <input type="text" id="messageInput" placeholder="Type your message..." disabled>
                <button class="send-btn" id="sendBtn" onclick="sendMessage()" disabled>
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentTutorId = null;
    let currentTutorName = null;
    
    function selectTutor(tutorId, tutorName, tutorSubject, tutorAvatarUrl, element) {
        currentTutorId = tutorId;
        currentTutorName = tutorName;
        
        document.querySelectorAll('.conversation-item').forEach(item => {
            item.classList.remove('active');
        });
        if (element) {
            element.classList.add('active');
        }
        
        document.getElementById('chatTutorName').innerText = tutorName;
        document.getElementById('chatTutorStatus').innerHTML = tutorSubject ? ('<i class="fa-solid fa-circle text-success me-1" style="font-size:8px;"></i> ' + tutorSubject) : 'Instructor';
        const img = document.getElementById('chatHeaderImg');
        if (tutorAvatarUrl) {
            img.src = tutorAvatarUrl;
            img.style.display = 'block';
        }
        
        document.getElementById('messageInput').disabled = false;
        document.getElementById('sendBtn').disabled = false;
        
        loadMessages();
    }
    
    function loadMessages() {
        if (!currentTutorId) return;
        
        fetch(`/student/get-messages/${currentTutorId}`)
            .then(response => response.json())
            .then(data => {
                const area = document.getElementById('messagesArea');
                if(!data || data.length === 0) {
                    area.innerHTML = '<div class="no-messages"><i class="fa-regular fa-comments fs-2 mb-2 d-block text-muted"></i>No messages exchanged yet.<br>Send a message below to start your conversation!</div>';
                    return;
                }
                area.innerHTML = data.map(msg => `
                    <div class="message-row ${msg.sender_type === 'student' ? 'sent' : 'received'}">
                        <div class="message-bubble">
                            ${escapeHtml(msg.message)}
                            <div class="message-time">${new Date(msg.created_at).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'})}</div>
                        </div>
                    </div>
                `).join('');
                area.scrollTop = area.scrollHeight;
            });
    }
    
    function sendMessage() {
        const input = document.getElementById('messageInput');
        const message = input.value.trim();
        if (message === '' || !currentTutorId) return;
        
        fetch('/student/send-message-ajax', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                receiver_id: currentTutorId,
                message: message,
                receiver_type: 'tutor'
            })
        }).then(response => response.json()).then(data => {
            if (data.success) {
                input.value = '';
                loadMessages();
            }
        });
    }
    
    function escapeHtml(text) {
        let div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    document.getElementById('messageInput')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') sendMessage();
    });
    
    document.getElementById('searchConversation')?.addEventListener('keyup', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.conversation-item').forEach(item => {
            const name = item.querySelector('.conv-name').innerText.toLowerCase();
            item.style.display = name.includes(term) ? 'flex' : 'none';
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const activeItem = document.querySelector('.conversation-item.active') || document.querySelector('.conversation-item');
        if (activeItem) {
            activeItem.click();
        }
    });
</script>
@endsection