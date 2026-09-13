<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Service Unavailable</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #0F172A; color: #F1F5F9; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { text-align: center; padding: 20px; max-width: 600px; }
        .error-code { font-size: 120px; font-weight: 900; background: linear-gradient(135deg, #F59E0B, #D97706); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1; }
        .error-title { font-size: 28px; font-weight: 700; color: #F1F5F9; margin: 20px 0 10px; }
        .error-desc { color: #94A3B8; font-size: 16px; line-height: 1.8; margin-bottom: 30px; }
        .btn { display: inline-block; padding: 12px 35px; background: linear-gradient(135deg, #4F46E5, #7C3AED); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: opacity 0.3s; }
        .btn:hover { opacity: 0.9; }
        .btn-secondary { background: transparent; border: 1px solid #334155; margin-left: 10px; }
        .btn-secondary:hover { background: rgba(255,255,255,0.05); }
        .icon { font-size: 64px; margin-bottom: 20px; display: block; }
        .maintenance-box { background: rgba(245,158,11,0.05); border: 1px solid rgba(245,158,11,0.15); border-radius: 8px; padding: 20px; margin-top: 20px; }
        .maintenance-box p { color: #94A3B8; font-size: 14px; margin: 0; }
        .maintenance-box .timer { font-size: 24px; font-weight: 700; color: #FBBF24; }
        @media (max-width: 480px) { .error-code { font-size: 80px; } .error-title { font-size: 22px; } }
    </style>
</head>
<body>
    <div class="container">
        <span class="icon">🔧</span>
        <div class="error-code">503</div>
        <h1 class="error-title">Service Unavailable</h1>
        <p class="error-desc">We're currently performing scheduled maintenance. We'll be back online shortly. Thank you for your patience.</p>
        <div>
            <a href="javascript:location.reload()" class="btn">Check Again</a>
            <a href="mailto:info@mgtechs.com.ng" class="btn btn-secondary">Contact Support</a>
        </div>
        <div class="maintenance-box">
            <p>Estimated downtime: <span class="timer">~15 minutes</span></p>
            <p style="margin-top: 10px; font-size: 13px; color: #64748B;">For urgent matters, contact us at <a href="mailto:info@mgtechs.com.ng" style="color: #818CF8; text-decoration: none;">info@mgtechs.com.ng</a></p>
        </div>
    </div>
</body>
</html>