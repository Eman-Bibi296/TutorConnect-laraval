 

<?php $__env->startSection('title', 'Student Requests'); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* ===== PAGE STYLES ===== */
    .requests-container {
        padding: 30px 5%;
        background: #7aa1c9;
        min-height: 100vh;
    }
    
    .requests-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .main-content {
        flex: 1;
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    
    .page-header h2 {
        margin: 0;
        color: #1a1a2e;
        font-size: 1.8rem;
    }
    
    /* ===== STATS CARDS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: #d4d19d ;
        border-radius: 20px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #4a6cf7;
    }
    
    .stat-label {
        color: #131212;
        font-size: 0.95rem;
        margin-top: 5px;
    }
    
    .stat-card.pending .stat-number { color: #ffc107; }
    .stat-card.accepted .stat-number { color: #28a745; }
    .stat-card.rejected .stat-number { color: #dc3545; }
    .stat-card.total .stat-number { color: #4a6cf7; }
    
    /* ===== FILTERS ===== */
    .filters {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .filters input, .filters select {
        padding: 10px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 0.95rem;
        background: white;
    }
    
    .filters input:focus, .filters select:focus {
        border-color: #4a6cf7;
        outline: none;
    }
    
    /* ===== TABLE ===== */
    .table-container {
        background: #d4d19d;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow-x: auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th {
        text-align: left;
        padding: 12px 15px;
        color: #131212;
        font-weight: 600;
        font-size: 0.95rem;
        border-bottom: 2px solid #f0f4f8;
    }
    
    td {
        padding: 12px 15px;
        border-bottom: 1px solid #f0f4f8;
        color: #333;
    }
    
    /* ===== BADGES ===== */
    .badge-pending {
        background: #fff3cd;
        color: #856404;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-accepted {
        background: #d4edda;
        color: #155724;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-rejected {
        background: #f8d7da;
        color: #721c24;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    /* ===== BUTTONS ===== */
    .btn-accept {
        background: #28a745;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.75rem;
        transition: all 0.3s;
    }
    
    .btn-accept:hover {
        background: #218838;
        transform: translateY(-2px);
    }
    
    .btn-reject {
        background: #dc3545;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.75rem;
        transition: all 0.3s;
    }
    
    .btn-reject:hover {
        background: #c82333;
        transform: translateY(-2px);
    }
    
    .btn-view {
        background: #4a6cf7;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.75rem;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }
    
    .btn-view:hover {
        background: #3a5bd0;
        transform: translateY(-2px);
    }
    
    .action-buttons {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }
    
    .empty-state {
        text-align: center;
        padding: 50px;
        color: #888;
    }
    
    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }
        .filters {
            flex-direction: column;
        }
        .requests-wrapper {
            flex-direction: column;
        }
        .page-header {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
    }
</style>

<div class="requests-container">
    <div class="requests-wrapper">
        
        <!-- ===== SIDEBAR ===== -->
        <?php echo $__env->make('tutor.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <div class="main-content">
            
            <!-- ===== PAGE HEADER ===== -->
            <div class="page-header">
                <h2> Student Requests</h2>
                <a href="/tutor/dashboard" ></a>
            </div>
            
            <!-- ===== STATS CARDS ===== -->
            <div class="stats-grid">
                <div class="stat-card total">
                    <div class="stat-number"><?php echo e($requests->count()); ?></div>
                    <div class="stat-label">Total Requests</div>
                </div>
                <div class="stat-card pending">
                    <div class="stat-number"><?php echo e($pendingRequests ?? 0); ?></div>
                    <div class="stat-label"> Pending</div>
                </div>
                <div class="stat-card accepted">
                    <div class="stat-number"><?php echo e($acceptedRequests ?? 0); ?></div>
                    <div class="stat-label"> Accepted</div>
                </div>
                <div class="stat-card rejected">
                    <div class="stat-number"><?php echo e($rejectedRequests ?? 0); ?></div>
                    <div class="stat-label"> Rejected</div>
                </div>
            </div>
            
            <!-- ===== FILTERS ===== -->
            <div class="filters">
                <input type="text" id="searchInput" placeholder=" Search by student name..." onkeyup="filterTable()">
                <select id="statusFilter" onchange="filterTable()">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            
            <!-- ===== TABLE ===== -->
            <div class="table-container">
                <?php if($requests->count() > 0): ?>
                    <table id="requestsTable">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Subject</th>
                                <th>Location</th>
                                <th>Requested Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($req->student->name ?? 'N/A'); ?></td>
                                <td><?php echo e($req->tutor->subject ?? 'N/A'); ?></td>
                                <td><?php echo e($req->student->location ?? 'N/A'); ?></td>
                                <td><?php echo e($req->created_at->format('M d, Y')); ?></td>
                                <td>
                                    <?php if($req->status == 'pending'): ?>
                                        <span class="badge-pending">Pending</span>
                                    <?php elseif($req->status == 'accepted'): ?>
                                        <span class="badge-accepted">Accepted</span>
                                    <?php else: ?>
                                        <span class="badge-rejected">Rejected</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <?php if($req->status == 'pending'): ?>
                                            <form action="/tutor/update-status" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="request_id" value="<?php echo e($req->id); ?>">
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="btn-accept"> Accept</button>
                                            </form>
                                            <form action="/tutor/update-status" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="request_id" value="<?php echo e($req->id); ?>">
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn-reject"> Reject</button>
                                            </form>
                                        <?php else: ?>
                                            <span style="color:green; font-weight:600;">✓ <?php echo e(ucfirst($req->status)); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <h3>📭 No student requests yet!</h3>
                        <p>When students request you, they'll appear here.</p>
                    </div>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</div>

<script>
function filterTable() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const statusValue = document.getElementById('statusFilter').value.toLowerCase();
    const rows = document.querySelectorAll('#requestsTable tbody tr');
    
    rows.forEach(row => {
        const name = row.cells[0].textContent.toLowerCase();
        const status = row.cells[4].textContent.toLowerCase().trim();
        
        const matchSearch = name.includes(searchValue);
        const matchStatus = statusValue === '' || status.includes(statusValue);
        
        row.style.display = (matchSearch && matchStatus) ? '' : 'none';
    });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TutorConnect\resources\views/tutor/requests.blade.php ENDPATH**/ ?>