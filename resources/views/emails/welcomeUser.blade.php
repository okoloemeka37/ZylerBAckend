<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to [Your Store Name]</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #3e51bd;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content h2 {
            color: #333;
        }
        .content p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 20px;
            background-color: #ff6600;
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #e65c00;
        }
        .footer {
            background-color: #3e51bd;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            font-size: 14px;
        }
        .footer a {
            color: #1a245c;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Welcome {{$data['name']}} to Zyler.com!
        </div>
        <div class="content">
            <h2>Thank You for Joining Us!</h2>
            <p>We are thrilled to have you as part of our fashion family. Get ready to explore the latest trends, exclusive deals, and more.</p>
            <p>As a welcome gift, enjoy <strong>10% off</strong> your first purchase! Use code <strong>WELCOME10</strong> at checkout.</p>
            <a href="#" class="button">Shop Now</a>
        </div>
        <div class="footer">
            &copy;<?php echo date('Y')?> Zyler.com || All Rights Reserved.<br>
            <a href="#">Unsubscribe</a> | <a href="#">Contact Us</a>
        </div>
    </div>
</body>
</html>
