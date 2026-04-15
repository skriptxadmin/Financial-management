<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1>Dashboard</h1>
        <p>Welcome back!</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <div class="stat-content">
                <h3>Total Sales</h3>
                <p class="stat-value">$12,450</p>
                <span class="stat-change positive">+12% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-content">
                <h3>Total Users</h3>
                <p class="stat-value">1,234</p>
                <span class="stat-change positive">+5% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📈</div>
            <div class="stat-content">
                <h3>Revenue</h3>
                <p class="stat-value">$45,320</p>
                <span class="stat-change positive">+8% from last month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📝</div>
            <div class="stat-content">
                <h3>Orders</h3>
                <p class="stat-value">523</p>
                <span class="stat-change negative">-2% from last month</span>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Recent Activity -->
        <div class="card">
            <div class="card-header">
                <h2>Recent Activity</h2>
            </div>
            <div class="card-body">
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div class="activity-content">
                            <p><strong>New Order</strong> from John Doe</p>
                            <span class="activity-time">2 hours ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div class="activity-content">
                            <p><strong>Payment Received</strong> - $500</p>
                            <span class="activity-time">5 hours ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div class="activity-content">
                            <p><strong>New User</strong> registered</p>
                            <span class="activity-time">1 day ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="card">
            <div class="card-header">
                <h2>Quick Links</h2>
            </div>
            <div class="card-body">
                <div class="quick-links">
                    <a href="#" class="quick-link">View All Orders</a>
                    <a href="#" class="quick-link">Manage Users</a>
                    <a href="#" class="quick-link">View Reports</a>
                    <a href="#" class="quick-link">Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>/* Dashboard Container */
.dashboard-container {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Header */
.dashboard-header {
    margin-bottom: 40px;
}

.dashboard-header h1 {
    font-size: 2.5rem;
    color: #333;
    margin: 0;
}

.dashboard-header p {
    color: #666;
    font-size: 1.1rem;
    margin-top: 5px;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 25px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
}

.stat-icon {
    font-size: 2.5rem;
    opacity: 0.8;
}

.stat-content h3 {
    margin: 0;
    font-size: 0.95rem;
    opacity: 0.9;
}

.stat-value {
    font-size: 1.8rem;
    font-weight: bold;
    margin: 10px 0 5px 0;
}

.stat-change {
    font-size: 0.85rem;
    opacity: 0.8;
}

.stat-change.positive {
    color: #4ade80;
}

.stat-change.negative {
    color: #f87171;
}

/* Content Grid */
.content-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

/* Card */
.card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.card-header {
    background: #f8f9fa;
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
}

.card-header h2 {
    margin: 0;
    font-size: 1.3rem;
    color: #333;
}

.card-body {
    padding: 20px;
}

/* Activity List */
.activity-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.activity-item {
    display: flex;
    gap: 15px;
    align-items: flex-start;
}

.activity-dot {
    width: 10px;
    height: 10px;
    background: #667eea;
    border-radius: 50%;
    margin-top: 5px;
    flex-shrink: 0;
}

.activity-content p {
    margin: 0;
    color: #333;
    font-size: 0.95rem;
}

.activity-time {
    color: #999;
    font-size: 0.85rem;
    display: block;
    margin-top: 3px;
}

/* Quick Links */
.quick-links {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.quick-link {
    display: block;
    padding: 12px 15px;
    background: #f0f4ff;
    color: #667eea;
    text-decoration: none;
    border-radius: 6px;
    transition: all 0.3s ease;
    font-weight: 500;
    border-left: 4px solid #667eea;
}

.quick-link:hover {
    background: #667eea;
    color: white;
    padding-left: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 15px;
    }

    .dashboard-header h1 {
        font-size: 1.8rem;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .content-grid {
        grid-template-columns: 1fr;
    }

    .stat-card {
        padding: 15px;
        gap: 15px;
    }
}
</style>
<?= $this->endSection() ?>