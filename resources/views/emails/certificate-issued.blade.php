<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Issued - {{ $certificate_number ?? 'N/A' }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #0F172A; color: #F1F5F9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #F59E0B, #D97706); padding: 30px 20px; text-align: center; border-radius: 12px 12px 0 0; }
        .header h1 { color: white; font-size: 24px; margin: 0; }
        .header .subtitle { color: rgba(255,255,255,0.8); font-size: 14px; margin: 5px 0 0; }
        .content { background: #1E293B; padding: 30px 25px; border-radius: 0 0 12px 12px; }
        .content h2 { color: #F1F5F9; font-size: 20px; margin-top: 0; }
        .content p { color: #94A3B8; line-height: 1.6; font-size: 15px; }
        .certificate-box { background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.2); border-radius: 10px; padding: 20px; margin: 20px 0; text-align: center; }
        .certificate-box .number { font-size: 20px; font-weight: 700; color: #FBBF24; }
        .certificate-box .label { color: #94A3B8; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; }
        .btn { display: inline-block; padding: 12px 35px; background: linear-gradient(135deg, #F59E0B, #D97706); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; }
        .btn:hover { opacity: 0.9; }
        .footer { text-align: center; padding: 20px; color: #64748B; font-size: 12px; border-top: 1px solid #334155; margin-top: 20px; }
        .footer a { color: #818CF8; text-decoration: none; }
        @media (max-width: 480px) { .container { padding: 10px; } .content { padding: 20px 15px; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏆 Certificate Issued!</h1>
            <div class="subtitle">{{ $course_title ?? 'Course' }}</div>
        </div>
        <div class="content">
            <h2>Congratulations, {{ $student_name ?? 'there' }}! 🎉</h2>
            <p>You have successfully completed <strong>{{ $course_title ?? 'Course' }}</strong> and earned your certificate.</p>
            <div class="certificate-box">
                <div class="label">Certificate Number</div>
                <div class="number">{{ $certificate_number ?? 'N/A' }}</div>
                <p style="color: #94A3B8; font-size: 14px; margin-top: 10px;">Issued on {{ $issued_date ?? date('F d, Y') }}</p>
            </div>
            <p style="text-align: center; margin: 20px 0;">
                <a href="{{ $certificate_link ?? '#' }}" class="btn"><i class="fas fa-download"></i> Download Certificate</a>
            </p>
            <p style="color: #64748B; font-size: 13px; text-align: center;">This certificate can be verified online using the certificate number above.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} MGTECHS Limited. All rights reserved.<br><a href="{{ url('/') }}">{{ url('/') }}</a></p>
        </div>
    </div>
</body>
</html>