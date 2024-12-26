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
      background-color: #f9f9f9;
      padding: 20px 0;
    }
    .email-content {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
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
    }
    .email-body h2 {
      color: #333333;
      font-size: 20px;
      margin-bottom: 10px;
    }
    .email-body p {
      font-size: 16px;
      line-height: 1.6;
      color: #555555;
    }
    .order-summary {
      margin-top: 20px;
    }
    .order-summary table {
      width: 100%;
      border-collapse: collapse;
    }
    .order-summary th,
    .order-summary td {
      text-align: left;
      padding: 10px;
      border-bottom: 1px solid #dddddd;
    }
    .order-summary th {
      background-color: #f4f4f7;
      color: #333333;
    }
    .email-footer {
      background-color: #f1f1f1;
      padding: 20px;
      text-align: center;
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
        <h1>Order and Payment Confirmation</h1>
      </div>

      <!-- Body -->
      <div class="email-body">
        <h2>Hello Admin,</h2>
        <p>You have received a new order. Below are the details:</p>

        <!-- Payment Details -->
        <p><strong>Payment Details:</strong></p>
        <p><strong>Customer Name:</strong> [name]</p>
        <p><strong>Amount Paid:</strong> $[sub+del]</p>
        <p><strong>Payment Date:</strong> {\Carbon\Carbon::now() }</p>
        
        <!-- Order Details -->
        <div class="order-summary">
          <p><strong>Order Details:</strong></p>
          <table>
            <tr>
              <th>Item</th>
              <th>Quantity</th>
              <th>Price</th>
            </tr>
            @foreach ($data['shopped'] as $index=> $item)
            <tr>
                <td>{{$item['name']}}</td>
                <td>{{$data['stock'][$index]}}</td>
                <td>{{$item['price']}}</td>
            </tr>
            @endforeach
          
           
          </table>
        </div>
        <p>Please log in to the admin dashboard to process the order.</p>
      </div>

      <!-- Footer -->
      <div class="email-footer">
        <p>&copy; Still Searching <a href="#">Admin Dashboard</a></p>
      </div>
    </div>
  </div>
</body>
</html>
