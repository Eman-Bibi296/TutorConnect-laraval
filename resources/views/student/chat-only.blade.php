@extends('layouts.app')

@section('title', 'Chat with Tutor')

@section('content')
<style>
    .chat-container {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 30px 5%;
    }
    .chat-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        max-width: 800px;
        margin: 0 auto;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .chat-header {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        padding: 20px;
        color: white;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .chat-header-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        overflow: hidden;
    }
    .chat-header-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .chat-header-info h2 {
        margin: 0;
        font-size: 1.3rem;
    }
    .chat-header-info p {
        margin: 5px 0 0;
        font-size: 0.8rem;
        opacity: 0.8;
    }
    .back-btn {
        background: rgba(255,255,255,0.2);
        border: none;
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        cursor: pointer;
        margin-left: auto;
        text-decoration: none;
    }
    .chat-messages {
        height: 500px;
        overflow-y: auto;
        padding: 20px;
        background: #f8f9fc;
    }
    .message {
        margin-bottom: 15px;
        display: flex;
    }
    .message.sent {
        justify-content: flex-end;
    }
    .message.received {
        justify-content: flex-start;
    }
    .message-bubble {
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 18px;
        font-size: 0.9rem;
    }
    .message.sent .message-bubble {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
        border-bottom-right-radius: 5px;
    }
    .message.received .message-bubble {
        background: white;
        border: 1px solid #e0e0e0;
        border-bottom-left-radius: 5px;
        color: #333;
    }
    .message-time {
        font-size: 0.7rem;
        margin-top: 5px;
        opacity: 0.7;
    }
    .chat-input {
        padding: 15px;
        background: white;
        border-top: 1px solid #e0e0e0;
        display: flex;
        gap: 10px;
    }
    .chat-input input {
        flex: 1;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 25px;
        outline: none;
    }
    .chat-input input:focus {
        border-color: #4a6cf7;
    }
    .chat-input button {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
        border: none;
        padding: 0 25px;
        border-radius: 25px;
        cursor: pointer;
    }
</style>

<div class="chat-container">
    <div class="chat-card">
        <div class="chat-header">
            <div class="chat-header-avatar">
                @if($tutor->profile_picture)
                    <img src="{{ $tutor->profile_picture }}">
                @else
                    👨‍🏫
                @endif
            </div>
            <div class="chat-header-info">
                <h2>{{ $tutor->name }}</h2>
                <p>{{ $tutor->subject }} Tutor</p>
            </div>
            <a href="/student/dashboard" class="back-btn">← Back</a>
        </div>
        
        <div class="chat-messages" id="chatMessages">
            @foreach($messages as $msg)
                <div class="message {{ $msg->sender_type == 'student' ? 'sent' : 'received' }}">
                    <div class="message-bubble">
                        {{ $msg->message }}
                        <div class="message-time">{{ \Carbon\Carbon::parse($msg->created_at)->format('h:i A') }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="chat-input">
            <input type="text" id="messageInput" placeholder="Type your message...">
            <button onclick="sendMessage()">Send →</button>
        </div>
    </div>
</div>

<script>
    const chatMessages = document.getElementById('chatMessages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
    
    function sendMessage() {
        let input = document.getElementById('messageInput');
        let message = input.value.trim();
        if(message === '') return;
        
        fetch('/student/send-message-ajax', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                receiver_id: {{ $tutor->id }},
                message: message,
                receiver_type: 'tutor'
            })
        }).then(response => response.json()).then(data => {
            if(data.success) {
                let div = document.createElement('div');
                div.className = 'message sent';
                div.innerHTML = `<div class="message-bubble">${message}<div class="message-time">Just now</div></div>`;
                chatMessages.appendChild(div);
                chatMessages.scrollTop = chatMessages.scrollHeight;
                input.value = '';
            }
        });
    }
    
    document.getElementById('messageInput').addEventListener('keypress', function(e) {
        if(e.key === 'Enter') sendMessage();
    });
</script>
@endsection