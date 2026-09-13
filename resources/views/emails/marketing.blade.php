<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'MGTECHS - Marketing' }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #0F172A; color: #F1F5F9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #4F46E5, #7C3AED); padding: 30px 20px; text-align: center; border-radius: 12px 12px 0 0; }
        .header h1 { color: white; font-size: 24px; margin: 0; }
        .header p { color: rgba(255,255,255,0.8); margin: 5px 0 0; font-size: 14px; }
        .content { background: #1E293B; padding: 30px 25px; border-radius: 0 0 12px 12px; }
        .content h2 { color: #F1F5F9; font-size: 20px; margin-top: 0; }
        .content p { color: #94A3B8; line-height: 1.6; font-size: 15px; }
        .content .highlight { background: rgba(79,70,229,0.1); border-left: 4px solid #4F46E5; padding: 15px 20px; margin: 20px 0; border-radius: 4px; }
        .content .highlight p { margin: 0; color: #E2E8F0; }
        .btn { display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, #4F46E5, #7C3AED); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 10px 0; }
        .btn:hover { opacity: 0.9; }
        .footer { text-align: center; padding: 20px; color: #64748B; font-size: 12px; border-top: 1px solid #334155; margin-top: 20px; }
        .footer a { color: #818CF8; text-decoration: none; }
        .social-links { margin: 15px 0; }
        .social-links a { display: inline-block; margin: 0 8px; color: #94A3B8; font-size: 18px; }
        .social-links a:hover { color: #F1F5F9; }
        @media (max-width: 480px) { .container { padding: 10px; } .content { padding: 20px 15px; } .header h1 { font-size: 20px; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>MGTECHS</h1>
            <p>Innovative Digital Solutions</p>
        </div>
        <div class="content">
            <h2>{{ $title ?? 'Hello!' }}</h2>
            <p>{{ $message ?? 'We hope this message finds you well.' }}</p>
            @if(isset($highlight))
                <div class="highlight"><p>{{ $highlight }}</p></div>
            @endif
            <p>{{ $body ?? 'Thank you for being part of our community.' }}</p>
            @if(isset($cta_text) && isset($cta_link))
                <div style="text-align: center; margin: 25px 0;">
                    <a href="{{ $cta_link }}" class="btn">{{ $cta_text }}</a>
                </div>
            @endif
            <p style="color: #64748B; font-size: 13px; margin-top: 20px;">
                {{ $footer_text ?? 'Best regards,<br><strong>MGTECHS Team</strong>' }}
            </p>
        </div>
        <div class="footer">
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <p>&copy; {{ date('Y') }} MGTECHS Limited. All rights reserved.<br><a href="{{ url('/') }}">{{ url('/') }}</a></p>
            <p style="margin-top: 10px; font-size: 11px; color: #475569;">If you no longer wish to receive these emails, you can <a href="#">unsubscribe here</a>.</p>
        </div>
    </div>
</body>
</html>