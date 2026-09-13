<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Update - {{ $project_title ?? 'N/A' }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #0F172A; color: #F1F5F9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #4F46E5, #7C3AED); padding: 25px 20px; text-align: center; border-radius: 12px 12px 0 0; }
        .header h1 { color: white; font-size: 22px; margin: 0; }
        .header .subtitle { color: rgba(255,255,255,0.8); font-size: 14px; margin: 5px 0 0; }
        .content { background: #1E293B; padding: 25px; border-radius: 0 0 12px 12px; }
        .content h2 { color: #F1F5F9; font-size: 18px; margin-top: 0; }
        .content p { color: #94A3B8; line-height: 1.6; font-size: 14px; }
        .update-box { background: rgba(79,70,229,0.08); border-left: 4px solid #4F46E5; padding: 15px 20px; margin: 15px 0; border-radius: 4px; }
        .update-box p { margin: 0; color: #E2E8F0; }
        .progress-bar { background: #334155; border-radius: 8px; height: 20px; overflow: hidden; margin: 10px 0; }
        .progress-bar .progress-fill { height: 100%; background: linear-gradient(90deg, #4F46E5, #7C3AED); border-radius: 8px; transition: width 0.5s; }
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-badge.completed { background: rgba(16,185,129,0.2); color: #34D399; }
        .status-badge.in_progress { background: rgba(59,130,246,0.2); color: #60A5FA; }
        .status-badge.review { background: rgba(245,158,11,0.2); color: #FBBF24; }
        .status-badge.planning { background: rgba(107,114,128,0.2); color: #9CA3AF; }
        .btn { display: inline-block; padding: 10px 28px; background: linear-gradient(135deg, #4F46E5, #7C3AED); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; }
        .btn:hover { opacity: 0.9; }
        .footer { text-align: center; padding: 20px; color: #64748B; font-size: 12px; border-top: 1px solid #334155; margin-top: 20px; }
        .footer a { color: #818CF8; text-decoration: none; }
        @media (max-width: 480px) { .container { padding: 10px; } .content { padding: 15px; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Project Update</h1>
            <div class="subtitle">{{ $project_title ?? 'Project' }}</div>
        </div>
        <div class="content">
            <h2>Hello {{ $client_name ?? 'there' }},</h2>
            <p>We have an update regarding your project <strong>{{ $project_title ?? 'Project' }}</strong>.</p>
            <div class="update-box">
                <p><strong>{{ $update_title ?? 'Update' }}</strong></p>
                <p style="margin-top: 5px; color: #94A3B8;">{{ $update_message ?? 'No details provided.' }}</p>
            </div>
            <div style="margin: 15px 0;">
                <div style="display: flex; justify-content: space-between; font-size: 14px; color: #94A3B8;"><span>Progress</span><span>{{ $progress_percentage ?? 0 }}%</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: {{ $progress_percentage ?? 0 }}%"></div></div>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin: 15px 0; padding: 15px 0; border-top: 1px solid #334155; border-bottom: 1px solid #334155;">
                <span style="color: #94A3B8; font-size: 14px;">Status</span>
                <span class="status-badge {{ $status ?? 'planning' }}">{{ ucfirst(str_replace('_', ' ', $status ?? 'Planning')) }}</span>
            </div>
            <p style="text-align: center; margin: 20px 0;"><a href="{{ $project_link ?? '#' }}" class="btn">View Project Details</a></p>
            <p style="color: #64748B; font-size: 13px; text-align: center;">Need to discuss this update? Reply to this email or contact us directly.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} MGTECHS Limited. All rights reserved.<br><a href="{{ url('/') }}">{{ url('/') }}</a></p>
        </div>
    </div>
</body>
</html>