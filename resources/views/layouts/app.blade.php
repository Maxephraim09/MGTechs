<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings['site_name'] ?? config('app.name', 'MGTECHS') }} - Dashboard</title>
    @if($settings['favicon'] ?? null)
        <link rel="icon" href="{{ settingAsset('favicon') }}">
        <link rel="shortcut icon" href="{{ settingAsset('favicon') }}">
    @endif

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <style>
        :root {
            --primary: {{ $settings['primary_color'] ?? '#4F46E5' }};
            --primary-dark: #4338CA;
            --secondary: {{ $settings['secondary_color'] ?? '#7C3AED' }};
            --success: #10B981;
            --danger: #EF4444;
            --warning: #F59E0B;
            --info: {{ $settings['accent_color'] ?? '#06B6D4' }};
            --dark: {{ $settings['background_color'] ?? '#0F172A' }};
            --dark-card: #1E293B;
            --dark-border: #334155;
            --text-primary: #F1F5F9;
            --text-secondary: #94A3B8;
            --sidebar-width: 260px;
            --header-height: 64px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark);
            color: var(--text-primary);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--dark-card);
            border-right: 1px solid var(--dark-border);
            overflow-y: auto;
            z-index: 999;
            transition: transform 0.3s ease;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .admin-sidebar::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 24px 20px;
            border-bottom: 1px solid var(--dark-border);
            margin-bottom: 16px;
            flex-shrink: 0;
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .sidebar-brand .brand-text {
            font-size: 1.3rem;
            font-weight: 800;
            color: white;
        }

        .sidebar-brand .brand-text span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-brand .brand-badge {
            font-size: 0.5rem;
            background: rgba(255,255,255,0.05);
            padding: 2px 8px;
            border-radius: 20px;
            color: var(--text-secondary);
            border: 1px solid var(--dark-border);
        }

        .brand-logo-image {
            display: block;
            width: auto;
            max-width: 180px;
            max-height: 48px;
            object-fit: contain;
        }

        .sidebar-nav-wrapper {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 20px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0 12px;
        }

        .sidebar-nav .nav-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            color: var(--text-secondary);
            letter-spacing: 1px;
            padding: 16px 12px 8px;
            font-weight: 600;
            opacity: 0.5;
        }

        .sidebar-nav .nav-item {
            margin-bottom: 2px;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sidebar-nav .nav-link:hover {
            background: rgba(255,255,255,0.04);
            color: white;
        }

        .sidebar-nav .nav-link.active {
            background: linear-gradient(135deg, rgba(79,70,229,0.15), rgba(124,58,237,0.15));
            color: white;
            border: 1px solid rgba(79,70,229,0.2);
        }

        .sidebar-nav .nav-link i {
            width: 20px;
            font-size: 1rem;
            color: var(--text-secondary);
            transition: color 0.3s ease;
        }

        .sidebar-nav .nav-link.active i {
            color: var(--primary);
        }

        .sidebar-nav .nav-link .badge-count {
            margin-left: auto;
            background: var(--primary);
            color: white;
            font-size: 0.65rem;
            padding: 2px 8px;
            border-radius: 20px;
        }

        .sidebar-nav .nav-link .arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
            font-size: 0.7rem;
        }

        .sidebar-nav .nav-link .arrow.open {
            transform: rotate(180deg);
        }

        .sidebar-nav .sub-menu {
            list-style: none;
            padding-left: 32px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .sidebar-nav .sub-menu.open {
            max-height: 500px;
        }

        .sidebar-nav .sub-menu .nav-link {
            padding: 8px 14px;
            font-size: 0.8rem;
        }

        .sidebar-nav .sub-menu .nav-link i {
            width: 16px;
            font-size: 0.8rem;
        }

        /* ===== MAIN CONTENT ===== */
        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== HEADER ===== */
        .admin-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--dark-border);
            padding: 0 30px;
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .admin-header .page-title h1 {
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
        }

        .admin-header .page-title p {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .admin-header .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-header .header-actions .search-box {
            display: flex;
            align-items: center;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--dark-border);
            border-radius: 10px;
            padding: 8px 14px;
            gap: 10px;
        }

        .admin-header .header-actions .search-box input {
            background: none;
            border: none;
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            outline: none;
            width: 160px;
        }

        .admin-header .header-actions .search-box input::placeholder {
            color: var(--text-secondary);
        }

        .admin-header .header-actions .search-box i {
            color: var(--text-secondary);
        }

        .admin-header .header-actions .notif-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid var(--dark-border);
            background: rgba(255,255,255,0.03);
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            position: relative;
        }

        .admin-header .header-actions .notif-btn:hover {
            background: rgba(255,255,255,0.06);
            color: white;
        }

        .admin-header .header-actions .notif-btn .dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        /* ===== DROPDOWN ===== */
        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px 6px 6px;
            border-radius: 50px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--dark-border);
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
        }

        .dropdown-toggle:hover {
            background: rgba(255,255,255,0.06);
        }

        .dropdown-toggle .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
        }

        .dropdown-toggle .chevron {
            font-size: 0.7rem;
            color: var(--text-secondary);
            transition: transform 0.3s ease;
        }

        .dropdown-toggle .chevron.open {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 220px;
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 12px;
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .dropdown-menu.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 8px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            font-family: 'Inter', sans-serif;
        }

        .dropdown-menu .dropdown-item:hover {
            background: rgba(255,255,255,0.04);
            color: white;
        }

        .dropdown-menu .dropdown-item i {
            width: 18px;
            font-size: 0.9rem;
        }

        .dropdown-menu .dropdown-divider {
            height: 1px;
            background: var(--dark-border);
            margin: 6px 0;
        }

        .dropdown-menu .dropdown-header {
            padding: 8px 14px;
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .notif-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 340px;
            max-width: 400px;
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 12px;
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .notif-dropdown.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .notif-dropdown .notif-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px 12px;
            border-bottom: 1px solid var(--dark-border);
        }

        .notif-dropdown .notif-header h4 {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .notif-dropdown .notif-header a {
            font-size: 0.75rem;
            color: var(--primary);
            text-decoration: none;
        }

        .notif-dropdown .notif-item {
            display: flex;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }

        .notif-dropdown .notif-item:hover {
            background: rgba(255,255,255,0.03);
        }

        .notif-dropdown .notif-item .notif-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notif-dropdown .notif-item .notif-icon.blue {
            background: rgba(79,70,229,0.15);
            color: var(--primary);
        }

        .notif-dropdown .notif-item .notif-icon.green {
            background: rgba(16,185,129,0.15);
            color: var(--success);
        }

        .notif-dropdown .notif-item .notif-content p {
            font-size: 0.85rem;
            color: var(--text-primary);
            line-height: 1.4;
        }

        .notif-dropdown .notif-content .time {
            font-size: 0.7rem;
            color: var(--text-secondary);
        }

        .notif-dropdown .notif-footer {
            padding: 10px 12px 6px;
            text-align: center;
            border-top: 1px solid var(--dark-border);
        }

        .notif-dropdown .notif-footer a {
            font-size: 0.8rem;
            color: var(--text-secondary);
            text-decoration: none;
        }

        .notif-dropdown .notif-footer a:hover {
            color: white;
        }

        /* ===== CONTENT ===== */
        .admin-content {
            padding: 24px 30px;
            flex: 1;
        }

        /* ===== FOOTER ===== */
        .admin-footer {
            border-top: 1px solid var(--dark-border);
            padding: 16px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            background: rgba(15, 23, 42, 0.5);
        }

        .admin-footer p {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .admin-footer p span {
            color: var(--danger);
        }

        .admin-footer .footer-links {
            display: flex;
            gap: 20px;
        }

        .admin-footer .footer-links a {
            font-size: 0.8rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .admin-footer .footer-links a:hover {
            color: white;
        }

        /* ===== MOBILE ===== */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
        }

        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.open {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
            }
            .sidebar-toggle {
                display: block;
            }
            .admin-header {
                padding: 0 16px;
            }
            .admin-header .header-actions .search-box {
                display: none;
            }
            .admin-content {
                padding: 16px;
            }
            .admin-footer {
                padding: 16px;
                flex-direction: column;
                text-align: center;
            }
            .admin-footer .footer-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .dropdown-toggle .name {
                display: none;
            }
            .admin-header .page-title p {
                display: none;
            }
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: var(--dark);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--dark-border);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        {!! $settings['custom_css'] ?? '' !!}
    </style>
</head>
<body>

    <!-- ===== SIDEBAR ===== -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            @if($settings['logo'] ?? null)<img class="brand-logo-image" src="{{ settingAsset('logo') }}" alt="{{ $settings['site_name'] ?? 'MGTECHS' }}">@else<div class="brand-icon"><i class="fas fa-code"></i></div><span class="brand-text">{{ $settings['logo_text'] ?? 'MG' }}<span>{{ $settings['logo_highlight'] ?? 'TECHS' }}</span></span><span class="brand-badge">{{ $settings['logo_badge'] ?? 'Admin' }}</span>@endif
        </div>

        <div class="sidebar-nav-wrapper">
            <ul class="sidebar-nav">
                <li class="nav-label">Main</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-label">Management</li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="toggleSubmenu(event, 'usersSubmenu')">
                        <i class="fas fa-users"></i> <span>Users</span>
                        <i class="fas fa-chevron-down arrow" id="usersArrow"></i>
                    </a>
                    <ul class="sub-menu" id="usersSubmenu">
                        <li class="nav-item"><a href="{{ route('admin.users.index') }}" class="nav-link"><i class="fas fa-list"></i> All Users</a></li>
                        <li class="nav-item"><a href="{{ route('admin.users.create') }}" class="nav-link"><i class="fas fa-user-plus"></i> Add User</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" onclick="toggleSubmenu(event, 'projectsSubmenu')">
                        <i class="fas fa-project-diagram"></i> <span>Projects</span>
                        <span class="badge-count">12</span>
                        <i class="fas fa-chevron-down arrow" id="projectsArrow"></i>
                    </a>
                    <ul class="sub-menu" id="projectsSubmenu">
                        <li class="nav-item"><a href="{{ route('admin.projects.index') }}" class="nav-link"><i class="fas fa-list"></i> All Projects</a></li>
                        <li class="nav-item"><a href="{{ route('admin.projects.create') }}" class="nav-link"><i class="fas fa-plus-circle"></i> New Project</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="toggleSubmenu(event, 'coursesSubmenu')">
                        <i class="fas fa-graduation-cap"></i> <span>Courses</span>
                        <i class="fas fa-chevron-down arrow" id="coursesArrow"></i>
                    </a>
                    <ul class="sub-menu" id="coursesSubmenu">
                        <li class="nav-item"><a href="{{ route('admin.courses.index') }}" class="nav-link"><i class="fas fa-list"></i> All Courses</a></li>
                        <li class="nav-item"><a href="{{ route('admin.courses.create') }}" class="nav-link"><i class="fas fa-plus-circle"></i> New Course</a></li>
                    </ul>
                </li>

                <li class="nav-label">System</li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings') }}" class="nav-link">
                        <i class="fas fa-cog"></i> <span>Settings</span>
                    </a>
                </li>

                <li class="nav-label">Account</li>
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link">
                        <i class="fas fa-user"></i> <span>Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </li>
            </ul>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <div class="flex items-center gap-4" style="display:flex;align-items:center;gap:16px;">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="page-title">
                    <h1>{{ $header ?? 'Dashboard' }}</h1>
                    <p>{{ now()->format('l, F j, Y') }}</p>
                </div>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>

                <!-- Notifications -->
                <div class="dropdown" id="notifDropdown">
                    <button class="notif-btn" onclick="toggleDropdown('notifDropdown', 'notifMenu')">
                        <i class="fas fa-bell"></i>
                        <span class="dot"></span>
                    </button>
                    <div class="notif-dropdown" id="notifMenu">
                        <div class="notif-header">
                            <h4>Notifications</h4>
                            <a href="#">Mark all read</a>
                        </div>
                        <div class="notif-item">
                            <div class="notif-icon blue"><i class="fas fa-user-plus"></i></div>
                            <div class="notif-content"><p>New user registered: <strong>John Doe</strong></p><span class="time">5 min ago</span></div>
                        </div>
                        <div class="notif-item">
                            <div class="notif-icon green"><i class="fas fa-check-circle"></i></div>
                            <div class="notif-content"><p>Project <strong>"EduCore"</strong> completed</p><span class="time">1 hour ago</span></div>
                        </div>
                        <div class="notif-footer"><a href="#">View all</a></div>
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="dropdown" id="userDropdown">
                    <button class="dropdown-toggle" onclick="toggleDropdown('userDropdown', 'userMenu')">
                        <div class="avatar">{{ substr(Auth::user()->name ?? 'A', 0, 2) }}</div>
                        <span class="name">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <i class="fas fa-chevron-down chevron" id="userChevron"></i>
                    </button>
                    <div class="dropdown-menu" id="userMenu">
                        <div class="dropdown-header">
                            <strong>{{ Auth::user()->name ?? 'Admin' }}</strong><br>
                            <span style="font-size:0.75rem;color:var(--text-secondary);">{{ Auth::user()->email ?? '' }}</span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="admin-content">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <footer class="admin-footer">
            <p>&copy; {{ date('Y') }} <strong>{{ brandSetting('company_name', $settings['site_name'] ?? 'MGTECHS Limited') }}</strong>. Built with <span>❤</span> in Nigeria.</p>
            <div class="footer-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Support</a>
            </div>
        </footer>
    </div>

    <!-- ===== SCRIPTS ===== -->
    <script>
        // Sidebar Toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.toggle('open');
        });

        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('adminSidebar');
            const toggle = document.getElementById('sidebarToggle');
            if (window.innerWidth <= 1024 && sidebar?.classList.contains('open')) {
                if (!sidebar.contains(e.target) && !toggle?.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });

        // Dropdown Toggle
        function toggleDropdown(parentId, menuId) {
            const menu = document.getElementById(menuId);
            if (!menu) return;

            document.querySelectorAll('.dropdown-menu.open, .notif-dropdown.open').forEach(el => {
                if (el.id !== menuId) el.classList.remove('open');
            });

            menu.classList.toggle('open');

            const container = document.getElementById(parentId);
            const chevron = container?.querySelector('.chevron');
            if (chevron) chevron.classList.toggle('open');
        }

        document.addEventListener('click', function(e) {
            document.querySelectorAll('.dropdown').forEach(dropdown => {
                if (!dropdown.contains(e.target)) {
                    const menu = dropdown.querySelector('.dropdown-menu, .notif-dropdown');
                    if (menu) menu.classList.remove('open');
                    const chevron = dropdown.querySelector('.chevron');
                    if (chevron) chevron.classList.remove('open');
                }
            });
        });

        // Submenu Toggle
        function toggleSubmenu(event, submenuId) {
            event.preventDefault();
            event.stopPropagation();

            const submenu = document.getElementById(submenuId);
            const arrow = document.getElementById(submenuId.replace('Submenu', 'Arrow'));

            if (!submenu) return;

            document.querySelectorAll('.sub-menu.open').forEach(el => {
                if (el.id !== submenuId) {
                    el.classList.remove('open');
                    const arrowId = el.id.replace('Submenu', 'Arrow');
                    const otherArrow = document.getElementById(arrowId);
                    if (otherArrow) otherArrow.classList.remove('open');
                }
            });

            submenu.classList.toggle('open');
            if (arrow) arrow.classList.toggle('open');
        }

        // Active nav link
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.closest('.sub-menu')) return;
                document.querySelectorAll('.sidebar-nav > .nav-item > .nav-link').forEach(l => {
                    l.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
