@extends('layouts.app')

@section('title', 'Booking Requests')

@section('content')
<style>
    /* ===== PAGE STYLES ===== */
    .bookings-container {
        padding: 30px 5%;
        background: #f0f4f8;
        min-height: 100vh;
    }
    
    .bookings-wrapper {
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
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
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
        font-size: 1.8rem;
        font-weight: 800;
        color: #4a6cf7;
    }
    
    .stat-label {
        color: #131212;
        font-size: 0.95rem;
        margin-top: 5px;
    }
    
    .stat-card.pending .stat-number { color: #ffc107; }
    .stat-card.confirmed .stat-number { color: #4a6cf7; }
    .stat-card.completed .stat-number { color: #28a745; }
    .stat-card.cancelled .stat-number { color: #dc3545; }
    .stat-card.total .stat-number { color: #1a1a2e; }
    
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
        background: white;
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
    
    .badge-confirmed {
        background: #cce5ff;
        color: #004085;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-completed {
        background: #d4edda;
        color: #155724;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-cancelled {
        background: #f8d7da;
        color: #721c24;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    /* ===== BUTTONS ===== */
    .btn-confirm {
        background: #28a745;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.75rem;
        transition: all 0.3s;
    }
    
    .btn-confirm:hover {
        background: #218838;
        transform: translateY(-2px);
    }
    
    .btn-complete {
        background: #17a2b8;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.75rem;
        transition: all 0.3s;
    }
    
    .btn-complete:hover {
        background: #138496;
        transform: translateY(-2px);
    }
    
    .btn-cancel-booking {
        background: #dc3545;
        color: white;
        border: none;
        padding: 5px 12px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.75rem;
        transition: all 0.3s;
    }
    
    .btn-cancel-booking:hover {
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
        .bookings-wrapper {
            flex-direction: column;
        }
        .page-header {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
    }
</style>

<div class="bookings-container">
    <div class="bookings-wrapper">
        
        <!-- ===== SIDEBAR ===== -->
        @include('tutor.partials.sidebar')
        
        <div class="main-content">
            
            <!-- ===== PAGE HEADER ===== -->
            <div class="page-header">
                <h2> Booking Requests</h2>
                <a href="/tutor/dashboard"></a>
            </div>
            
            <!-- ===== STATS CARDS ===== -->
            <div class="stats-grid">
                <div class="stat-card total">
                    <div class="stat-number">{{ $bookings->count() }}</div>
                    <div class="stat-label">Total Bookings</div>
                </div>
                <div class="stat-card pending">
                    <div class="stat-number">{{ $pendingBookings ?? 0 }}</div>
                    <div class="stat-label"> Pending</div>
                </div>
                <div class="stat-card confirmed">
                    <div class="stat-number">{{ $confirmedBookings ?? 0 }}</div>
                    <div class="stat-label"> Confirmed</div>
                </div>
                <div class="stat-card completed">
                    <div class="stat-number">{{ $completedBookings ?? 0 }}</div>
                    <div class="stat-label">Completed</div>
                </div>
                <div class="stat-card cancelled">
                    <div class="stat-number">{{ $cancelledBookings ?? 0 }}</div>
                    <div class="stat-label">Cancelled</div>
                </div>
            </div>
            
            <!-- ===== FILTERS ===== -->
            <div class="filters">
                <input type="text" id="searchInput" placeholder=" Search by student name..." onkeyup="filterTable()">
                <select id="statusFilter" onchange="filterTable()">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            
            <!-- ===== TABLE ===== -->
            <div class="table-container">
                @if($bookings->count() > 0)
                    <table id="bookingsTable">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Mode</th>
                                <th>Sessions/Week</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->student->name ?? 'N/A' }}</td>
                                <td>{{ $booking->preferred_date ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->preferred_time)->format('h:i A') }}</td>
                                <td>{{ $booking->mode ?? 'N/A' }}</td>
                                <td>{{ $booking->sessions_per_week ?? 'N/A' }}</td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <span class="badge-pending"> Pending</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="badge-confirmed">Confirmed</span>
                                    @elseif($booking->status == 'completed')
                                        <span class="badge-completed">Completed</span>
                                    @else
                                        <span class="badge-cancelled"> Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        @if($booking->status == 'pending')
                                            <form action="/tutor/update-booking-status" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="btn-confirm">Confirm</button>
                                            </form>
                                            <form action="/tutor/update-booking-status" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="btn-cancel-booking"> Cancel</button>
                                            </form>
                                        @elseif($booking->status == 'confirmed')
                                            <form action="/tutor/complete-session" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                <button type="submit" class="btn-complete">Complete</button>
                                            </form>
                                        @elseif($booking->status == 'completed')
                                            <span style="color:#17a2b8; font-weight:600;">✓ Completed</span>
                                        @else
                                            <span style="color:#999;">—</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <h3> No booking requests yet!</h3>
                        <p>When students book sessions, they'll appear here.</p>
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</div>

<script>
function filterTable() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const statusValue = document.getElementById('statusFilter').value.toLowerCase();
    const rows = document.querySelectorAll('#bookingsTable tbody tr');
    
    rows.forEach(row => {
        const name = row.cells[0].textContent.toLowerCase();
        const status = row.cells[5].textContent.toLowerCase().trim();
        
        const matchSearch = name.includes(searchValue);
        const matchStatus = statusValue === '' || status.includes(statusValue);
        
        row.style.display = (matchSearch && matchStatus) ? '' : 'none';
    });
}
</script>
@endsection