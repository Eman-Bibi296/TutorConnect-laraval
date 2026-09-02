<?php $__env->startSection('title', 'Messages - Tutor Portal - TutorConnect'); ?>

<?php $__env->startSection('content'); ?>
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
        <!-- Tutor Sidebar -->
        <?php echo $__env->make('tutor.Partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <!-- Conversations Sidebar -->
        <div class="conversations-sidebar">
            <div class="conv-header">
                <h3>Student Messages</h3>
            </div>
            <div class="search-box">
                <input type="text" id="searchConversation" placeholder="Search students...">
            </div>
            <div class="conversations-list" id="conversationsList">
                <?php
                    use App\Models\Student;
                    use App\Models\Message;
                    use App\Models\RequestModel;
                    use Illuminate\Support\Facades\Session;

                    $tutorId = Session::get('tutor_id');
                    
                    $allStudents = collect([]);
                    if ($tutorId) {
                        try {
                            $studentIdsFromMsgs = Message::where('receiver_id', $tutorId)->where('receiver_type', 'tutor')->pluck('sender_id')
                                ->merge(Message::where('sender_id', $tutorId)->where('sender_type', 'tutor')->pluck('receiver_id'))
                                ->unique()->toArray();
                                
                            $studentIdsFromReqs = RequestModel::where('tutor_id', $tutorId)->pluck('student_id')->toArray();
                            $allStudentIds = array_unique(array_merge($studentIdsFromMsgs, $studentIdsFromReqs));
                            
                            if (empty($allStudentIds)) {
                                $allStudents = Student::limit(6)->get();
                            } else {
                                $allStudents = Student::whereIn('id', $allStudentIds)->get();
                                if ($allStudents->isEmpty()) {
                                    $allStudents = Student::limit(6)->get();
                                }
                            }
                        } catch (\Throwable $e) {
                            $allStudents = collect([]);
                        }
                    }
                    
                    $activeStudentId = request('student_id') ?? ($allStudents->first()->id ?? null);
                ?>
                
                <?php $__empty_1 = true; $__currentLoopData = $allStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $firstName = strtolower(explode(' ', $student->name)[0]);
                        $studentAvatar = null;
                        if (file_exists(public_path('images/' . $firstName . '.jpg'))) {
                            $studentAvatar = 'images/' . $firstName . '.jpg';
                        } elseif (file_exists(public_path('images/' . $firstName . '.png'))) {
                            $studentAvatar = 'images/' . $firstName . '.png';
                        }
                        $studentAvatarFinal = $studentAvatar ? asset($studentAvatar) : 'https://ui-avatars.com/api/?name=' . urlencode($student->name) . '&background=ECFDF5&color=059669';
                        
                        $lastMsg = Message::where(function($q) use ($tutorId, $student) {
                            $q->where('sender_id', $student->id)->where('receiver_id', $tutorId);
                        })->orWhere(function($q) use ($tutorId, $student) {
                            $q->where('sender_id', $tutorId)->where('receiver_id', $student->id);
                        })->orderBy('created_at', 'desc')->first();
                    ?>
                    <div class="conversation-item <?php echo e($student->id == $activeStudentId ? 'active' : ''); ?>" 
                         id="conv-item-<?php echo e($student->id); ?>"
                         onclick="selectStudent(<?php echo e($student->id); ?>, '<?php echo e(addslashes($student->name)); ?>', '<?php echo e(addslashes($student->email)); ?>', '<?php echo e($studentAvatarFinal); ?>', this)">
                        <img src="<?php echo e($studentAvatarFinal); ?>" alt="<?php echo e($student->name); ?>" class="conv-avatar-img">
                        <div class="conv-info">
                            <div class="conv-name"><?php echo e($student->name); ?></div>
                            <div class="conv-preview"><?php echo e($lastMsg ? $lastMsg->message : 'Click to open conversation'); ?></div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div style="padding: 30px; text-align: center; color: #999;">
                        No messages yet from students.
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Main Chat Area -->
        <div class="chat-main" id="chatMain">
            <div class="chat-header" id="chatHeader">
                <img id="chatHeaderImg" src="<?php echo e(asset('images/eman.jpg')); ?>" class="chat-avatar-img" style="display:none;" alt="Student">
                <div class="chat-info">
                    <h3 id="chatStudentName">Select a Student</h3>
                    <p id="chatStudentStatus">Enrolled Student</p>
                </div>
            </div>
            
            <div class="messages-area" id="messagesArea">
                <div class="no-messages">Loading messages...</div>
            </div>
            
            <div class="chat-input-area" id="chatInputArea">
                <input type="text" id="messageInput" placeholder="Type your reply to student..." disabled>
                <button class="send-btn" id="sendBtn" onclick="sendMessage()" disabled>
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentStudentId = null;
    let currentStudentName = null;
    
    function selectStudent(studentId, studentName, studentEmail, studentAvatarUrl, element) {
        currentStudentId = studentId;
        currentStudentName = studentName;
        
        document.querySelectorAll('.conversation-item').forEach(item => {
            item.classList.remove('active');
        });
        if (element) {
            element.classList.add('active');
        }
        
        document.getElementById('chatStudentName').innerText = studentName;
        document.getElementById('chatStudentStatus').innerHTML = '<i class="fa-solid fa-circle text-success me-1" style="font-size:8px;"></i> Active Student (' + studentEmail + ')';
        const img = document.getElementById('chatHeaderImg');
        if (studentAvatarUrl) {
            img.src = studentAvatarUrl;
            img.style.display = 'block';
        }
        
        document.getElementById('messageInput').disabled = false;
        document.getElementById('sendBtn').disabled = false;
        
        loadStudentMessages();
    }
    
    function loadStudentMessages() {
        if (!currentStudentId) return;
        
        fetch(`/tutor/get-student-messages/${currentStudentId}`)
            .then(response => response.json())
            .then(data => {
                const area = document.getElementById('messagesArea');
                if(!data || data.length === 0) {
                    area.innerHTML = '<div class="no-messages"><i class="fa-regular fa-comments fs-2 mb-2 d-block text-muted"></i>No messages exchanged yet with this student.<br>Send a message below to start your conversation!</div>';
                    return;
                }
                area.innerHTML = data.map(msg => `
                    <div class="message-row ${msg.sender_type === 'tutor' ? 'sent' : 'received'}">
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
        if (message === '' || !currentStudentId) return;
        
        fetch('/tutor/reply-message-ajax', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({
                receiver_id: currentStudentId,
                message: message,
                receiver_type: 'student'
            })
        }).then(response => response.json()).then(data => {
            if (data.success) {
                input.value = '';
                loadStudentMessages();
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/tutor/messages.blade.php ENDPATH**/ ?>