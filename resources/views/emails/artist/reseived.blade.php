<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Artist Application</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111; line-height: 1.6; background-color: #f8f9fa; padding: 30px;">
<div style="max-width: 640px; margin: 0 auto; background: #fff; border-radius: 8px; padding: 24px;">
    <h2 style="color: #222;">🎨 New Artist Application</h2>

    <p><strong>Name:</strong> {{ $data['name'] ?? '—' }}</p>
    <p><strong>Email:</strong> {{ $data['email'] ?? '—' }}</p>
    <p><strong>Phone Number:</strong> {{ $data['phone_number'] ?? '—' }}</p>
    <p><strong>Country:</strong> {{ $data['country'] ?? '—' }}</p>

    @if(!empty($data['portfolio_url']))
        <p><strong>Portfolio URL:</strong> <a href="{{ $data['portfolio_url'] }}">{{ $data['portfolio_url'] }}</a></p>
    @endif

    <hr style="border:none; border-top:1px solid #eee; margin:20px 0;">

    @if(!empty($data['about_myself']))
        <p><strong>About Myself:</strong></p>
        <p style="white-space: pre-line;">{{ $data['about_myself'] }}</p>
    @endif

    @if(!empty($data['type_of_design']))
        <p><strong>Type of Designs:</strong></p>
        <p style="white-space: pre-line;">{{ $data['type_of_design'] }}</p>
    @endif

    @if(!empty($data['how_did_you_hear']))
        <p><strong>How Did You Hear About Us:</strong></p>
        <p style="white-space: pre-line;">{{ $data['how_did_you_hear'] }}</p>
    @endif

    <hr style="border:none; border-top:1px solid #eee; margin:20px 0;">
    <p style="font-size: 14px; color: #777;">— HayInk Artist Applications</p>
</div>
</body>
</html>
