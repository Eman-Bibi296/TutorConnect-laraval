<div class="sidebar">
    <div class="sidebar-logo">
        <h2>Admin <span>Panel</span></h2>
        <p>CONTROL CENTER</p>
    </div>
    
    <ul class="sidebar-menu">
        <li><a href="/admin/dashboard">📊 Dashboard</a></li>
        <li><a href="/admin/students">👥 Students</a></li>
        <li><a href="/admin/tutors">👨‍🏫 Tutors</a></li>
        <li><a href="/admin/requests">📋 Requests</a></li>
        <li><a href="/admin/bookings">📅 Bookings</a></li>
        <li><a href="/admin/reviews">⭐ Reviews</a></li>
        <li><a href="/admin/messages">💬 Messages</a></li>
    </ul>
    
    <div class="logout-link">
        <ul class="sidebar-menu">
            <li><a href="/admin/logout">🚪 Logout</a></li>
        </ul>
    </div>
</div>

<style>
    .sidebar {
        width: 280px;
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        border-radius: 25px;
        padding: 25px;
        position: sticky;
        top: 30px;
    }
    .sidebar-logo {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    .sidebar-logo h2 {
        color: white;
        margin: 0;
    }
    .sidebar-logo span {
        color: #4a6cf7;
    }
    .sidebar-logo p {
        color: rgba(255,255,255,0.6);
        font-size: 0.7rem;
        margin: 5px 0 0;
    }
    .sidebar-menu {
        list-style: none;
        padding: 0;
    }
    .sidebar-menu li {
        margin-bottom: 8px;
    }
    .sidebar-menu a {
        display: block;
        padding: 12px 15px;
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s;
    }
    .sidebar-menu a:hover {
        background: rgba(255,255,255,0.1);
        color: white;
    }
    .logout-link {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid rgba(255,255,255,0.2);
    }
</style>