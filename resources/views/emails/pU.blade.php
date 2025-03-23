<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }
    .email-wrapper {
      width: 100%;
      padding: 20px 0;
      background-color: #f9f9f9;
    }
    .email-content {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .email-header {
      background-color: #4caf50;
      color: #ffffff;
      text-align: center;
      padding: 20px;
    }
    .email-header h1 {
      margin: 0;
      font-size: 24px;
    }
    .email-body {
      padding: 20px;
      color: #333333;
    }
    .email-body h2 {
      font-size: 20px;
      margin-bottom: 10px;
    }
    .email-body p {
      font-size: 16px;
      line-height: 1.6;
    }
    .email-footer {
      text-align: center;
      padding: 20px;
      background-color: #f1f1f1;
      font-size: 14px;
      color: #555555;
    }
    .email-footer a {
      color: #4caf50;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="email-content">
      <!-- Header -->
      <div class="email-header">
        <h1>Payment Confirmation</h1>
      </div>

      <!-- Body -->
      <div class="email-body">
        <h2>Dear {{$data['name']}},</h2>
        <p>We are pleased to inform you that your payment has been successfully received. Below are the payment details:</p>
        <p><strong>Amount Paid:</strong> {{$data['sub']+$data['del']}}</p>
        <p><strong>Payment Date:</strong>{{\Carbon\Carbon::now() }}</p>
        <p>If you have any questions regarding your payment, please feel free to <a href="#">contact us</a>.</p>
        <p>Thank you for your trust and support!</p>
      </div>

      <!-- Footer -->
      <div class="email-footer">
        <p>{{date('Y')}} &copy; Still Searching | <a href="#">Visit our website</a></p>
      </div>
    </div>
  </div>
</body>
</html>
