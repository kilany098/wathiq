<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contract #{{ $contract->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; }
        .header img { height: 80px; }
        .title { font-size: 24px; font-weight: bold; margin: 20px 0; }
        .section-title { font-size: 18px; font-weight: bold; margin: 15px 0 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px; }
        .contract-info { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .contract-info td { padding: 8px; vertical-align: top; }
        .contract-info tr:nth-child(even) { background-color: #f9f9f9; }
        .signature-area { margin-top: 50px; }
        .signature-line { width: 300px; border-top: 1px solid #000; margin: 40px 0 10px; }
        .footer { margin-top: 50px; font-size: 12px; color: #666; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        @if(file_exists(public_path('images/logo.png')))
        <img src="{{ public_path('images/logo.png') }}" alt="Company Logo">
        @endif
        <div class="title">SERVICE CONTRACT AGREEMENT</div>
    </div>

    <table class="contract-info">
        <tr>
            <td width="30%"><strong>Contract Number:</strong></td>
            <td>Wathiq-{{ str_pad($contract->id, 5, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <td><strong>Contract Date:</strong></td>
            <td>{{ $today }}</td>
        </tr>
        <tr>
            <td><strong>Contract Status:</strong></td>
            <td style="text-transform: capitalize;">{{ $contract->status }}</td>
        </tr>
    </table>

    <div class="section-title">1. PARTIES</div>
    <p>This Service Contract Agreement ("Agreement") is made and entered into as of {{ $startDate }} by and between:</p>
    
    <p><strong>{{ $client->name }}</strong>, with principal place of business at [Client Address] ("Client")</p>
    
    <p>And</p>
    
    <p><strong>Wathiq Pest Control Company</strong>, with principal place of business at [Your Company Address] ("Service Provider")</p>

    <div class="section-title">2. SERVICE DETAILS</div>
    <table class="contract-info">
        <tr>
            <td width="30%"><strong>Service Type:</strong></td>
            <td>{{ $contract->type }}</td>
        </tr>
        <tr>
            <td><strong>Number of Visits:</strong></td>
            <td>{{ $contract->visits }}</td>
        </tr>
        <tr>
            <td><strong>Expected Hours:</strong></td>
            <td>{{ $contract->expected_hours }} hours</td>
        </tr>
        <tr>
            <td><strong>Service Period:</strong></td>
            <td>From {{ $startDate }} to {{ $endDate }}</td>
        </tr>
        <tr>
            <td><strong>Operated By:</strong></td>
            <td>{{ $operator->name }}</td>
        </tr>
    </table>

    <div class="section-title">3. FINANCIAL TERMS</div>
    <table class="contract-info">
        <tr>
            <td width="30%"><strong>Total Contract Value:</strong></td>
            <td>${{ $totalValue }}</td>
        </tr>
        <tr>
            <td><strong>Payment Terms:</strong></td>
            <td>{{ ucfirst($contract->payment_terms) }}</td>
        </tr>
        @if($contract->payment_terms == 'custom')
        <tr>
            <td><strong>Custom Terms:</strong></td>
            <td>{{ $contract->custom_payment_terms }}</td>
        </tr>
        @endif
    </table>

    <div class="section-title">4. TERMS AND CONDITIONS</div>
    <p>{!! nl2br(e($contract->terms_and_conditions)) !!}</p>

    @if($contract->note)
    <div class="section-title">SPECIAL NOTES</div>
    <p>{!! nl2br(e($contract->note)) !!}</p>
    @endif

    <div class="signature-area">
        <div style="float: left; width: 45%;">
            <p><strong>For Client:</strong></p>
            <div class="signature-line"></div>
            <p>Name: ___________________________</p>
            <p>Title: __________________________</p>
            <p>Date: __________________________</p>
        </div>
        
        <div style="float: right; width: 45%;">
            <p><strong>For Wathiq Pest Control:</strong></p>
            <div class="signature-line"></div>
            <p>Name: ___________________________</p>
            <p>Title: __________________________</p>
            <p>Date: __________________________</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="footer">
        <p>This contract constitutes the entire agreement between the parties and supersedes all prior agreements.</p>
        <p>Generated on {{ $today }}</p>
    </div>
</body>
</html>