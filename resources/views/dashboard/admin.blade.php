<x-app-layout>
    <!-- ===== WELCOME BANNER ===== -->
    <div class="dashboard-welcome">
        <div class="overlay"></div>
        <div class="glow top-right"></div>
        <div class="glow bottom-left"></div>
        <div class="content">
            <div class="greeting">
                <span class="emoji">👋</span>
                <h1 class="title">Welcome back to {{ $settings['site_name'] ?? 'MGTECHS' }}, <span class="name">{{ Auth::user()->name ?? 'Admin' }}</span></h1>
            </div>
            <p class="subtitle">{{ $settings['tagline'] ?? "Here's what's happening with your business today." }}</p>
            <div class="badges">
                <span class="badge">
                    <span class="dot green"></span>
                    All systems operational
                </span>
                <span class="badge">
                    <i class="fas fa-calendar-alt icon"></i>
                    {{ now()->format('M d, Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- ===== STATISTICS CARDS ===== -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Users -->
        <div class="stat-card hover-blue">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Total Users</p>
                    <p class="stat-number">{{ $totalUsers ?? 0 }}</p>
                </div>
                <div class="stat-icon blue">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-footer">
                <span class="stat-badge green">+{{ $newUsers ?? 0 }}</span>
                <span class="stat-meta">this week</span>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="stat-card hover-green">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Revenue</p>
                    <p class="stat-number">₦{{ number_format($totalRevenue ?? 0, 2) }}</p>
                </div>
                <div class="stat-icon green">
                    <i class="fas fa-naira-sign"></i>
                </div>
            </div>
            <div class="stat-footer">
                <span class="stat-badge green">↑ 12.5%</span>
                <span class="stat-meta">vs last month</span>
            </div>
        </div>

        <!-- Active Projects -->
        <div class="stat-card hover-purple">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Active Projects</p>
                    <p class="stat-number">{{ $activeProjects ?? 0 }}</p>
                </div>
                <div class="stat-icon purple">
                    <i class="fas fa-project-diagram"></i>
                </div>
            </div>
            <div class="stat-footer">
                <span class="stat-badge yellow">{{ $pendingProjects ?? 0 }}</span>
                <span class="stat-meta">pending</span>
            </div>
        </div>

        <!-- Students -->
        <div class="stat-card hover-orange">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Students</p>
                    <p class="stat-number">{{ $totalStudents ?? 0 }}</p>
                </div>
                <div class="stat-icon orange">
                    <i class="fas fa-graduation-cap"></i>
                </div>
            </div>
            <div class="stat-footer">
                <span class="stat-badge blue">+{{ $newStudents ?? 0 }}</span>
                <span class="stat-meta">this month</span>
            </div>
        </div>
    </div>

    <!-- ===== QUICK ACTIONS ===== -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6">
        <div class="quick-actions">
            <h3 class="title">Quick Actions</h3>
            <div class="grid">
                <a href="{{ route('admin.users.create') }}" class="quick-action-btn blue">
                    <i class="fas fa-user-plus icon blue"></i>
                    <span class="label">Add User</span>
                </a>
                <a href="{{ route('admin.courses.create') }}" class="quick-action-btn green">
                    <i class="fas fa-plus-circle icon green"></i>
                    <span class="label">New Course</span>
                </a>
                <a href="{{ route('admin.projects.create') }}" class="quick-action-btn purple">
                    <i class="fas fa-folder-open icon purple"></i>
                    <span class="label">New Project</span>
                </a>
                <a href="{{ route('admin.settings') }}" class="quick-action-btn amber">
                    <i class="fas fa-cog icon amber"></i>
                    <span class="label">Settings</span>
                </a>
            </div>
        </div>

        <!-- Activity -->
        <div class="activity-list lg:col-span-3">
            <div class="header">
                <h3 class="title">Recent Activity</h3>
                <a href="{{ route('admin.projects.index') }}" class="view-all">View All →</a>
            </div>
            <div class="items">
                @forelse($recentActivities ?? [] as $activity)
                    <div class="activity-item">
                        <div class="avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="content">
                            <p class="text">{{ $activity->description ?? 'Activity' }}</p>
                            <p class="time">{{ $activity->created_at->diffForHumans() ?? 'Just now' }}</p>
                        </div>
                        <span class="meta">{{ $activity->created_at->format('H:i') ?? '' }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">No recent activity</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- ===== CHARTS & USERS ===== -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
        <!-- Revenue Chart -->
        <div class="bg-gray-800/60 rounded-xl p-4 border border-gray-700/50">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Revenue Overview</h3>
                <div class="flex gap-1">
                    <button class="chart-filter-btn active">Week</button>
                    <button class="chart-filter-btn inactive">Month</button>
                    <button class="chart-filter-btn inactive">Year</button>
                </div>
            </div>
            <div class="chart-placeholder">
                <div>
                    <div class="icon-wrapper">
                        <i class="fas fa-chart-simple"></i>
                    </div>
                    <span class="text">Chart coming soon</span>
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="user-list">
            <div class="header">
                <h3 class="title">Recent Users</h3>
                <a href="{{ route('admin.users.index') }}" class="view-all">View All →</a>
            </div>
            <div class="items">
                @forelse($recentUsers ?? [] as $user)
                    <div class="user-item">
                        <div class="avatar">{{ substr($user->name ?? 'U', 0, 2) }}</div>
                        <div class="info">
                            <p class="name">{{ $user->name ?? 'User' }}</p>
                            <p class="email">{{ $user->email ?? '' }}</p>
                        </div>
                        <span class="role-badge {{ $user->role ?? 'user' }}">
                            {{ ucfirst($user->role ?? 'user') }}
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">No recent users</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- ===== SYSTEM STATUS ===== -->
    <div class="system-status">
        <div class="header">
            <h3 class="title">System Status</h3>
            <span class="status-badge">
                <span class="dot"></span>
                All systems operational
            </span>
        </div>
        <div class="grid">
            <div class="status-item">
                <span class="dot online"></span>
                <div>
                    <p class="status-label">Server</p>
                    <p class="status-value online">Online</p>
                </div>
            </div>
            <div class="status-item">
                <span class="dot online"></span>
                <div>
                    <p class="status-label">Database</p>
                    <p class="status-value online">Connected</p>
                </div>
            </div>
            <div class="status-item">
                <span class="dot online"></span>
                <div>
                    <p class="status-label">Cache</p>
                    <p class="status-value online">Active</p>
                </div>
            </div>
            <div class="status-item">
                <span class="dot warning"></span>
                <div>
                    <p class="status-label">Queue</p>
                    <p class="status-value warning">Processing</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
