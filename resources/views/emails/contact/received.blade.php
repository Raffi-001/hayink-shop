<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111; line-height: 1.6; background-color: #f8f9fa; padding: 30px;">
<div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 6px; padding: 24px;">
    <h2 style="color: #222;">📩 New Contact Message</h2>
    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <hr style="border:none; border-top:1px solid #eee; margin:20px 0;">
    <p><strong>Message:</strong></p>
    <p style="white-space: pre-line;">{{ $messageContent }}</p>

    <hr style="border:none; border-top:1px solid #eee; margin:20px 0;">
    <p style="font-size: 14px; color: #777;">
        — HayInk Contact Form
    </p>
</div>
</body>
</html>
