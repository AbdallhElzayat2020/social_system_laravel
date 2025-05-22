<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4e73df;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fc;
            padding: 20px;
            border: 1px solid #e3e6f0;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #858796;
            font-size: 0.9em;
        }
        .message {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #e3e6f0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reply to Your Message</h2>
    </div>
    
    <div class="content">
        <p>Dear {{ $recipientName }},</p>
        
        <div class="message">
            {!! nl2br(e($replyMessage)) !!}
        </div>
        
        <p>Thank you for contacting us. If you have any further questions, please don't hesitate to ask.</p>
        
        <p>Best regards,<br>
        {{ config('app.name') }} Team</p>
    </div>
    
    <div class="footer">
        <p>This is an automated response to your message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>
</html> 