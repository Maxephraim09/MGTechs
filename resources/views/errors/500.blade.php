<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #0F172A; color: #F1F5F9; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { text-align: center; padding: 20px; max-width: 600px; }
        .error-code { font-size: 120px; font-weight: 900; background: linear-gradient(135deg, #EF4444, #DC2626); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1; }
        .error-title { font-size: 28px; font-weight: 700; color: #F1F5F9; margin: 20px 0 10px; }
        .error-desc { color: #94A3B8; font-size: 16px; line-height: 1.8; margin-bottom: 30px; }
        .btn { display: inline-block; padding: 12px 35px; background: linear-gradient(135deg, #4F46E5, #7C3AED); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: opacity 0.3s; }
        .btn:hover { opacity: 0.9; }
        .btn-secondary { background: transparent; border: 1px solid #334155; margin-left: 10px; }
        .btn-secondary:hover { background: rgba(255,255,255,0.05); }
        .icon { font-size: 64px; margin-bottom: 20px; display: block; }
        .maintenance-note { background: rgba(239,68,68,0.05); border: 1px solid rgba(239,68,68,0.15); border-radius: 8px; padding: 15px; margin-top: 20px; }
        .maintenance-note p { color: #94A3B8; font-size: 14px; margin: 0; }
        @media (max-width: 480px) { .error-code { font-size: 80px; } .error-title { font-size: 22px; } }
    </style>
</head>
<body>
    <div class="container">
        <span class="icon">⚠️</span>
        <div class="error-code">500</div>
        <h1 class="error-title">Server Error</h1>
        <p class="error-desc">Something went wrong on our end. We're working to fix it. Please try again later.</p>
        <div>
            <a href="{{ url('/') }}" class="btn">Go Home</a>
            <a href="javascript:location.reload()" class="btn btn-secondary">Try Again</a>
        </div>
        <div class="maintenance-note">
            <p>If the problem persists, please contact our support team at <a href="mailto:info@mgtechs.com.ng" style="color: #818CF8; text-decoration: none;">info@mgtechs.com.ng</a></p>
        </div>
    </div>
</body>
</html>