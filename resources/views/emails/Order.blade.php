<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    <style>
        body {
          font-family: Arial, sans-serif;
          background-color: #f9f9f9;
          margin: 0;
          padding: 0;
        }
    
        .container {
          max-width: 800px;
          margin: 50px auto;
          background: white;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
          border-radius: 10px;
          overflow: hidden;
        }
    
        .header {
          background-color: #4caf50;
          color: white;
          text-align: center;
          padding: 20px;
        }
    
        .header h1 {
          margin: 0;
          font-size: 24px;
        }
    
        .content {
          padding: 30px;
        }
    
        .content h2 {
          font-size: 20px;
          margin-bottom: 20px;
          color: #333;
        }
    
        .order-summary {
          width: 100%;
          border-collapse: collapse;
          margin-bottom: 20px;
        }
    
        .order-summary th,
        .order-summary td {
          padding: 10px;
          border: 1px solid #ddd;
          text-align: left;
        }
    
        .order-summary th {
          background-color: #f5f5f5;
        }
    
        .total {
          font-weight: bold;
        }
    
        .footer {
          text-align: center;
          padding: 15px;
          background-color: #f1f1f1;
          color: #777;
        }
    
        .footer a {
          color: #4caf50;
          text-decoration: none;
        }
    
        .footer a:hover {
          text-decoration: underline;
        }
      </style>
      
</head>
<body>
    <div class="container">
      <!-- Header Section -->
      <div class="header">
        <h1>Order Confirmation</h1>
      </div>
  
      <!-- Content Section -->
      <div class="content">
        <h2>Thank you for your purchase, <strong>{{$data['name']}}</strong>!</h2>
        <p>Your order has been received and is being processed. Below is a summary of the items you ordered:</p>
  
        <!-- Order Summary -->
        <table class="order-summary">
          <thead>
            <tr>
              <th>Item</th>
              <th>Quantity</th>
              <th>Price</th>
            
            </tr>
          </thead>
          <tbody>
          
            @foreach ($data['shopped'] as $index=> $item)
       <tr>
           <td>{{$item['name']}}</td>
           <td>{{$data['stock'][$index]}}</td>
           <td>{{$item['price']}}</td>
       </tr>
       @endforeach
          </tbody>
          <tfoot>
            <tr>
                        <td colspan="2">Subtotal</td>
                        <td>#{{$data['sub']}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Delivery </td>
                        <td>#{{$data['del']}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Total</td>
                        <td>#{{$data['sub']+$data['del']}}</td>
            </tr>
          </tfoot>
        </table>
  
        <p>If you have any questions about your order, feel free to <a href="/contact-us">contact us</a>.</p>
      </div>
  
      <!-- Footer Section -->
      <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> Your Store. All rights reserved.</p>
        <p>
          <a href="/shop">Continue Shopping</a> | 
          <a href="/track-order">Track Your Order</a>
        </p>
      </div>
    </div>
  </body>
  </html>