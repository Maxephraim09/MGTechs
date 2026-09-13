<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice_number ?? 'N/A' }}</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #0F172A; color: #F1F5F9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #4F46E5, #7C3AED); padding: 20px; text-align: center; border-radius: 12px 12px 0 0; }
        .header h1 { color: white; font-size: 22px; margin: 0; }
        .header .invoice-number { color: rgba(255,255,255,0.8); font-size: 14px; margin: 5px 0 0; }
        .content { background: #1E293B; padding: 25px; border-radius: 0 0 12px 12px; }
        .invoice-details { display: flex; justify-content: space-between; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #334155; }
        .invoice-details .label { color: #94A3B8; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
        .invoice-details .value { color: #F1F5F9; font-size: 14px; font-weight: 500; }
        .invoice-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .invoice-table th { text-align: left; color: #94A3B8; font-size: 12px; text-transform: uppercase; padding: 10px 0; border-bottom: 2px solid #334155; }
        .invoice-table td { padding: 12px 0; color: #E2E8F0; border-bottom: 1px solid #1E293B; }
        .invoice-table .total-row td { font-weight: bold; border-top: 2px solid #4F46E5; padding-top: 15px; }
        .invoice-table .total-row .total-label { color: #F1F5F9; }
        .invoice-table .total-row .total-amount { color: #4F46E5; font-size: 18px; }
        .status-paid { display: inline-block; padding: 4px 12px; background: rgba(16,185,129,0.2); color: #34D399; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-pending { display: inline-block; padding: 4px 12px; background: rgba(245,158,11,0.2); color: #FBBF24; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .btn { display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, #4F46E5, #7C3AED); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 10px 0; }
        .btn:hover { opacity: 0.9; }
        .footer { text-align: center; padding: 20px; color: #64748B; font-size: 12px; border-top: 1px solid #334155; margin-top: 20px; }
        .footer a { color: #818CF8; text-decoration: none; }
        @media (max-width: 480px) { .container { padding: 10px; } .content { padding: 15px; } .invoice-details { flex-direction: column; gap: 10px; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>INVOICE</h1>
            <div class="invoice-number">#{{ $invoice_number ?? 'N/A' }}</div>
        </div>
        <div class="content">
            <div class="invoice-details">
                <div><div class="label">Date</div><div class="value">{{ $invoice_date ?? date('F d, Y') }}</div></div>
                <div><div class="label">Status</div><div class="value"><span class="{{ $status === 'paid' ? 'status-paid' : 'status-pending' }}">{{ ucfirst($status ?? 'pending') }}</span></div></div>
                <div><div class="label">Due Date</div><div class="value">{{ $due_date ?? 'N/A' }}</div></div>
            </div>
            <div style="margin: 15px 0;">
                <div class="label">Bill To</div>
                <div style="color: #F1F5F9; font-size: 14px; margin-top: 5px;">
                    <strong>{{ $client_name ?? 'Client' }}</strong><br>{{ $client_email ?? '' }}<br>{{ $client_phone ?? '' }}
                </div>
            </div>
            <table class="invoice-table">
                <thead><tr><th>Description</th><th style="text-align: right;">Qty</th><th style="text-align: right;">Price</th><th style="text-align: right;">Total</th></tr></thead>
                <tbody>
                    @foreach($items ?? [] as $item)
                        <tr>
                            <td>{{ $item['description'] ?? 'Item' }}</td>
                            <td style="text-align: right;">{{ $item['quantity'] ?? 1 }}</td>
                            <td style="text-align: right;">₦{{ number_format($item['price'] ?? 0, 2) }}</td>
                            <td style="text-align: right;">₦{{ number_format(($item['quantity'] ?? 1) * ($item['price'] ?? 0), 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3" class="total-label" style="text-align: right;">Total</td>
                        <td style="text-align: right;" class="total-amount">₦{{ number_format($total_amount ?? 0, 2) }}</td>
                    </tr>
                </tbody>
            </table>
            <div style="text-align: center; margin: 20px 0;">
                <a href="{{ $invoice_link ?? '#' }}" class="btn"><i class="fas fa-download"></i> Download Invoice</a>
            </div>
            <p style="color: #64748B; font-size: 13px; text-align: center;">{{ $notes ?? 'Thank you for your business!' }}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} MGTECHS Limited. All rights reserved.<br><a href="{{ url('/') }}">{{ url('/') }}</a></p>
            <p style="margin-top: 10px; font-size: 11px; color: #475569;">Questions? Contact us at <a href="mailto:info@mgtechs.com.ng">info@mgtechs.com.ng</a></p>
        </div>
    </div>
</body>
</html>