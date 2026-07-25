@extends('layouts.app')

@section('title', 'My Requests')

@section('content')
<style>
    .requests-container {
        background: #f0f4f8;
        min-height: 100vh;
        padding: 30px 5%;
    }
    
    .dashboard-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Sidebar Styles - Same as Dashboard */
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
    
    /* Main Content */
    .main-content {
        flex: 1;
    }
    
    .page-header {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        border-radius: 20px;
        padding: 25px;
        color: white;
        margin-bottom: 30px;
    }
    
    .page-header h1 {
        margin: 0;
        font-size: 1.5rem;
    }
    
    .page-header p {
        margin: 10px 0 0;
        opacity: 0.9;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
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
        color: #666;
        font-size: 0.8rem;
        margin-top: 5px;
    }
    
    .requests-table {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th {
        text-align: left;
        padding: 12px;
        background: #f8f9fc;
        border-bottom: 2px solid #eee;
        font-weight: 600;
    }
    
    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }
    
    .status-pending {
        background: #ffc107;
        color: #333;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        display: inline-block;
    }
    
    .status-accepted {
        background: #28a745;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        display: inline-block;
    }
    
    .status-rejected {
        background: #dc3545;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        display: inline-block;
    }
    
    .btn-book {
        background: linear-gradient(135deg, #4a6cf7, #6c5ce7);
        color: white;
        padding: 6px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.7rem;
        display: inline-block;
    }
</style>

<div class="requests-container">
    <div class="dashboard-wrapper">
        
        @include('student.partials.sidebar')
        
        <div class="main-content">
            <div class="page-header">
                <h1>📋 My Requests</h1>
                <p>View all your tutor requests and their status</p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $totalRequests ?? 0 }}</div>
                    <div class="stat-label">TOTAL REQUESTS</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $pendingRequests ?? 0 }}</div>
                    <div class="stat-label">PENDING</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $acceptedRequests ?? 0 }}</div>
                    <div class="stat-label">ACCEPTED</div>
                </div>
            </div>
            
            <div class="requests-table">
                <h3>📋 Request List</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Tutor Name</th>
                            <th>Subject</th>
                            <th>Requested Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                        <tr>
                            <td>{{ $req->tutor->name ?? 'N/A' }}</td>
                            <td>{{ $req->tutor->subject ?? 'N/A' }}</td>
                            <td>{{ $req->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($req->status == 'pending')
                                    <span class="status-pending">⏳ Pending</span>
                                @elseif($req->status == 'accepted')
                                    <span class="status-accepted">✅ Accepted</span>
                                @else
                                    <span class="status-rejected">❌ Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if($req->status == 'accepted')
                                    <a href="/student/book-session-only/{{ $req->tutor_id }}" class="btn-book">Book Session →</a>
                                @elseif($req->status == 'pending')
                                    <span style="color:#999;">Waiting</span>
                                @else
                                    <span style="color:#999;">Declined</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:40px;">No requests yet. Find a tutor and send a request!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection