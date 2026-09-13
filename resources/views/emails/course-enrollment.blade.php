<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Confirmation - {{ $course_title ?? 'Course' }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #0F172A; color: #F1F5F9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #10B981, #059669); padding: 30px 20px; text-align: center; border-radius: 12px 12px 0 0; }
        .header h1 { color: white; font-size: 24px; margin: 0; }
        .header .subtitle { color: rgba(255,255,255,0.8); font-size: 14px; margin: 5px 0 0; }
        .content { background: #1E293B; padding: 30px 25px; border-radius: 0 0 12px 12px; }
        .content h2 { color: #F1F5F9; font-size: 20px; margin-top: 0; }
        .content p { color: #94A3B8; line-height: 1.6; font-size: 15px; }
        .course-card { background: rgba(16,185,129,0.05); border: 1px solid rgba(16,185,129,0.15); border-radius: 10px; padding: 20px; margin: 20px 0; }
        .course-card h3 { color: #F1F5F9; margin: 0 0 5px; }
        .course-card .meta { color: #94A3B8; font-size: 13px; }
        .course-card .badge { display: inline-block; padding: 2px 10px; background: rgba(16,185,129,0.15); color: #34D399; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .btn { display: inline-block; padding: 12px 35px; background: linear-gradient(135deg, #10B981, #059669); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; }
        .btn:hover { opacity: 0.9; }
        .footer { text-align: center; padding: 20px; color: #64748B; font-size: 12px; border-top: 1px solid #334155; margin-top: 20px; }
        .footer a { color: #818CF8; text-decoration: none; }
        @media (max-width: 480px) { .container { padding: 10px; } .content { padding: 20px 15px; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 Enrollment Confirmed!</h1>
            <div class="subtitle">You're now enrolled in {{ $course_title ?? 'Course' }}</div>
        </div>
        <div class="content">
            <h2>Congratulations, {{ $student_name ?? 'there' }}! 🎉</h2>
            <p>You have successfully enrolled in the course <strong>{{ $course_title ?? 'Course' }}</strong>.</p>
            <div class="course-card">
                <h3>{{ $course_title ?? 'Course Title' }}</h3>
                <div class="meta"><span>Instructor: {{ $instructor_name ?? 'N/A' }}</span><span style="margin-left: 15px;">Duration: {{ $duration_days ?? 'N/A' }} days</span></div>
                <div style="margin-top: 10px;"><span class="badge">{{ $course_type ?? 'Free' }}</span></div>
            </div>
            <p style="text-align: center; margin: 20px 0;"><a href="{{ $course_link ?? '#' }}" class="btn">Start Learning Now</a></p>
            <div style="background: rgba(255,255,255,0.03); border-radius: 8px; padding: 15px; margin: 20px 0;">
                <h4 style="color: #F1F5F9; margin: 0 0 5px;">What's Next?</h4>
                <ol style="color: #94A3B8; font-size: 14px; padding-left: 20px; margin: 5px 0;">
                    <li>Access your course materials</li>
                    <li>Complete lessons at your own pace</li>
                    <li>Take quizzes to test your knowledge</li>
                    <li>Earn your certificate upon completion</li>
                </ol>
            </div>
            <p style="color: #64748B; font-size: 13px; text-align: center;">If you have any questions, please contact our support team.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} MGTECHS Limited. All rights reserved.<br><a href="{{ url('/') }}">{{ url('/') }}</a></p>
        </div>
    </div>
</body>
</html>