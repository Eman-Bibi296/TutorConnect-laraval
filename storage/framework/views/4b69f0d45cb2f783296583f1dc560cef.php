

<?php $__env->startSection('title', 'Messages'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .chat-container {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 30px 5%;
    }
    
    .chat-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Left Sidebar - Professional Postal */
    .sidebar {
        width: 280px;
        background: white;
        border-radius: 25px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        height: fit-content;
        position: sticky;
        top: 30px;
    }
    
    .sidebar-logo {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f4f8;
    }
    
    .sidebar-logo h2 {
        margin: 0;
        font-size: 1.5rem;
        color: #1a1a2e;
    }
    
    .sidebar-logo span {
        color: #4a6cf7;
    }
    
    .sidebar-logo p {
        font-size: 0.7rem;
        color: #999;
        margin: 5px 0 0;
    }
    
    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-menu li {
        margin-bottom: 8px;
    }
    
    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        color: #555;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s;
        font-weight: 500;
    }
    
    .sidebar-menu a:hover {
        background: #f0f4f8;
        color: #4a6cf7;
    }
    
    .sidebar-menu a.active {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
    }
    
    .logout-link {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    
    /* Conversations Sidebar */
    .conversations-sidebar {
        width: 320px;
        background: white;
        border-radius: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    
    .conv-header {
        padding: 20px;
        border-bottom: 1px solid #f0f4f8;
    }
    
    .conv-header h3 {
        margin: 0;
        font-size: 1.2rem;
        color: #1a1a2e;
    }
    
    .search-box {
        padding: 15px;
        border-bottom: 1px solid #f0f4f8;
    }
    
    .search-box input {
        width: 100%;
        padding: 10px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 25px;
        font-size: 0.85rem;
        outline: none;
    }
    
    .search-box input:focus {
        border-color: #4a6cf7;
    }
    
    .conversations-list {
        flex: 1;
        overflow-y: auto;
        max-height: 500px;
    }
    
    .conversation-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        cursor: pointer;
        transition: background 0.2s;
        border-bottom: 1px solid #f0f4f8;
    }
    
    .conversation-item:hover {
        background: #f8f9fc;
    }
    
    /* Remove blue color from active - change to light gray */
    .conversation-item.active {
        background: #e8f0fe;
        border-left: 3px solid #4a6cf7;
    }
    
    .conversation-item.active .conv-name {
        color: #1a1a2e;
    }
    
    .conv-avatar-letter {
        width: 45px;
        height: 45px;
        background: #ff69b4;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }
    
    .conv-info {
        flex: 1;
    }
    
    .conv-name {
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 3px;
    }
    
    .conv-preview {
        font-size: 0.7rem;
        color: #999;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    /* Main Chat Area */
    .chat-main {
        flex: 1;
        background: white;
        border-radius: 25px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .chat-header {
        padding: 20px;
        border-bottom: 1px solid #f0f4f8;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .chat-avatar-letter {
        width: 50px;
        height: 50px;
        background: #ff69b4;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
    }
    
    .chat-info h3 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a1a2e;
    }
    
    .chat-info p {
        margin: 3px 0 0;
        font-size: 0.7rem;
        color: #999;
    }
    
    .messages-area {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        background: #fafbfc;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .message-row {
        display: flex;
        margin-bottom: 0;
    }
    
    .message-row.sent {
        justify-content: flex-end;
    }
    
    .message-row.received {
        justify-content: flex-start;
    }
    
    .message-bubble {
        max-width: 60%;
        padding: 10px 16px;
        border-radius: 18px;
        font-size: 0.85rem;
        line-height: 1.4;
    }
    
    .message-row.sent .message-bubble {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
        border-bottom-right-radius: 4px;
    }
    
    .message-row.received .message-bubble {
        background: white;
        border: 1px solid #e8e8e8;
        color: #333;
        border-bottom-left-radius: 4px;
    }
    
    .message-time {
        font-size: 0.55rem;
        margin-top: 4px;
        opacity: 0.7;
    }
    
    .chat-input-area {
        padding: 15px 20px;
        background: white;
        border-top: 1px solid #f0f4f8;
        display: flex;
        gap: 10px;
        align-items: center;
    }
    
    .chat-input-area input {
        flex: 1;
        padding: 12px 16px;
        border: 2px solid #e8e8e8;
        border-radius: 25px;
        font-size: 0.85rem;
        outline: none;
    }
    
    .chat-input-area input:focus {
        border-color: #4a6cf7;
    }
    
    .send-btn {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        border: none;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .no-messages {
        text-align: center;
        padding: 50px;
        color: #999;
    }
</style>

<div class="chat-container">
    <div class="chat-wrapper">
        
        <?php echo $__env->make('student.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <!-- Conversations List -->
        <div class="conversations-sidebar">
            <div class="conv-header">
                <h3>Messages</h3>
            </div>
            <div class="search-box">
                <input type="text" id="searchConversation" placeholder="Search conversations...">
            </div>
            <div class="conversations-list" id="conversationsList">
                <?php
                    use App\Models\RequestModel;
                    $studentId = Session::get('student_id');
                    $allTutors = RequestModel::where('student_id', $studentId)
                        ->where('status', 'accepted')
                        ->with('tutor')
                        ->get();
                ?>
                
                <?php $__empty_1 = true; $__currentLoopData = $allTutors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if($conv->tutor): ?>
                    <div class="conversation-item" onclick="selectTutor(<?php echo e($conv->tutor->id); ?>, '<?php echo e($conv->tutor->name); ?>', this)">
                        <div class="conv-avatar-letter">
                            <?php echo e(strtoupper(substr($conv->tutor->name, 0, 1))); ?>

                        </div>
                        <div class="conv-info">
                            <div class="conv-name"><?php echo e($conv->tutor->name); ?></div>
                            <div class="conv-preview">Click to chat</div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div style="padding: 30px; text-align: center; color: #999;">
                        No conversations yet.<br>Send a request to a tutor.
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Main Chat Area -->
        <div class="chat-main" id="chatMain">
            <div class="chat-header" id="chatHeader">
                <div class="chat-avatar-letter" id="chatAvatar">?</div>
                <div class="chat-info">
                    <h3 id="chatTutorName">Select a Tutor</h3>
                    <p id="chatTutorStatus">Tutor</p>
                </div>
            </div>
            
            <div class="messages-area" id="messagesArea">
                <div class="no-messages">Select a conversation from the left</div>
            </div>
            
            <div class="chat-input-area" id="chatInputArea">
                <input type="text" id="messageInput" placeholder="Type your message..." disabled>
                <button class="send-btn" onclick="sendMessage()" disabled>
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentTutorId = null;
    let currentTutorName = null;
    
    function selectTutor(tutorId, tutorName, element) {
        currentTutorId = tutorId;
        currentTutorName = tutorName;
        
        // Update active class
        document.querySelectorAll('.conversation-item').forEach(item => {
            item.classList.remove('active');
        });
        element.classList.add('active');
        
        // Update chat header
        document.getElementById('chatTutorName').innerText = tutorName;
        document.getElementById('chatTutorStatus').innerHTML = 'Tutor';
        document.getElementById('chatAvatar').innerHTML = tutorName.charAt(0).toUpperCase();
        
        // Enable input
        document.getElementById('messageInput').disabled = false;
        document.querySelector('.send-btn').disabled = false;
        
        // Load messages
        loadMessages();
    }
    
    function loadMessages() {
        if (!currentTutorId) return;
        
        fetch(`/student/get-messages/${currentTutorId}`)
            .then(response => response.json())
            .then(data => {
                const area = document.getElementById('messagesArea');
                if(data.length === 0) {
                    area.innerHTML = '<div class="no-messages">No messages yet. Send a message to start the conversation!</div>';
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
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
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
    
    // Search conversations
    document.getElementById('searchConversation')?.addEventListener('keyup', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.conversation-item').forEach(item => {
            const name = item.querySelector('.conv-name').innerText.toLowerCase();
            item.style.display = name.includes(term) ? 'flex' : 'none';
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/student/messages.blade.php ENDPATH**/ ?>