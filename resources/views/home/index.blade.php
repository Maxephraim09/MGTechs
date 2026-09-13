<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings['meta_title'] ?? $settings['site_name'] ?? 'MGTECHS' }}</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $settings['meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $settings['meta_keywords'] ?? '' }}">
    <meta name="author" content="{{ $settings['company_name'] ?? $settings['site_name'] ?? 'MGTECHS' }}">
    
    <!-- Open Graph -->
    <meta property="og:title" content="{{ $settings['meta_title'] ?? $settings['site_name'] ?? 'MGTECHS' }}">
    <meta property="og:description" content="{{ $settings['meta_description'] ?? '' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    
    <!-- Favicon -->
    @if($settings['favicon'] ?? null)
        <link rel="icon" href="{{ settingAsset('favicon') }}">
        <link rel="shortcut icon" href="{{ settingAsset('favicon') }}">
    @endif
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* ============================================
                   MODERN RESET & BASE
                   ============================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: {{ $settings['primary_color'] ?? '#4F46E5' }};
            --primary-dark: #4338CA;
            --primary-light: #818CF8;
            --secondary: {{ $settings['secondary_color'] ?? '#7C3AED' }};
            --accent: {{ $settings['accent_color'] ?? '#06B6D4' }};
            --success: #10B981;
            --dark: {{ $settings['background_color'] ?? '#0F172A' }};
            --dark-card: #1E293B;
            --dark-border: #334155;
            --gray: #94A3B8;
            --light-gray: #E2E8F0;
            --text-primary: #F1F5F9;
            --text-secondary: #94A3B8;
            --gradient: linear-gradient(135deg, #4F46E5, #7C3AED, #06B6D4);
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.06);
            --shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            --radius: 20px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.7;
            min-height: 100vh;
        }

        /* ============================================
                   SCROLLBAR
                   ============================================ */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--dark);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary);
        }

        /* ============================================
                   LOADING
                   ============================================ */
        #preloader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: var(--dark);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.6s ease, visibility 0.6s ease;
        }

        #preloader.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .preloader-ring {
            width: 60px;
            height: 60px;
            position: relative;
        }

        .preloader-ring::before,
        .preloader-ring::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 3px solid transparent;
            animation: preloaderSpin 1.5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }

        .preloader-ring::before {
            border-top-color: var(--primary);
            border-right-color: var(--secondary);
            animation-delay: 0s;
        }

        .preloader-ring::after {
            border-bottom-color: var(--accent);
            border-left-color: var(--primary);
            width: 70%;
            height: 70%;
            top: 15%;
            left: 15%;
            animation-delay: 0.5s;
        }

        @keyframes preloaderSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* ============================================
                   CONTAINER
                   ============================================ */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ============================================
                   HEADER / NAVIGATION
                   ============================================ */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 16px 0;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            transition: var(--transition);
        }

        .header.scrolled {
            background: rgba(15, 23, 42, 0.95);
            box-shadow: var(--shadow);
            padding: 12px 0;
        }

        .header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            font-size: 1.6rem;
            font-weight: 800;
            color: white;
            transition: var(--transition);
        }

        .logo .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            transition: var(--transition);
        }

        .logo:hover .logo-icon {
            transform: scale(1.05) rotate(-5deg);
        }

        .logo .logo-text span {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo .logo-badge {
            font-size: 0.55rem;
            background: var(--glass-bg);
            padding: 2px 10px;
            border-radius: 50px;
            color: var(--text-secondary);
            border: 1px solid var(--glass-border);
            font-weight: 400;
            -webkit-text-fill-color: var(--text-secondary);
        }

        .logo .logo-image {
            display: block;
            width: auto;
            max-width: 200px;
            max-height: 60px;
            object-fit: contain;
        }

        /* Navigation */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient);
            border-radius: 2px;
            transition: var(--transition);
        }

        .nav-links a:hover::after,
        .nav-links a.active::after {
            width: 100%;
        }

        .nav-links a:hover {
            color: white;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-outline {
            padding: 8px 20px;
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            color: white;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: var(--transition);
            background: transparent;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .btn-primary {
            padding: 8px 24px;
            background: var(--gradient);
            border-radius: 50px;
            color: white;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(79, 70, 229, 0.35);
        }

        .btn-primary-sm {
            padding: 6px 18px;
            font-size: 0.8rem;
        }

        /* Mobile Menu */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 4px;
            transition: var(--transition);
        }

        .menu-toggle:hover {
            color: var(--primary-light);
        }

        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: var(--dark-card);
                padding: 24px;
                gap: 16px;
                border-bottom: 1px solid var(--dark-border);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
            }

            .nav-links.open {
                display: flex;
            }

            .nav-actions {
                flex-direction: column;
                width: 100%;
                gap: 8px;
            }

            .nav-actions .btn-outline,
            .nav-actions .btn-primary {
                width: 100%;
                text-align: center;
                padding: 12px;
            }
        }

        /* ============================================
                   BUTTONS
                   ============================================ */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 35px;
            background: var(--gradient);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(79, 70, 229, 0.3);
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--glass-border);
            color: white;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: none;
        }

        .btn-sm {
            padding: 8px 20px;
            font-size: 0.85rem;
        }

        .btn-lg {
            padding: 18px 45px;
            font-size: 1.1rem;
        }

        /* ============================================
                   SECTIONS
                   ============================================ */
        section {
            padding: 100px 0;
        }

        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 60px;
        }

        .section-header .badge {
            display: inline-block;
            padding: 4px 16px;
            background: rgba(79, 70, 229, 0.12);
            border: 1px solid rgba(79, 70, 229, 0.2);
            border-radius: 50px;
            color: var(--primary-light);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }

        .section-header h2 {
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 12px;
        }

        .section-header h2 .highlight {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-header p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            line-height: 1.8;
        }

        /* ============================================
                   HERO SECTION
                   ============================================ */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(79, 70, 229, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(124, 58, 237, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-glow {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.15;
            pointer-events: none;
        }

        .hero-glow.glow-1 {
            top: -100px;
            right: -100px;
            background: var(--primary);
        }

        .hero-glow.glow-2 {
            bottom: -100px;
            left: -100px;
            background: var(--secondary);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 850px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 18px;
            background: rgba(79, 70, 229, 0.12);
            border: 1px solid rgba(79, 70, 229, 0.2);
            border-radius: 50px;
            color: var(--primary-light);
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 24px;
        }

        .hero-badge .dot {
            width: 6px;
            height: 6px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(0.8); }
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 900;
            line-height: 1.05;
            margin-bottom: 20px;
        }

        .hero h1 .highlight {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.2rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin-bottom: 32px;
            line-height: 1.8;
        }

        .hero-tech-stack {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 32px;
        }

        .hero-tech-stack span {
            padding: 4px 16px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 500;
            transition: var(--transition);
        }

        .hero-tech-stack span:hover {
            border-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-top: 60px;
            padding-top: 40px;
            border-top: 1px solid var(--glass-border);
            max-width: 600px;
        }

        .hero-stats .stat {
            text-align: left;
        }

        .hero-stats .stat-number {
            font-size: 2.2rem;
            font-weight: 800;
            color: white;
            line-height: 1;
        }

        .hero-stats .stat-number .plus {
            color: var(--primary-light);
        }

        .hero-stats .stat-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
            .hero-stats .stat-number {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 2rem;
            }
            .hero p {
                font-size: 1rem;
            }
        }

        /* ============================================
                   SERVICES SECTION
                   ============================================ */
        .services {
            background: rgba(255, 255, 255, 0.01);
            position: relative;
        }

        .services::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 50% 0%, rgba(79, 70, 229, 0.03), transparent 70%);
            pointer-events: none;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            position: relative;
        }

        .service-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 32px 28px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--gradient);
            opacity: 0;
            transition: var(--transition);
        }

        .service-card:hover::before {
            opacity: 1;
        }

        .service-card:hover {
            transform: translateY(-6px);
            border-color: rgba(79, 70, 229, 0.2);
            box-shadow: var(--shadow);
        }

        .service-card .icon {
            width: 56px;
            height: 56px;
            background: rgba(79, 70, 229, 0.1);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary-light);
            margin-bottom: 16px;
            transition: var(--transition);
        }

        .service-card:hover .icon {
            background: var(--gradient);
            color: white;
            transform: scale(1.05);
        }

        .service-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: white;
        }

        .service-card p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 16px;
        }

        .service-card .learn-more {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--primary-light);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .service-card .learn-more:hover {
            gap: 12px;
            color: white;
        }

        /* ============================================
                   ABOUT SECTION
                   ============================================ */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-text h3 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .about-text p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .about-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 24px;
        }

        .about-features li {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .about-features li i {
            color: var(--success);
            font-size: 1rem;
        }

        .about-image {
            position: relative;
        }

        .about-image .card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 40px 30px;
            text-align: center;
        }

        .about-image .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto 16px;
            border: 3px solid var(--primary);
            overflow: hidden;
            background: rgba(79, 70, 229, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--primary-light);
        }

        .about-image .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .about-image .card h3 {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .about-image .card .title {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .about-image .card .badge {
            display: inline-block;
            padding: 4px 14px;
            background: rgba(79, 70, 229, 0.12);
            border-radius: 50px;
            color: var(--primary-light);
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 8px;
        }

        .about-image .floating-badge {
            position: absolute;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 12px 18px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: float 3s ease-in-out infinite;
        }

        .about-image .floating-badge:nth-child(2) {
            top: -20px;
            right: -20px;
            animation-delay: 0.5s;
        }

        .about-image .floating-badge:nth-child(3) {
            bottom: -20px;
            left: -20px;
            animation-delay: 1s;
        }

        .about-image .floating-badge i {
            font-size: 1.2rem;
            color: var(--primary-light);
        }

        .about-image .floating-badge span {
            font-size: 0.85rem;
            font-weight: 600;
            color: white;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @media (max-width: 768px) {
            .about-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .about-features {
                grid-template-columns: 1fr;
            }
            .about-image .floating-badge {
                display: none;
            }
        }

        /* ============================================
                   PORTFOLIO SECTION
                   ============================================ */
        .portfolio {
            background: rgba(255, 255, 255, 0.01);
        }

        .portfolio-filter {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 24px;
            border-radius: 50px;
            border: 1px solid var(--glass-border);
            background: transparent;
            color: var(--text-secondary);
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.85rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--gradient);
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .portfolio-item {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: var(--transition);
        }

        .portfolio-item:hover {
            transform: translateY(-6px);
            border-color: rgba(79, 70, 229, 0.2);
            box-shadow: var(--shadow);
        }

        .portfolio-item .image {
            width: 100%;
            height: 220px;
            background: rgba(79, 70, 229, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--primary-light);
        }

        .portfolio-item .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .portfolio-item .info {
            padding: 24px;
        }

        .portfolio-item .info .tag {
            display: inline-block;
            padding: 2px 12px;
            background: rgba(79, 70, 229, 0.1);
            border-radius: 50px;
            color: var(--primary-light);
            font-size: 0.7rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .portfolio-item .info .tag.featured {
            background: rgba(245, 158, 11, 0.15);
            color: #FBBF24;
        }

        .portfolio-item .info h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: white;
        }

        .portfolio-item .info p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 12px;
        }

        .portfolio-item .info .tech-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .portfolio-item .info .tech-tags span {
            padding: 2px 12px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            font-size: 0.7rem;
            color: var(--text-secondary);
        }

        /* ============================================
                   SKILLS SECTION
                   ============================================ */
        .skills-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .skills-text h3 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .skills-text p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .skill-item {
            margin-bottom: 20px;
        }

        .skill-item .skill-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .skill-item .skill-header .skill-name {
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .skill-item .skill-header .skill-percent {
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .skill-item .skill-bar {
            width: 100%;
            height: 6px;
            background: var(--glass-border);
            border-radius: 50px;
            overflow: hidden;
        }

        .skill-item .skill-bar .skill-fill {
            height: 100%;
            background: var(--gradient);
            border-radius: 50px;
            transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
            width: 0%;
        }

        @media (max-width: 768px) {
            .skills-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        /* ============================================
                   LMS PROMO SECTION
                   ============================================ */
        .lms-promo {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.05), rgba(124, 58, 237, 0.05));
            border-top: 1px solid var(--glass-border);
            border-bottom: 1px solid var(--glass-border);
        }

        .lms-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .lms-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .lms-feature {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 14px;
            padding: 20px;
            text-align: center;
            transition: var(--transition);
        }

        .lms-feature:hover {
            border-color: rgba(79, 70, 229, 0.2);
            transform: translateY(-4px);
        }

        .lms-feature i {
            font-size: 1.8rem;
            color: var(--primary-light);
            margin-bottom: 8px;
            display: block;
        }

        .lms-feature h4 {
            font-size: 0.95rem;
            font-weight: 600;
            color: white;
            margin-bottom: 4px;
        }

        .lms-feature p {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        @media (max-width: 768px) {
            .lms-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .lms-features {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* ============================================
                   CLIENT PORTAL PROMO
                   ============================================ */
        .portal-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 30px;
        }

        .portal-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 30px 24px;
            text-align: center;
            transition: var(--transition);
        }

        .portal-card:hover {
            border-color: rgba(79, 70, 229, 0.2);
            transform: translateY(-4px);
            box-shadow: var(--shadow);
        }

        .portal-card i {
            font-size: 2.2rem;
            color: var(--primary-light);
            margin-bottom: 12px;
            display: block;
        }

        .portal-card h4 {
            font-size: 1rem;
            font-weight: 600;
            color: white;
            margin-bottom: 4px;
        }

        .portal-card p {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .portal-cta {
            text-align: center;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .portal-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ============================================
                   CERTIFICATE VERIFICATION
                   ============================================ */
        .verify-section {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.03), rgba(5, 150, 105, 0.03));
            border-top: 1px solid var(--glass-border);
            border-bottom: 1px solid var(--glass-border);
        }

        .verify-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .verify-content h3 {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .verify-content p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .verify-content .features {
            display: grid;
            gap: 12px;
        }

        .verify-content .features li {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-secondary);
        }

        .verify-content .features li i {
            color: var(--success);
        }

        .verify-form {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 32px;
        }

        .verify-form h4 {
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
        }

        .verify-form .subtitle {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .verify-form .input-group {
            display: flex;
            gap: 12px;
        }

        .verify-form .input-group input {
            flex: 1;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: var(--transition);
            outline: none;
        }

        .verify-form .input-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .verify-form .input-group input::placeholder {
            color: var(--text-secondary);
        }

        .verify-form .input-group .btn-verify {
            padding: 14px 30px;
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Inter', sans-serif;
            white-space: nowrap;
        }

        .verify-form .input-group .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(79, 70, 229, 0.3);
        }

        .verify-result {
            margin-top: 16px;
            padding: 12px 16px;
            border-radius: 10px;
            display: none;
        }

        .verify-result.success {
            display: block;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34D399;
        }

        .verify-result.error {
            display: block;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #F87171;
        }

        @media (max-width: 768px) {
            .verify-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .verify-form .input-group {
                flex-direction: column;
            }
            .verify-form .input-group .btn-verify {
                width: 100%;
            }
        }

        /* ============================================
                   TESTIMONIALS
                   ============================================ */
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .testimonial-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 28px;
            transition: var(--transition);
        }

        .testimonial-card:hover {
            border-color: rgba(79, 70, 229, 0.2);
            transform: translateY(-4px);
        }

        .testimonial-card .stars {
            color: #F59E0B;
            margin-bottom: 12px;
            font-size: 0.9rem;
        }

        .testimonial-card blockquote {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.7;
            font-style: italic;
        }

        .testimonial-card .author {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 16px;
        }

        .testimonial-card .author .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(79, 70, 229, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--primary-light);
            font-size: 0.9rem;
        }

        .testimonial-card .author .name {
            font-weight: 600;
            color: white;
            font-size: 0.95rem;
        }

        .testimonial-card .author .role {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        /* ============================================
                   CONTACT SECTION
                   ============================================ */
        .contact {
            background: rgba(255, 255, 255, 0.01);
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 50px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .contact-item {
            display: flex;
            gap: 16px;
            align-items: flex-start;
            padding: 16px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 14px;
            transition: var(--transition);
        }

        .contact-item:hover {
            border-color: rgba(79, 70, 229, 0.2);
        }

        .contact-item .icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            background: rgba(79, 70, 229, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-light);
            font-size: 1.2rem;
        }

        .contact-item h4 {
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            margin-bottom: 2px;
        }

        .contact-item p {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .contact-form {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 32px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: 4px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: white;
            font-family: 'Inter', sans-serif;
            transition: var(--transition);
            outline: none;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .form-message {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            display: none;
            font-size: 0.9rem;
        }

        .form-message.success {
            display: block;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34D399;
        }

        .form-message.error {
            display: block;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #F87171;
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        /* ============================================
                   CTA SECTION
                   ============================================ */
        .cta-section {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1), rgba(124, 58, 237, 0.1));
            border-top: 1px solid var(--glass-border);
            padding: 80px 0;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .cta-section p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 32px;
        }

        .cta-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
        }

        @media (max-width: 768px) {
            .cta-section h2 {
                font-size: 1.8rem;
            }
        }

        /* ============================================
                   FOOTER
                   ============================================ */
        footer {
            border-top: 1px solid var(--glass-border);
            padding: 60px 0 20px;
            background: rgba(15, 23, 42, 0.5);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-brand p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.7;
            margin: 12px 0;
        }

        .footer-social {
            display: flex;
            gap: 10px;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            transition: var(--transition);
            text-decoration: none;
        }

        .footer-social a:hover {
            background: var(--gradient);
            color: white;
            transform: translateY(-3px);
            border-color: transparent;
        }

        .footer-links h4 {
            font-size: 0.95rem;
            font-weight: 600;
            color: white;
            margin-bottom: 16px;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links ul li {
            margin-bottom: 8px;
        }

        .footer-links ul a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .footer-links ul a:hover {
            color: white;
        }

        .footer-bottom {
            padding-top: 20px;
            border-top: 1px solid var(--glass-border);
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .footer-bottom .heart {
            color: #EF4444;
        }

        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        /* ============================================
                   ANIMATIONS
                   ============================================ */
        .fade-up {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-up.delay-1 { transition-delay: 0.1s; }
        .fade-up.delay-2 { transition-delay: 0.2s; }
        .fade-up.delay-3 { transition-delay: 0.3s; }
        .fade-up.delay-4 { transition-delay: 0.4s; }
        .fade-up.delay-5 { transition-delay: 0.5s; }

        /* ============================================
                   RESPONSIVE
                   ============================================ */
        @media (max-width: 768px) {
            section {
                padding: 60px 0;
            }
            .section-header h2 {
                font-size: 2rem;
            }
            .section-header p {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .section-header h2 {
                font-size: 1.6rem;
            }
            .hero h1 {
                font-size: 2rem;
            }
            .hero-stats {
                grid-template-columns: 1fr 1fr;
            }
            .services-grid {
                grid-template-columns: 1fr;
            }
            .portfolio-grid {
                grid-template-columns: 1fr;
            }
            .testimonials-grid {
                grid-template-columns: 1fr;
            }
            .lms-features {
                grid-template-columns: 1fr;
            }
        }
        {!! $settings['custom_css'] ?? '' !!}
    </style>
</head>
<body>

    <!-- ===== PRELOADER ===== -->
    <div id="preloader">
        <div class="preloader-ring"></div>
    </div>

    <!-- ===== HEADER ===== -->
    <header class="header" id="header">
        <div class="container">
            <a href="/" class="logo">
                @if($settings['logo'] ?? null)<img class="logo-image" src="{{ settingAsset('logo') }}" alt="{{ $settings['site_name'] ?? 'MGTECHS' }}">@else<div class="logo-icon"><i class="fas fa-code"></i></div><span class="logo-text">{{ $settings['logo_text'] ?? 'MG' }}<span>{{ $settings['logo_highlight'] ?? 'TECHS' }}</span></span><span class="logo-badge">{{ $settings['logo_badge'] ?? 'Limited' }}</span>@endif
            </a>

            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>

            <ul class="nav-links" id="navLinks">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#lms">LMS</a></li>
                <li><a href="#verify">Verify</a></li>
                <li><a href="#contact">Contact</a></li>
                @auth
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @endauth
                <li>
                    <div class="nav-actions">
                        @guest
                            <a href="{{ route('login') }}" class="btn-outline">Login</a>
                            <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                        @else
                            <span style="color: var(--text-secondary); font-size: 0.85rem;">{{ Auth::user()->name }}</span>
                            <a href="{{ route('dashboard') }}" class="btn-primary btn-primary-sm">Dashboard</a>
                            <a href="{{ route('logout') }}" class="btn-outline" style="font-size:0.8rem; padding:6px 16px;"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <!-- ===== HERO SECTION ===== -->
    <section class="hero" id="home">
        <div class="hero-glow glow-1"></div>
        <div class="hero-glow glow-2"></div>

        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="dot"></span>
                    {{ $settings['hero_badge'] ?? $settings['tagline'] ?? 'MGTECHS Smart Innovations' }}
                </div>

                <h1>
                    {{ $settings['hero_title'] ?? 'Transforming Ideas Into' }}<br>
                    <span class="highlight">{{ $settings['hero_highlight'] ?? 'Digital Reality' }}</span>
                </h1>

                <p>{{ $settings['hero_description'] ?? $settings['tagline'] ?? 'We create stunning web experiences, software solutions, and innovative digital products that drive results and transform businesses.' }}</p>

                <div class="hero-tech-stack">
                    <span>PHP</span>
                    <span>Laravel</span>
                    <span>JavaScript</span>
                    <span>React</span>
                    <span>Vue.js</span>
                    <span>Web3</span>
                    <span>Solidity</span>
                </div>

                <div class="hero-actions">
                    <a href="#services" class="btn">Explore Services</a>
                    <a href="#contact" class="btn btn-secondary">Get a Quote</a>
                </div>

                <div class="hero-stats">
                    <div class="stat">
                        <div class="stat-number">50<span class="plus">+</span></div>
                        <div class="stat-label">Projects Delivered</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">30<span class="plus">+</span></div>
                        <div class="stat-label">Happy Clients</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">100<span class="plus">+</span></div>
                        <div class="stat-label">Students Trained</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">4<span class="plus">+</span></div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SERVICES SECTION ===== -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-header fade-up">
                <span class="badge">What We Do</span>
                <h2>Comprehensive <span class="highlight">Digital Solutions</span></h2>
                <p>End-to-end technology services tailored to your business needs</p>
            </div>

            <div class="services-grid">
                <div class="service-card fade-up delay-1">
                    <div class="icon"><i class="fas fa-code"></i></div>
                    <h3>Web Development</h3>
                    <p>Custom websites, web applications, and e-commerce platforms built with modern technologies.</p>
                    <a href="#services" class="learn-more">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="service-card fade-up delay-2">
                    <div class="icon"><i class="fas fa-laptop"></i></div>
                    <h3>Software Development</h3>
                    <p>Custom software solutions, ERP systems, and business automation tools.</p>
                    <a href="#services" class="learn-more">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="service-card fade-up delay-3">
                    <div class="icon"><i class="fas fa-paint-brush"></i></div>
                    <h3>Graphics & Branding</h3>
                    <p>Professional graphics, logos, banners, and complete branding solutions.</p>
                    <a href="#services" class="learn-more">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="service-card fade-up delay-4">
                    <div class="icon"><i class="fas fa-print"></i></div>
                    <h3>Printing Services</h3>
                    <p>High-quality printing services for business cards, brochures, banners, and more.</p>
                    <a href="#services" class="learn-more">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="service-card fade-up delay-5">
                    <div class="icon"><i class="fas fa-users-cog"></i></div>
                    <h3>IT Consultation</h3>
                    <p>Expert IT advisory, infrastructure planning, and digital transformation consulting.</p>
                    <a href="#services" class="learn-more">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="service-card fade-up delay-6">
                    <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                    <h3>LMS & Training</h3>
                    <p>Learning Management Systems, CBT platforms, and online training solutions.</p>
                    <a href="#services" class="learn-more">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== ABOUT SECTION ===== -->
    <section class="about" id="about">
        <div class="container">
            <div class="section-header fade-up">
                <span class="badge">About Us</span>
                <h2>Nigeria's Trusted <span class="highlight">Technology Partner</span></h2>
                <p>Empowering businesses with innovative digital solutions</p>
            </div>

            <div class="about-grid">
                <div class="about-text fade-up">
                    <h3>Building The Future, One Solution at a Time</h3>
                    <p>
                        <strong>{{ brandSetting('company_name', $settings['site_name'] ?? 'MGTECHS Limited') }}</strong> is a registered Nigerian technology company ({{ brandSetting('company_rc', 'RC 1234567') }})
                        specializing in innovative digital solutions that drive business growth and operational efficiency.
                    </p>
                    <p>
                        From web development and software engineering to graphics design, printing, branding, and IT consultation, 
                        we provide end-to-end technology services to businesses across Nigeria and beyond.
                    </p>

                    <ul class="about-features">
                        <li><i class="fas fa-check-circle"></i> Registered Company</li>
                        <li><i class="fas fa-check-circle"></i> Expert Team</li>
                        <li><i class="fas fa-check-circle"></i> 50+ Projects Delivered</li>
                        <li><i class="fas fa-check-circle"></i> Client-Centric Approach</li>
                        <li><i class="fas fa-check-circle"></i> End-to-End Solutions</li>
                        <li><i class="fas fa-check-circle"></i> 24/7 Support</li>
                    </ul>
                </div>

                <div class="about-image fade-up">
                    <div class="card">
                        <div class="avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h3>Maxwell Ephraim Halilu</h3>
                        <p class="title">Founder &amp; CEO</p>
                        <span class="badge">🏆 Hackathon Champion</span>
                        <p style="margin-top: 16px; font-size: 0.9rem; color: var(--text-secondary);">
                            Passionate developer with 4+ years experience in web development, 
                            blockchain, and software engineering.
                        </p>
                    </div>
                    <div class="floating-badge" style="top: -20px; right: -20px;">
                        <i class="fas fa-code"></i>
                        <span>Full-Stack</span>
                    </div>
                    <div class="floating-badge" style="bottom: -20px; left: -20px;">
                        <i class="fas fa-link"></i>
                        <span>Web3</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===== PORTFOLIO SECTION ===== -->
    <section class="portfolio" id="portfolio">
        <div class="container">
            <div class="section-header fade-up">
                <span class="badge">Our Work</span>
                <h2>Featured <span class="highlight">Projects</span></h2>
                <p>Showcasing our latest innovations and successful deliveries</p>
            </div>

            <div class="portfolio-filter fade-up">
                <button class="filter-btn active" data-filter="all">All Projects</button>
                <button class="filter-btn" data-filter="web">Web Dev</button>
                <button class="filter-btn" data-filter="blockchain">Blockchain</button>
                <button class="filter-btn" data-filter="lms">LMS</button>
                <button class="filter-btn" data-filter="branding">Branding</button>
            </div>

            <div class="portfolio-grid">
                <div class="portfolio-item fade-up delay-1" data-category="lms featured">
                    <div class="image"><i class="fas fa-graduation-cap"></i></div>
                    <div class="info">
                        <span class="tag featured">🏆 Featured</span>
                        <h3>EduCore</h3>
                        <p>Winning school management software for Climax Academy, Dumne.</p>
                        <div class="tech-tags">
                            <span>Laravel</span>
                            <span>Vue.js</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item fade-up delay-2" data-category="web featured">
                    <div class="image"><i class="fas fa-link"></i></div>
                    <div class="info">
                        <span class="tag featured">⭐ Featured</span>
                        <h3>SynapseNet</h3>
                        <p>Modern association management solution with React &amp; Node.js.</p>
                        <div class="tech-tags">
                            <span>React</span>
                            <span>Node.js</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item fade-up delay-3" data-category="blockchain">
                    <div class="image"><i class="fas fa-coins"></i></div>
                    <div class="info">
                        <span class="tag">Blockchain</span>
                        <h3>NFT Marketplace</h3>
                        <p>Full dynamic NFT platform built on BlockDAG.</p>
                        <div class="tech-tags">
                            <span>Solidity</span>
                            <span>Web3</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item fade-up delay-4" data-category="lms">
                    <div class="image"><i class="fas fa-book"></i></div>
                    <div class="info">
                        <span class="tag">LMS</span>
                        <h3>MGTECHS LMS</h3>
                        <p>Complete LMS with CBT, certificates, and progress tracking.</p>
                        <div class="tech-tags">
                            <span>Laravel</span>
                            <span>Livewire</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item fade-up delay-5" data-category="web">
                    <div class="image"><i class="fas fa-users"></i></div>
                    <div class="info">
                        <span class="tag">Web Dev</span>
                        <h3>Client Portal</h3>
                        <p>Dedicated client portal for project tracking and collaboration.</p>
                        <div class="tech-tags">
                            <span>Laravel</span>
                            <span>Vue.js</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item fade-up delay-6" data-category="branding">
                    <div class="image"><i class="fas fa-palette"></i></div>
                    <div class="info">
                        <span class="tag">Branding</span>
                        <h3>Branding Package</h3>
                        <p>Complete branding package for a corporate client.</p>
                        <div class="tech-tags">
                            <span>Illustrator</span>
                            <span>Photoshop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- ===== LMS PROMO SECTION ===== -->
    <section class="lms-promo" id="lms">
        <div class="container">
            <div class="section-header fade-up">
                <span class="badge">Learning Management</span>
                <h2>Empower Your Students with <span class="highlight">E-Learning</span></h2>
                <p>Complete LMS platform with CBT, certificates, and progress tracking</p>
            </div>

            <div class="lms-grid">
                <div class="fade-up">
                    <h3 style="font-size: 1.6rem; font-weight: 800; margin-bottom: 16px;">
                        Everything You Need for <span class="highlight">Online Education</span>
                    </h3>
                    <p style="color: var(--text-secondary); line-height: 1.8; margin-bottom: 20px;">
                        Our Learning Management System provides a complete platform for schools, 
                        training centers, and organizations to deliver courses online with 
                        comprehensive features for both instructors and students.
                    </p>
                    <a href="#contact" class="btn">Get Started with LMS</a>
                </div>

                <div class="lms-features fade-up">
                    <div class="lms-feature">
                        <i class="fas fa-book"></i>
                        <h4>Course Management</h4>
                        <p>Create and organize courses</p>
                    </div>
                    <div class="lms-feature">
                        <i class="fas fa-puzzle-piece"></i>
                        <h4>CBT Tests</h4>
                        <p>Computer-based testing</p>
                    </div>
                    <div class="lms-feature">
                        <i class="fas fa-certificate"></i>
                        <h4>Certificates</h4>
                        <p>Auto-generated certificates</p>
                    </div>
                    <div class="lms-feature">
                        <i class="fas fa-chart-simple"></i>
                        <h4>Progress Tracking</h4>
                        <p>Monitor student progress</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CLIENT PORTAL PROMO ===== -->
    <section class="client-portal-promo" style="padding: 60px 0;">
        <div class="container">
            <div class="section-header fade-up">
                <span class="badge">Client Portal</span>
                <h2>Track Your Projects in <span class="highlight">Real-Time</span></h2>
                <p>Dedicated client portal for seamless collaboration</p>
            </div>

            <div class="portal-grid">
                <div class="portal-card fade-up delay-1">
                    <i class="fas fa-chart-line"></i>
                    <h4>Track Progress</h4>
                    <p>Real-time project updates and milestone tracking</p>
                </div>
                <div class="portal-card fade-up delay-2">
                    <i class="fas fa-comment-dots"></i>
                    <h4>Give Feedback</h4>
                    <p>Direct communication with our team</p>
                </div>
                <div class="portal-card fade-up delay-3">
                    <i class="fas fa-file-upload"></i>
                    <h4>Share Files</h4>
                    <p>Upload and download project deliverables</p>
                </div>
            </div>

            <div class="portal-cta">
                <a href="{{ route('register') }}" class="btn">
                    <i class="fas fa-user-plus mr-2"></i> Register as Client
                </a>
            </div>
        </div>
    </section>

    <!-- ===== CERTIFICATE VERIFICATION ===== -->
    <section class="verify-section" id="verify">
        <div class="container">
            <div class="section-header fade-up">
                <span class="badge">Certificate Verification</span>
                <h2>Verify Your <span class="highlight">Certificate</span></h2>
                <p>Authenticate certificates issued by MGTECHS Limited</p>
            </div>

            <div class="verify-grid">
                <div class="verify-content fade-up">
                    <h3>Authenticate Your <span class="highlight">Credentials</span></h3>
                    <p>
                        Verify the authenticity of any certificate issued by MGTECHS Limited. 
                        Enter your unique certificate number below to confirm its validity.
                    </p>
                    <ul class="features">
                        <li><i class="fas fa-check-circle"></i> Instant verification</li>
                        <li><i class="fas fa-check-circle"></i> 100% secure and authentic</li>
                        <li><i class="fas fa-check-circle"></i> Trusted by employers worldwide</li>
                        <li><i class="fas fa-check-circle"></i> Blockchain-backed validation</li>
                    </ul>
                </div>

                <div class="verify-form fade-up">
                    <h4>Verify Certificate</h4>
                    <p class="subtitle">Enter the certificate number to check its validity</p>
                    <div class="input-group">
                        <input type="text" id="certificateNumber" placeholder="e.g., MGT-2024-0001">
                        <button class="btn-verify" id="verifyBtn">
                            <i class="fas fa-search mr-2"></i> Verify
                        </button>
                    </div>
                    <div id="verifyResult" class="verify-result">
                        <span><i class="fas fa-check-circle"></i> <span id="verifyMessage">Certificate is valid!</span></span>
                    </div>
                    <p style="color: var(--text-secondary); font-size: 0.8rem; margin-top: 12px;">
                        <i class="fas fa-info-circle"></i> Certificate numbers follow the format: MGT-YYYY-NNNN
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== TESTIMONIALS ===== -->
    <section class="testimonials" style="padding: 80px 0;">
        <div class="container">
            <div class="section-header fade-up">
                <span class="badge">Testimonials</span>
                <h2>What Our <span class="highlight">Clients Say</span></h2>
                <p>Real feedback from real clients</p>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial-card fade-up delay-1">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <blockquote>"MGTECHS delivered an exceptional web solution that transformed our business operations. Professional, reliable, and innovative."</blockquote>
                    <div class="author">
                        <div class="avatar">A</div>
                        <div>
                            <div class="name">Adeola Consulting</div>
                            <div class="role">CEO</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card fade-up delay-2">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <blockquote>"The EduCore LMS platform has revolutionized how we manage our school. The CBT feature is outstanding!"</blockquote>
                    <div class="author">
                        <div class="avatar">C</div>
                        <div>
                            <div class="name">Climax Academy</div>
                            <div class="role">Director</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card fade-up delay-3">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <blockquote>"The branding and web development services were top-notch. Highly recommended for any business."</blockquote>
                    <div class="author">
                        <div class="avatar">E</div>
                        <div>
                            <div class="name">Eze Enterprises</div>
                            <div class="role">Founder</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CONTACT SECTION ===== -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="section-header fade-up">
                <span class="badge">Contact Us</span>
                <h2>Let's Work <span class="highlight">Together</span></h2>
                <p>Have a project in mind? Let's discuss how we can help</p>
            </div>

            <div class="contact-grid">
                <div class="contact-info fade-up">
                    <div class="contact-item">
                        <div class="icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h4>Email</h4>
                            <p>{{ brandSetting('contact_email', 'info@mgtechs.com.ng') }}</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <h4>Phone</h4>
                            <p>{{ $settings['contact_phone'] ?? '+234 816 159 5906' }}</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h4>Location</h4>
                            <p>{{ $settings['contact_address'] ?? 'Yola, Nigeria' }}</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="icon"><i class="fas fa-building"></i></div>
                        <div>
                            <h4>Company Reg</h4>
                            <p>{{ brandSetting('company_rc', 'RC 1234567') }}</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form fade-up">
                    <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div id="formMessage" class="form-message"></div>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your name" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Project type" required>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" class="form-control" placeholder="Tell us about your project..." required></textarea>
                        </div>
                        <button type="submit" class="btn" style="width:100%; justify-content:center;">
                            <i class="fas fa-paper-plane mr-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA SECTION ===== -->
    <section class="cta-section">
        <div class="container">
            <h2 class="fade-up">Ready to <span class="highlight">Transform</span> Your Business?</h2>
            <p class="fade-up">Let's discuss your project and create something amazing together.</p>
            <div class="cta-actions fade-up">
                <a href="#contact" class="btn btn-lg">Get Started Today</a>
                <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-user-plus mr-2"></i> Register Now
                </a>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="/" class="logo" style="font-size: 1.3rem;">
                        @if($settings['logo'] ?? null)<img class="logo-image" src="{{ settingAsset('logo') }}" alt="{{ $settings['site_name'] ?? 'MGTECHS' }}">@else<div class="logo-icon" style="width: 32px; height: 32px; font-size: 0.9rem;">
                            <i class="fas fa-code"></i>
                        </div><span class="logo-text">{{ $settings['logo_text'] ?? 'MG' }}<span>{{ $settings['logo_highlight'] ?? 'TECHS' }}</span></span><span class="logo-badge">{{ $settings['logo_badge'] ?? 'Limited' }}</span>@endif
                    </a>
                    <p>{{ $settings['footer_description'] ?? $settings['tagline'] ?? "Nigeria's trusted technology partner for innovative digital solutions." }}</p>
                    <div class="footer-social">
                        @if(brandSetting('social_twitter'))<a href="{{ brandSetting('social_twitter') }}"><i class="fab fa-twitter"></i></a>@endif
                        @if(brandSetting('social_linkedin'))<a href="{{ brandSetting('social_linkedin') }}"><i class="fab fa-linkedin-in"></i></a>@endif
                        @if(brandSetting('social_github'))<a href="{{ brandSetting('social_github') }}"><i class="fab fa-github"></i></a>@endif
                        @if(brandSetting('social_youtube'))<a href="{{ brandSetting('social_youtube') }}"><i class="fab fa-youtube"></i></a>@endif
                    </div>
                </div>

                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#portfolio">Portfolio</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#services">Web Development</a></li>
                        <li><a href="#services">Software Development</a></li>
                        <li><a href="#services">Graphics Design</a></li>
                        <li><a href="#services">Printing & Branding</a></li>
                        <li><a href="#services">IT Consultation</a></li>
                        <li><a href="#services">LMS & Training</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Contact</h4>
                    <ul>
                        <li style="color: var(--text-secondary); font-size: 0.9rem;">
                            <i class="fas fa-envelope" style="color: var(--primary-light); width: 20px;"></i>
                            {{ brandSetting('contact_email', 'info@mgtechs.com.ng') }}
                        </li>
                        <li style="color: var(--text-secondary); font-size: 0.9rem;">
                            <i class="fas fa-phone" style="color: var(--primary-light); width: 20px;"></i>
                            {{ $settings['contact_phone'] ?? '+234 816 159 5906' }}
                        </li>
                        <li style="color: var(--text-secondary); font-size: 0.9rem;">
                            <i class="fas fa-map-marker-alt" style="color: var(--primary-light); width: 20px;"></i>
                            {{ $settings['contact_address'] ?? 'Yola, Nigeria' }}
                        </li>
                        <li style="color: var(--text-secondary); font-size: 0.9rem;">
                            <i class="fas fa-building" style="color: var(--primary-light); width: 20px;"></i>
                            {{ brandSetting('company_rc', 'RC 1234567') }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} <strong>{{ brandSetting('company_name', $settings['site_name'] ?? 'MGTECHS Limited') }}</strong>. All Rights Reserved. Built with <span class="heart">❤</span> in Nigeria.</p>
            </div>
        </div>
    </footer>

    <!-- ===== SCRIPTS ===== -->
    <script>
        // ===== PRELOADER =====
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            preloader.classList.add('hidden');
        });

        // ===== MOBILE MENU =====
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');
        let menuOpen = false;

        menuToggle.addEventListener('click', function() {
            menuOpen = !menuOpen;
            navLinks.classList.toggle('open');
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('open');
                menuOpen = false;
                const icon = menuToggle.querySelector('i');
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-times');
            });
        });

        // ===== HEADER SCROLL =====
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // ===== SCROLL ANIMATIONS =====
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-up').forEach(el => {
            observer.observe(el);
        });

        // ===== SKILL BARS =====
        const skillObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bars = entry.target.querySelectorAll('.skill-fill');
                    bars.forEach((bar, index) => {
                        const width = bar.getAttribute('data-width');
                        setTimeout(() => {
                            bar.style.width = width;
                        }, 300 + (index * 150));
                    });
                }
            });
        }, { threshold: 0.3 });

        document.querySelector('.skills-grid') && skillObserver.observe(document.querySelector('.skills-grid'));

        // ===== PORTFOLIO FILTER =====
        const filterBtns = document.querySelectorAll('.filter-btn');
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                portfolioItems.forEach(item => {
                    const categories = item.getAttribute('data-category');
                    if (filter === 'all' || categories.includes(filter)) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // ===== CERTIFICATE VERIFICATION =====
        const verifyBtn = document.getElementById('verifyBtn');
        const certificateInput = document.getElementById('certificateNumber');
        const verifyResult = document.getElementById('verifyResult');
        const verifyMessage = document.getElementById('verifyMessage');

        const validCertificates = [
            'MGT-2024-0001',
            'MGT-2024-0002',
            'MGT-2024-0003',
            'MGT-2025-0001',
            'MGT-2025-0002'
        ];

        verifyBtn.addEventListener('click', function() {
            const certNumber = certificateInput.value.trim().toUpperCase();

            if (!certNumber) {
                verifyResult.className = 'verify-result error';
                verifyMessage.textContent = 'Please enter a certificate number.';
                return;
            }

            if (validCertificates.includes(certNumber)) {
                verifyResult.className = 'verify-result success';
                verifyMessage.innerHTML = '✅ Certificate <strong>' + certNumber + '</strong> is <strong>VALID</strong> and authentic!';
            } else {
                verifyResult.className = 'verify-result error';
                verifyMessage.innerHTML = '❌ Certificate <strong>' + certNumber + '</strong> is <strong>INVALID</strong>. Please verify the number or contact support.';
            }
        });

        certificateInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                verifyBtn.click();
            }
        });

        // ===== CONTACT FORM =====
        const contactForm = document.getElementById('contactForm');
        const formMessage = document.getElementById('formMessage');

        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            formMessage.className = 'form-message';
            formMessage.style.display = 'none';

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    formMessage.className = 'form-message success';
                    formMessage.textContent = '✅ Message sent successfully! We\'ll get back to you soon.';
                    formMessage.style.display = 'block';
                    this.reset();
                } else {
                    throw new Error('Validation failed');
                }
            })
            .catch(() => {
                formMessage.className = 'form-message error';
                formMessage.textContent = '❌ Oops! Something went wrong. Please try again or email us directly.';
                formMessage.style.display = 'block';
            });
        });

        // ===== SMOOTH SCROLL =====
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // ===== ACTIVE NAV LINK =====
        const sections = document.querySelectorAll('section[id]');
        const navLinkItems = document.querySelectorAll('.nav-links a');

        window.addEventListener('scroll', function() {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                if (window.pageYOffset >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });

            navLinkItems.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
