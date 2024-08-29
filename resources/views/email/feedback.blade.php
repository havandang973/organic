<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Feedback Received</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f7;
            padding: 20px;
            margin: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 20px;
            margin-top: 0;
            color: #333;
        }
        p {
            line-height: 1.6;
            margin: 10px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
        .highlight {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Feedback from {{ $name }}</h2>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Message:</strong></p>
        <p class="highlight">{{ $feedback_message }}</p>
        
        <div class="footer">
            <p>This email was sent from your website's feedback form.</p>
        </div>
    </div>
</body>
</html>
