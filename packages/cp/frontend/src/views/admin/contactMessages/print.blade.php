<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Contact Messages</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 24px; color: #111; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .header h2 { margin: 0; font-size: 18px; }
        .meta { font-size: 12px; color: #555; }
        .card { border: 1px solid #ddd; border-radius: 8px; padding: 14px 16px; margin-bottom: 12px; break-inside: avoid; }
        .row { display: flex; flex-wrap: wrap; gap: 10px 18px; margin-bottom: 8px; }
        .label { font-size: 12px; color: #666; }
        .value { font-size: 14px; }
        .field { min-width: 200px; }
        .message { margin-top: 8px; white-space: pre-wrap; line-height: 1.4; }
        @media print {
            .no-print { display: none !important; }
            body { margin: 8mm; }
            .card { border-color: #bbb; }
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h2>Contact Messages</h2>
            <div class="meta">Printed at: {{ now()->format('Y-m-d h:i A') }} | Total: {{ $messages->count() }}</div>
        </div>
        <div class="no-print">
            <button onclick="window.print()">Print</button>
        </div>
    </div>

    @forelse($messages as $m)
        <div class="card">
            <div class="row">
                <div class="field">
                    <div class="label">ID</div>
                    <div class="value">{{ $m->id }}</div>
                </div>
                <div class="field">
                    <div class="label">Name</div>
                    <div class="value">{{ $m->full_name }}</div>
                </div>
                <div class="field">
                    <div class="label">Email</div>
                    <div class="value">{{ $m->email }}</div>
                </div>
                <div class="field">
                    <div class="label">Phone</div>
                    <div class="value">{{ $m->number }}</div>
                </div>
                <div class="field">
                    <div class="label">Subject</div>
                    <div class="value">{{ $m->subject }}</div>
                </div>
                <div class="field">
                    <div class="label">Time</div>
                    <div class="value">{{ optional($m->created_at)->format('Y-m-d h:i A') }}</div>
                </div>
            </div>
            <div class="label">Message</div>
            <div class="message">{{ $m->message }}</div>
        </div>
    @empty
        <p>No messages selected.</p>
    @endforelse
</body>
</html>

