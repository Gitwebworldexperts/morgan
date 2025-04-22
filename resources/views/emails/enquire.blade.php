<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #3A3526;
            color: #ffffff;
            text-align: center;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            color: #333333;
            line-height: 1.6;
        }
        .content strong {
            color: #000000;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #666666;
            border-top: 1px solid #eeeeee;
            margin-top: 20px;
        }
        .footer a {
            color: #3A3526;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: #ffffff;
            background: #3A3526;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Inquiry Submission</h2>
        </div>
        <div class="content">
            <p><strong>Name:</strong> {{ $contact['first_name'] }} {{ $contact['last_name'] }}</p>
            <p><strong>Page URL:</strong> <a href="{{ $contact['url'] }}" >Click Here</a></p>
            <p><strong>Email:</strong> {{ $contact['email'] }}</p>
            <p><strong>Phone:</strong> {{ $contact['phone'] }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $contact['message'] }}</p>
            
            
            
            <a href="mailto:{{ $contact['email'] }}" class="button">Reply to Email</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company | <a href="{{ config('app.url') }}">Visit Website</a></p>
        </div>
    </div>
</body>
</html>
