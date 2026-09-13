<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MGTECHS</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #0F172A; color: #F1F5F9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #4F46E5, #7C3AED); padding: 40px 20px; text-align: center; border-radius: 12px 12px 0 0; }
        .header .logo { font-size: 32px; font-weight: 800; color: white; }
        .header .logo span { color: #06B6D4; }
        .header p { color: rgba(255,255,255,0.8); margin: 5px 0 0; font-size: 14px; }
        .content { background: #1E293B; padding: 30px 25px; border-radius: 0 0 12px 12px; }
        .content h2 { color: #F1F5F9; font-size: 22px; margin-top: 0; }
        .content p { color: #94A3B8; line-height: 1.7; font-size: 15px; }
        .welcome-box { background: rgba(79,70,229,0.08); border: 1px solid rgba(79,70,229,0.2); border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center; }
        .welcome-box h3 { color: #F1F5F9; margin: 0 0 5px; }
        .welcome-box p { color: #94A3B8; margin: 0; font-size: 14px; }
        .features { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin: 20px 0; }
        .feature-item { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06); border-radius: 8px; padding: 15px; text-align: center; }
        .feature-item i { font-size: 24px; color: #4F46E5; margin-bottom: 8px; display: block; }
        .feature-item h4 { color: #F1F5F9; font-size: 14px; margin: 0 0 4px; }
        .feature-item p { color: #94A3B8; font-size: 12px; margin: 0; }
        .btn { display: inline-block; padding: 12px 35px; background: linear-gradient(135deg, #4F46E5, #7C3AED); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 10px 0; }
        .btn:hover { opacity: 0.9; }
        .footer { text-align: center; padding: 20px; color: #64748B; font-size: 12px; border-top: 1px solid #334155; margin-top: 20px; }
        .footer a { color: #818CF8; text-decoration: none; }
        @media (max-width: 480px) { .container { padding: 10px; } .content { padding: 20px 15px; } .features { grid-template-columns: 1fr; } .header .logo { font-size: 26px; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">MG<span>TECHS</span></div>
            <p>Innovative Digital Solutions</p>
        </div>
        <div class="content">
            <h2>Welcome to MGTECHS, {{ $name ?? 'there' }}! 👋</h2>
            <p>We're excited to have you on board. You've taken the first step towards transforming your ideas into digital reality.</p>
            <div class="welcome-box">
                <h3>Your Account is Ready</h3>
                <p>You can now access all our services and start your journey with us.</p>
            </div>
            <div class="features">
                <div class="feature-item"><i class="fas fa-code"></i><h4>Web Development</h4><p>Custom websites and applications</p></div>
                <div class="feature-item"><i class="fas fa-graduation-cap"></i><h4>LMS & Training</h4><p>Online learning platforms</p></div>
                <div class="feature-item"><i class="fas fa-paint-brush"></i><h4>Graphics & Branding</h4><p>Professional design services</p></div>
                <div class="feature-item"><i class="fas fa-users-cog"></i><h4>IT Consultation</h4><p>Expert IT advisory</p></div>
            </div>
            <p style="text-align: center;"><a href="{{ route('dashboard') }}" class="btn">Get Started</a></p>
            <p style="color: #64748B; font-size: 13px; text-align: center; margin-top: 20px;">If you have any questions, feel free to reach out to us at any time.<br><strong>Welcome aboard!</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} MGTECHS Limited. All rights reserved.<br><a href="{{ url('/') }}">{{ url('/') }}</a></p>
        </div>
    </div>
</body>
</html>