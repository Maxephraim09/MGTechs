<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings['site_name'] ?? config('app.name', 'MGTECHS') }} - Authentication</title>
    @if($settings['favicon'] ?? null)
        <link rel="icon" href="{{ settingAsset('favicon') }}">
        <link rel="shortcut icon" href="{{ settingAsset('favicon') }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: {{ $settings['background_color'] ?? '#0F172A' }};
            color: #F1F5F9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 32px;
        }

        .auth-logo .logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, {{ $settings['primary_color'] ?? '#4F46E5' }}, {{ $settings['secondary_color'] ?? '#7C3AED' }});
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: white;
        }

        .auth-logo .logo-text {
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
        }

        .auth-logo .logo-text span {
            background: linear-gradient(135deg, {{ $settings['primary_color'] ?? '#4F46E5' }}, {{ $settings['secondary_color'] ?? '#7C3AED' }});
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .auth-logo .logo-badge {
            font-size: 0.5rem;
            background: rgba(255,255,255,0.05);
            padding: 2px 10px;
            border-radius: 50px;
            color: #94A3B8;
            border: 1px solid rgba(255,255,255,0.06);
            font-weight: 400;
        }

        .auth-logo-image {
            display: block;
            width: auto;
            max-width: 220px;
            max-height: 64px;
            object-fit: contain;
        }

        .auth-title {
            text-align: center;
            margin-bottom: 6px;
        }

        .auth-title h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
        }

        .auth-subtitle {
            text-align: center;
            color: #94A3B8;
            font-size: 0.95rem;
            margin-bottom: 28px;
        }

        .auth-card {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(51, 65, 85, 0.5);
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .auth-form .form-group {
            margin-bottom: 18px;
        }

        .auth-form label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: #D1D5DB;
            margin-bottom: 6px;
        }

        .auth-form label i {
            color: #818CF8;
            margin-right: 8px;
        }

        .auth-form .input-wrapper {
            position: relative;
        }

        .auth-form input[type="text"],
        .auth-form input[type="email"],
        .auth-form input[type="password"],
        .auth-form input[type="tel"],
        .auth-form select {
            width: 100%;
            padding: 12px 16px;
            background: rgba(55, 65, 81, 0.5);
            border: 1px solid #4B5563;
            border-radius: 10px;
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .auth-form input::placeholder {
            color: #9CA3AF;
        }

        .auth-form input:focus,
        .auth-form select:focus {
            border-color: #4F46E5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }

        .auth-form .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9CA3AF;
            cursor: pointer;
            transition: color 0.3s ease;
            font-size: 1rem;
        }

        .auth-form .password-toggle:hover {
            color: white;
        }

        .auth-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 16px 0;
            flex-wrap: wrap;
            gap: 8px;
        }

        .auth-options .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .auth-options .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #4F46E5;
            border-radius: 4px;
            cursor: pointer;
        }

        .auth-options .remember-me span {
            font-size: 0.85rem;
            color: #94A3B8;
        }

        .auth-options .forgot-link {
            font-size: 0.85rem;
            color: #818CF8;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .auth-options .forgot-link:hover {
            color: #A5B4FC;
        }

        .btn-auth {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, {{ $settings['primary_color'] ?? '#4F46E5' }}, {{ $settings['secondary_color'] ?? '#7C3AED' }});
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(79, 70, 229, 0.35);
        }

        .btn-auth:active {
            transform: translateY(0);
        }

        .auth-divider {
            position: relative;
            margin: 20px 0;
        }

        .auth-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #334155;
        }

        .auth-divider span {
            position: relative;
            display: inline-block;
            padding: 0 16px;
            background: rgba(30, 41, 59, 0.6);
            color: #64748B;
            font-size: 0.8rem;
            left: 50%;
            transform: translateX(-50%);
        }

        .social-buttons {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 16px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            background: rgba(55, 65, 81, 0.3);
            border: 1px solid #334155;
            border-radius: 10px;
            color: #94A3B8;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .social-btn:hover {
            background: rgba(55, 65, 81, 0.5);
            color: white;
            border-color: #4B5563;
        }

        .social-btn.google:hover { color: #EF4444; }
        .social-btn.facebook:hover { color: #3B82F6; }
        .social-btn.github:hover { color: white; }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
        }

        .auth-footer p {
            font-size: 0.9rem;
            color: #94A3B8;
        }

        .auth-footer a {
            color: #818CF8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .auth-footer a:hover {
            color: #A5B4FC;
        }

        .auth-footer .back-home {
            display: inline-block;
            margin-top: 12px;
            font-size: 0.8rem;
            color: #64748B;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .auth-footer .back-home:hover {
            color: #94A3B8;
        }

        .auth-error {
            color: #F87171;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        .auth-session-status {
            padding: 12px 16px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 10px;
            color: #34D399;
            font-size: 0.9rem;
            margin-bottom: 16px;
            text-align: center;
        }

        .terms-check {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 12px 0 16px;
        }

        .terms-check input[type="checkbox"] {
            width: 16px;
            height: 16px;
            margin-top: 3px;
            accent-color: #4F46E5;
            cursor: pointer;
            flex-shrink: 0;
        }

        .terms-check label {
            font-size: 0.85rem;
            color: #94A3B8;
            cursor: pointer;
        }

        .terms-check label a {
            color: #818CF8;
            text-decoration: none;
        }

        .terms-check label a:hover {
            color: #A5B4FC;
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 24px 18px;
            }
            .auth-title h2 {
                font-size: 1.5rem;
            }
            .social-buttons {
                grid-template-columns: 1fr 1fr 1fr;
            }
            .auth-options {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        {!! $settings['custom_css'] ?? '' !!}
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="auth-logo">
            @if($settings['logo'] ?? null)
                <img class="auth-logo-image" src="{{ settingAsset('logo') }}" alt="{{ $settings['site_name'] ?? 'MGTECHS' }}">
            @else
                <div class="logo-icon">
                    <i class="fas fa-code"></i>
                </div>
                <span class="logo-text">{{ $settings['logo_text'] ?? 'MG' }}<span>{{ $settings['logo_highlight'] ?? 'TECHS' }}</span></span>
                <span class="logo-badge">{{ $settings['logo_badge'] ?? 'Limited' }}</span>
            @endif
        </a>

        <!-- Title -->
        <div class="auth-title">
            <h2>@yield('title', 'Welcome Back')</h2>
        </div>
        <p class="auth-subtitle">@yield('subtitle', 'Sign in to your account to continue')</p>

        <!-- Card -->
        <div class="auth-card">
            @yield('content')
        </div>

        <!-- Footer -->
        <div class="auth-footer">
            <p>&copy; {{ date('Y') }} <strong style="color:white;">{{ brandSetting('company_name', $settings['site_name'] ?? 'MGTECHS Limited') }}</strong>. All rights reserved.</p>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
