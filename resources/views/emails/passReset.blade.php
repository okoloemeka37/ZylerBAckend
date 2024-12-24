<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f7;
      margin: 0;
      padding: 0;
      color: #333;
    }
    .email-wrapper {
      width: 100%;
      background-color: #f4f4f7;
      padding: 20px 0;
    }
    .email-content {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .email-header {
      background-color: #4f46e5;
      padding: 20px;
      text-align: center;
      color: #ffffff;
    }
    .email-header h1 {
      margin: 0;
      font-size: 24px;
    }
    .email-body {
      padding: 20px;
    }
    .email-body h2 {
      font-size: 20px;
      margin-bottom: 10px;
    }
    .email-body p {
      line-height: 1.6;
      margin: 10px 0;
    }
    .token-box {
      display: inline-block;
      background-color: #f4f4f7;
      padding: 10px 20px;
      border: 1px dashed #4f46e5;
      color: #4f46e5;
      font-weight: bold;
      border-radius: 4px;
      margin: 10px 0;
    }
    .reset-button {
      display: block;
      text-align: center;
      background-color: #4f46e5;
      color: #ffffff;
      text-decoration: none;
      font-size: 16px;
      font-weight: bold;
      padding: 12px 20px;
      border-radius: 6px;
      margin: 20px auto;
      width: fit-content;
    }
    .email-footer {
      padding: 10px;
      text-align: center;
      font-size: 12px;
      color: #999;
    }
    .email-footer a {
      color: #4f46e5;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="email-content">
      <!-- Header -->
      <div class="email-header">
        <h1>Password Reset Request</h1>
      </div>
      <!-- Body -->
      <div class="email-body">
        <h2>Hello,</h2>
        <p>We received a request to reset your password. Please use the token below to reset your password:</p>
        <div class="token-box">{{$data['token']}}</div>
       
        <p>If you didn’t request a password reset, you can safely ignore this email.</p>
        <p>Thank you,<br>The Support Team</p>
      </div>
      <!-- Footer -->
      <div class="email-footer">
        <p>If you have any questions, please contact our support team at <a href="mailto:support@example.com">support@example.com</a>.</p>
        <p>&copy; 2024 Your Company. All rights reserved.</p>
      </div>
    </div>
  </div>
</body>
</html>
