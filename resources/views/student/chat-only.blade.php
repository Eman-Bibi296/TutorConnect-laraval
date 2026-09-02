@extends('layouts.app')

@section('title', 'Chat with Tutor - TutorConnect')

@section('content')
<style>
    :root {
        --primary: #059669;
        --primary-hover: #047857;
        --primary-light: #ECFDF5;
        --accent: #10B981;
        --bg-dark: #111827;
        --bg-dark-secondary: #1E293B;
        --bg-light: #F8FAFC;
        --bg-card: #FFFFFF;
        --text-main: #111827;
        --text-muted: #64748B;
        --border-color: #E2E8F0;
    }

    .chat-container {
        background: var(--bg-light);
        min-height: calc(100vh - 180px);
        padding: 35px 5%;
        font-family: 'Poppins', sans-serif;
    }
    .chat-card {
        background: var(--bg-card);
        border-radius: 24px;
        overflow: hidden;
        max-width: 900px;
        margin: 0 auto;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid var(--border-color);
    }
    .chat-header {
        background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-dark-secondary) 100%);
        padding: 20px 24px;
        color: white;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .chat-header-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        font-weight: 700;
        overflow: hidden;
        border: 2px solid var(--accent);
    }
    .chat-header-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .chat-header-info h2 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
    }
    .chat-header-info p {
        margin: 4px 0 0;
        font-size: 0.82rem;
        color: #94A3B8;
    }
    .back-btn {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        color: white;
        padding: 8px 18px;
        border-radius: 20px;
        cursor: pointer;
        margin-left: auto;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .back-btn:hover {
        background: rgba(255,255,255,0.2);
        color: white;
    }
    .chat-messages {
        height: 500px;
        overflow-y: auto;
        padding: 24px;
        background: #F8FAFC;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .message {
        display: flex;
        margin-bottom: 0;
    }
    .message.sent {
        justify-content: flex-end;
    }
    .message.received {
        justify-content: flex-start;
    }
    .message-bubble {
        max-width: 68%;
        padding: 12px 18px;
        border-radius: 18px;
        font-size: 0.92rem;
        line-height: 1.5;
    }
    .message.sent .message-bubble {
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        border-bottom-right-radius: 4px;
    }
    .message.received .message-bubble {
        background: white;
        border: 1px solid var(--border-color);
        border-bottom-left-radius: 4px;
        color: var(--text-main);
    }
    .message-time {
        font-size: 0.7rem;
        margin-top: 4px;
        opacity: 0.8;
    }
    .chat-input {
        display: flex;
        padding: 18px 24px;
        background: white;
        border-top: 1px solid var(--border-color);
        gap: 12px;
        align-items: center;
    }
    .chat-input input {
        flex: 1;
        padding: 12px 18px;
        border: 1.5px solid #CBD5E1;
        border-radius: 25px;
        font-size: 0.95rem;
        outline: none;
        transition: all 0.2s;
        font-family: inherit;
    }
    .chat-input input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    .chat-input button {
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        color: white;
        border: none;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.1rem;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    }
    .chat-input button:hover {
        transform: scale(1.05);
    }
    @media (max-width: 768px) {
        .chat-card { border-radius: 16px; }
        .chat-messages { height: 420px; padding: 16px; }
    }
</style>

<div class="chat-container">
    <div class="chat-card">
        
        <div class="chat-header">
            <div class="chat-header-avatar">
                @if($tutor->profile_picture)
                    <img src="{{ asset($tutor->profile_picture) }}" alt="{{ $tutor->name }}">
                @else
                    {{ substr($tutor->name, 0, 1) }}
                @endif
            </div>
            <div class="chat-header-info">
                <h2>{{ $tutor->name }}</h2>
                <p><i class="fa-solid fa-book"></i> {{ $tutor->subject }}</p>
            </div>
            <a href="/student/messages" class="back-btn"><i class="fa-solid fa-arrow-left"></i> All Messages</a>
        </div>
        
        <div class="chat-messages" id="chatMessages">
            @forelse($messages as $msg)
                <div class="message {{ $msg->sender_type == 'student' ? 'sent' : 'received' }}">
                    <div class="message-bubble">
                        <div>{{ $msg->message }}</div>
                        <div class="message-time">{{ $msg->created_at->format('h:i A') }}</div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; color: #94A3B8; margin-top: 150px;">
                    <i class="fa-solid fa-comments" style="font-size: 2.5rem; margin-bottom: 10px;"></i>
                    <p>No messages yet. Send a greeting to start chatting!</p>
                </div>
            @endforelse
        </div>
        
        <form action="/student/send-message" method="POST" class="chat-input">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $tutor->id }}">
            <input type="hidden" name="receiver_type" value="tutor">
            <input type="text" name="message" placeholder="Type your message..." required autocomplete="off">
            <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
        
    </div>
</div>

<script>
    const chatMessages = document.getElementById('chatMessages');
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
</script>
@endsection