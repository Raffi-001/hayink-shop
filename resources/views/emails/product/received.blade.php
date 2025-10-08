<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Custom Product Submission</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111; line-height: 1.6; background-color: #f8f9fa; padding: 30px;">
<div style="max-width: 640px; margin: 0 auto; background: #fff; border-radius: 8px; padding: 24px;">
    <h2 style="color: #222;">🧵 New Custom Product Submission</h2>

    <p><strong>Name:</strong> {{ $data['name'] ?? '—' }}</p>
    <p><strong>Email:</strong> {{ $data['email'] ?? '—' }}</p>
    <p><strong>Phone Number:</strong> {{ $data['phone_number'] ?? '—' }}</p>

    <hr style="border:none; border-top:1px solid #eee; margin:20px 0;">

    @if(!empty($data['regions']))
        <p><strong>Selected Region(s):</strong></p>
        <ul>
            @foreach((array) $data['regions'] as $region)
                <li>{{ $region }}</li>
            @endforeach
        </ul>
    @endif

    @if(!empty($data['sizes']))
        <p><strong>Sizes & Quantities:</strong></p>
        <table style="border-collapse: collapse; width: 100%; margin-top: 8px;">
            <thead>
            <tr style="background-color: #f2f2f2;">
                <th align="left" style="padding: 6px;">Color</th>
                <th align="left" style="padding: 6px;">Size</th>
                <th align="left" style="padding: 6px;">Qty</th>
            </tr>
            </thead>
            <tbody>
            @foreach((array) $data['sizes'] as $item)
                <tr>
                    <td style="padding: 6px;">{{ $item['color'] ?? '—' }}</td>
                    <td style="padding: 6px;">{{ $item['size'] ?? '—' }}</td>
                    <td style="padding: 6px;">{{ $item['qty'] ?? 0 }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <hr style="border:none; border-top:1px solid #eee; margin:20px 0;">
    <p style="font-size: 14px; color: #777;">— HayInk Custom Orders</p>
</div>
</body>
</html>
