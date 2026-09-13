<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $post->title ?? 'Blog Post' }} - MGTECHS</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0F172A;
            color: #F1F5F9;
            padding-top: 80px;
        }
        .post-header {
            padding: 40px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .post-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
        }
        .post-header .meta {
            color: #94A3B8;
            font-size: 0.9rem;
            margin-top: 12px;
        }
        .post-header .meta .category {
            color: #818CF8;
            font-weight: 600;
        }
        .post-content {
            padding: 40px 0 60px;
        }
        .post-content .content {
            font-size: 1.05rem;
            line-height: 1.9;
            color: #E2E8F0;
        }
        .post-content .content p {
            margin-bottom: 20px;
        }
        .post-content .content h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 30px 0 16px;
            color: white;
        }
        .post-content .content h3 {
            font-size: 1.4rem;
            font-weight: 600;
            margin: 24px 0 12px;
            color: white;
        }
        .post-content .content ul {
            padding-left: 24px;
            margin-bottom: 20px;
        }
        .post-content .content ul li {
            margin-bottom: 8px;
            color: #E2E8F0;
        }
        .post-content .content blockquote {
            border-left: 4px solid #4F46E5;
            padding: 16px 24px;
            background: rgba(79,70,229,0.05);
            border-radius: 0 8px 8px 0;
            margin: 20px 0;
            color: #94A3B8;
            font-style: italic;
        }
        .post-content .content img {
            max-width: 100%;
            border-radius: 12px;
            margin: 20px 0;
        }
        .sidebar-card {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(51, 65, 85, 0.5);
            border-radius: 12px;
            padding: 24px;
        }
        .sidebar-card h4 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 16px;
        }
        .sidebar-card ul {
            list-style: none;
            padding: 0;
        }
        .sidebar-card ul li {
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }
        .sidebar-card ul li:last-child {
            border-bottom: none;
        }
        .sidebar-card ul a {
            color: #94A3B8;
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.9rem;
        }
        .sidebar-card ul a:hover {
            color: white;
        }
        @media (max-width: 768px) {
            .post-header h1 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>

    <!-- ===== HEADER ===== -->
    <header style="position:fixed;top:0;left:0;width:100%;z-index:1000;background:rgba(15,23,42,0.95);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,0.05);padding:16px 0;">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 24px;display:flex;justify-content:space-between;align-items:center;">
            <a href="/" style="display:flex;align-items:center;gap:10px;text-decoration:none;font-size:1.4rem;font-weight:800;color:white;">
                <div style="width:38px;height:38px;background:linear-gradient(135deg,#4F46E5,#7C3AED);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1rem;color:white;">
                    <i class="fas fa-code"></i>
                </div>
                <span>MG<span style="background:linear-gradient(135deg,#4F46E5,#7C3AED);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">TECHS</span></span>
                <span style="font-size:0.5rem;background:rgba(255,255,255,0.05);padding:2px 10px;border-radius:50px;color:#94A3B8;border:1px solid rgba(255,255,255,0.06);">Limited</span>
            </a>
            <div style="display:flex;align-items:center;gap:16px;">
                <a href="{{ route('blog.index') }}" style="color:#94A3B8;text-decoration:none;font-size:0.85rem;transition:color 0.3s ease;">← Back to Blog</a>
                <a href="/" style="color:#94A3B8;text-decoration:none;font-size:0.85rem;transition:color 0.3s ease;">Home</a>
            </div>
        </div>
    </header>

    <!-- ===== POST HEADER ===== -->
    <section class="post-header">
        <div class="container" style="max-width:800px;margin:0 auto;padding:0 24px;">
            <div class="meta">
                <span class="category">{{ $post->category ?? 'General' }}</span>
                <span style="margin-left:12px;">{{ $post->date ?? 'N/A' }}</span>
                <span style="margin-left:12px;">By {{ $post->author ?? 'MGTECHS' }}</span>
            </div>
            <h1>{{ $post->title ?? 'Blog Post' }}</h1>
            <div style="margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;">
                @foreach(explode(',', $post->tags ?? '') as $tag)
                    <span style="padding:2px 12px;background:rgba(79,70,229,0.1);border:1px solid rgba(79,70,229,0.15);border-radius:50px;color:#818CF8;font-size:0.7rem;">{{ trim($tag) }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ===== POST CONTENT ===== -->
    <section class="post-content">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 24px;">
            <div style="display:grid;grid-template-columns:1fr 280px;gap:40px;">
                <div class="content">
                    <div style="background:rgba(79,70,229,0.05);border-radius:12px;padding:30px;margin-bottom:30px;text-align:center;">
                        <div style="font-size:4rem;color:#818CF8;margin-bottom:16px;">
                            <i class="fas {{ $post->image ?? 'fa-newspaper' }}"></i>
                        </div>
                    </div>
                    <p>{{ $post->content ?? 'No content available for this post.' }}</p>
                </div>

                <!-- Sidebar -->
                <div style="display:flex;flex-direction:column;gap:24px;">
                    <div class="sidebar-card">
                        <h4><i class="fas fa-clock" style="color:#818CF8;margin-right:8px;"></i> Recent Posts</h4>
                        <ul>
                            @foreach($relatedPosts ?? [] as $related)
                                <li>
                                    <a href="{{ route('blog.show', $related->slug ?? '#') }}">{{ $related->title ?? 'Post' }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-card">
                        <h4><i class="fas fa-share-alt" style="color:#818CF8;margin-right:8px;"></i> Share</h4>
                        <div style="display:flex;gap:10px;">
                            <a href="#" style="width:40px;height:40px;background:rgba(55,65,81,0.3);border:1px solid #334155;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#94A3B8;transition:all 0.3s ease;text-decoration:none;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" style="width:40px;height:40px;background:rgba(55,65,81,0.3);border:1px solid #334155;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#94A3B8;transition:all 0.3s ease;text-decoration:none;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" style="width:40px;height:40px;background:rgba(55,65,81,0.3);border:1px solid #334155;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#94A3B8;transition:all 0.3s ease;text-decoration:none;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" style="width:40px;height:40px;background:rgba(55,65,81,0.3);border:1px solid #334155;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#94A3B8;transition:all 0.3s ease;text-decoration:none;">
                                <i class="fas fa-link"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer style="border-top:1px solid rgba(255,255,255,0.03);padding:40px 0 24px;background:rgba(15,23,42,0.5);">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 24px;text-align:center;">
            <p style="color:#94A3B8;font-size:0.85rem;">
                &copy; {{ date('Y') }} <strong style="color:white;">MGTECHS Limited</strong>. All Rights Reserved.
            </p>
        </div>
    </footer>

</body>
</html>