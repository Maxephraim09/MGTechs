<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Page Expired</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #0F172A; color: #F1F5F9; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { text-align: center; padding: 20px; max-width: 600px; }
        .error-code { font-size: 120px; font-weight: 900; background: linear-gradient(135deg, #8B5CF6, #6D28D9); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1; }
        .error-title { font-size: 28px; font-weight: 700; color: #F1F5F9; margin: 20px 0 10px; }
        .error-desc { color: #94A3B8; font-size: 16px; line-height: 1.8; margin-bottom: 30px; }
        .btn { display: inline-block; padding: 12px 35px; background: linear-gradient(135deg, #4F46E5, #7C3AED); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: opacity 0.3s; }
        .btn:hover { opacity: 0.9; }
        .btn-secondary { background: transparent; border: 1px solid #334155; margin-left: 10px; }
        .btn-secondary:hover { background: rgba(255,255,255,0.05); }
        .icon { font-size: 64px; margin-bottom: 20px; display: block; }
        @media (max-width: 480px) { .error-code { font-size: 80px; } .error-title { font-size: 22px; } }
    </style>
</head>
<body>
    <div class="container">
        <span class="icon">⏰</span>
        <div class="error-code">419</div>
        <h1 class="error-title">Page Expired</h1>
        <p class="error-desc">Your session has expired or the page you were trying to access is no longer valid. Please refresh and try again.</p>
        <div>
            <a href="javascript:location.reload()" class="btn">Refresh Page</a>
            <a href="{{ url('/') }}" class="btn btn-secondary">Go Home</a>
        </div>
    </div>
</body>
</html>