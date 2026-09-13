<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MGTECHS Blog - Insights & Updates</title>
    
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
        .blog-header {
            background: linear-gradient(135deg, rgba(79,70,229,0.1), rgba(124,58,237,0.1));
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 60px 0 40px;
        }
        .blog-header h1 {
            font-size: 2.8rem;
            font-weight: 800;
        }
        .blog-header p {
            color: #94A3B8;
            font-size: 1.1rem;
        }
        .blog-card {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(51, 65, 85, 0.5);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-4px);
            border-color: rgba(79,70,229,0.3);
            box-shadow: 0 20px 40px -12px rgba(0,0,0,0.5);
        }
        .blog-card .image {
            height: 200px;
            background: rgba(79,70,229,0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #818CF8;
        }
        .blog-card .content {
            padding: 24px;
        }
        .blog-card .meta {
            font-size: 0.8rem;
            color: #94A3B8;
            margin-bottom: 8px;
        }
        .blog-card .meta .category {
            color: #818CF8;
            font-weight: 600;
        }
        .blog-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .blog-card h3 a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .blog-card h3 a:hover {
            color: #818CF8;
        }
        .blog-card p {
            color: #94A3B8;
            font-size: 0.9rem;
            line-height: 1.6;
        }
        .blog-card .read-more {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #818CF8;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: gap 0.3s ease;
            margin-top: 12px;
        }
        .blog-card .read-more:hover {
            gap: 12px;
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
        .sidebar-card .tag {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(79,70,229,0.1);
            border: 1px solid rgba(79,70,229,0.15);
            border-radius: 50px;
            color: #818CF8;
            font-size: 0.75rem;
            margin: 4px;
            transition: all 0.3s ease;
        }
        .sidebar-card .tag:hover {
            background: rgba(79,70,229,0.2);
        }
        @media (max-width: 768px) {
            .blog-header h1 { font-size: 2rem; }
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
            <a href="/" style="color:#94A3B8;text-decoration:none;font-size:0.85rem;transition:color 0.3s ease;">← Back to Home</a>
        </div>
    </header>

    <!-- ===== BLOG HEADER ===== -->
    <section class="blog-header">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 24px;">
            <h1>📝 Our <span style="background:linear-gradient(135deg,#4F46E5,#7C3AED);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Blog</span></h1>
            <p>Insights, tutorials, and updates from the MGTECHS team</p>
        </div>
    </section>

    <!-- ===== BLOG CONTENT ===== -->
    <section style="padding:40px 0 60px;">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 24px;">
            <div class="grid" style="display:grid;grid-template-columns:1fr 300px;gap:40px;">
                <!-- Main Content -->
                <div>
                    <div class="grid" style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
                        @forelse($posts ?? [] as $post)
                            <div class="blog-card">
                                <div class="image">
                                    <i class="fas {{ $post->image ?? 'fa-newspaper' }}"></i>
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <span class="category">{{ $post->category ?? 'General' }}</span>
                                        <span style="margin-left:12px;">{{ $post->date ?? 'N/A' }}</span>
                                    </div>
                                    <h3><a href="{{ route('blog.show', $post->slug ?? '#') }}">{{ $post->title ?? 'Blog Post' }}</a></h3>
                                    <p>{{ $post->excerpt ?? 'Read more about this topic...' }}</p>
                                    <a href="{{ route('blog.show', $post->slug ?? '#') }}" class="read-more">
                                        Read More <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div style="grid-column:1/-1;text-align:center;padding:60px 0;">
                                <div style="font-size:4rem;margin-bottom:16px;">📚</div>
                                <h3 style="color:white;font-size:1.5rem;">No Blog Posts Yet</h3>
                                <p style="color:#94A3B8;">Check back soon for updates and insights.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination - REMOVED since we're using hardcoded data -->
                    <!-- No pagination needed for static data -->
                </div>

                <!-- Sidebar -->
                <div style="display:flex;flex-direction:column;gap:24px;">
                    <!-- Categories -->
                    <div class="sidebar-card">
                        <h4><i class="fas fa-tags" style="color:#818CF8;margin-right:8px;"></i> Categories</h4>
                        <ul>
                            @foreach($categories ?? [] as $category)
                                <li>
                                    <a href="#">{{ $category }}</a>
                                    <span style="float:right;color:#64748B;font-size:0.75rem;">({{ rand(1,10) }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Recent Posts -->
                    <div class="sidebar-card">
                        <h4><i class="fas fa-clock" style="color:#818CF8;margin-right:8px;"></i> Recent Posts</h4>
                        <ul>
                            @foreach($recentPosts ?? [] as $post)
                                <li>
                                    <a href="{{ route('blog.show', $post->slug ?? '#') }}">{{ $post->title ?? 'Post' }}</a>
                                    <span style="display:block;font-size:0.7rem;color:#64748B;margin-top:2px;">{{ $post->date ?? 'N/A' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Tags -->
                    <div class="sidebar-card">
                        <h4><i class="fas fa-hashtag" style="color:#818CF8;margin-right:8px;"></i> Tags</h4>
                        <div>
                            <a href="#" class="tag">Technology</a>
                            <a href="#" class="tag">Web Development</a>
                            <a href="#" class="tag">LMS</a>
                            <a href="#" class="tag">Business</a>
                            <a href="#" class="tag">Tutorial</a>
                            <a href="#" class="tag">Tips</a>
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="sidebar-card" style="background:linear-gradient(135deg,rgba(79,70,229,0.05),rgba(124,58,237,0.05));">
                        <h4><i class="fas fa-envelope" style="color:#818CF8;margin-right:8px;"></i> Newsletter</h4>
                        <p style="color:#94A3B8;font-size:0.85rem;margin-bottom:12px;">Subscribe to get the latest posts in your inbox.</p>
                        <form action="#" method="POST" style="display:flex;gap:8px;">
                            <input type="email" placeholder="Your email" style="flex:1;padding:10px 14px;background:rgba(55,65,81,0.5);border:1px solid #4B5563;border-radius:8px;color:white;font-family:'Inter',sans-serif;font-size:0.85rem;outline:none;">
                            <button type="submit" style="padding:10px 16px;background:linear-gradient(135deg,#4F46E5,#7C3AED);border:none;border-radius:8px;color:white;font-weight:600;cursor:pointer;font-family:'Inter',sans-serif;font-size:0.85rem;white-space:nowrap;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer style="border-top:1px solid rgba(255,255,255,0.03);padding:40px 0 24px;background:rgba(15,23,42,0.5);">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 24px;text-align:center;">
            <p style="color:#94A3B8;font-size:0.85rem;">
                &copy; {{ date('Y') }} <strong style="color:white;">MGTECHS Smart Innovations Limited</strong>. All Rights Reserved.
            </p>
        </div>
    </footer>

</body>
</html>