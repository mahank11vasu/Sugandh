<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION['email'])) {
  header('Location: index.php');
  exit();
}

$userEmail = $_SESSION['email'];
$sql = "SELECT id FROM users WHERE email = '$userEmail'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $userID = $row['id'];
}

if (isset($_POST['cancel'])) {
  header("Location: cart.php");
  exit();
}


if (isset($_POST['submit'])) {
   
  // Get user information
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  $payment_option = $_POST['payment_option'];

  if ($payment_option === 'cash_on_delivery') {
    $paymentMethod = 'Cash on Delivery';
  } else {
    $paymentMethod = 'Online Payment';
  }

  $orderDate = date('Y-m-d H:i:s');
  $totalAmount = $_SESSION['finalTotal'];
  $status = "Pending";
  $orderSql = "INSERT INTO orders (UserID, OrderDate, TotalAmount, ShippingAddress, Status, PaymentMethod, RecipientName, RecipientPhone) 
                    VALUES ('$userID', '$orderDate', '$totalAmount', '$address', '$status', '$paymentMethod', '$name', '$phone')";
  $conn->query($orderSql);

  $orderId = $conn->insert_id;

  $orderDetails = [];
  $cartData = $_SESSION['cartData'];
  foreach ($cartData as $row) {
    $productId = $row['ProductID'];
    $pName = $row['PName'];
    $quantity = $row['Quantity'];
    $price = $row['Price'];
    $image = $row['Image'];

    $detailSql = "INSERT INTO order_details (OrderID, ProductID, Quantity, Image, ProductName, Price) 
                  VALUES ('$orderId', '$productId', '$quantity', '$image', '$pName', '$price')";
    $conn->query($detailSql);

    $orderDetails[] = [
      'ProductName' => $pName,
      'Quantity' => $quantity,
      'Price' => $price
    ];
  }
  // Convert the order details array to JSON
  $orderDetailsJson = json_encode($orderDetails);

  // Update the order record with the order details JSON
  $updateOrderSql = "UPDATE orders SET Details = '$orderDetailsJson' WHERE OrderID = '$orderId'";
  $conn->query($updateOrderSql);
  
  $clearCartSql = "DELETE FROM cart WHERE UserID = '$userID'";
  $conn->query($clearCartSql);

  $to = $email;
  $subject = "Order Placed - Pending Confirmation";
  $message = "Dear $name,\n\nThank you for placing an order on our website!\n\nYour order has been received and is currently pending confirmation. You will receive an update regarding the acceptance of your order shortly.\n\nOrder Details:\n\n";
  $message .= "\n\nThank you for choosing our service!";
  $headers = "From: visit@sugandh.shop";
  if (mail($to, $subject, $message, $headers)) {
    echo '<script>alert("Orde Placed Successfully. Wait For Conformation Mail");</script>';
    header("Location: manage_orders.php");
    exit();
  } else {
    $error = "Error sending email. Please try again later.";
    echo "<script>alert('$error');</script>";
  }

  unset($_SESSION['cartData']);
  unset($_SESSION['totalAmount']);
  unset($_SESSION['gstAmount']);
  unset($_SESSION['finalTotal']);
  header("Location: manage_orders.php");
  exit();
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Order Page</title>
    <link rel="stylesheet" type="text/css" href="/CSS/order.css">
</head>
<body>
    <div id="container1" class="your-class">
      <div id="nav">
        <div id="logo">
          <img src="/Images/Sugandh logo png.png" id="logoimg" alt="" />
        </div>
        <div id="navitems">
          <div class="navitemstxt"><a href="index.php">Home</a></a></div>
          <div id="forarrow">
            <div class="navitemstxt" id="orders">Shop</div>
            <div id="arrow"></div>
          </div>
          <div class="navitemstxt"><a href="/about.php">About Us</a></div>
          <div class="navitemstxt"><a href="/contact.php">Contact Us</div>
        </div>
        <div id="log">
          <img src="/Images/user.png" alt="" id="user">
      </div>
    </div>
    </div>
    <div id=container2>
        <div id="ordercontainer">
          <div id="flowerorder" class="itemorder">
            <a href="flower1.php">Flowers</a>
          </div>
          <div id="vaseorder" class="itemorder">
            <a href="vase1.php">Vases</a>
          </div>
          <div id="predefinedorder" class="itemorder">
            <a href="premade1.php">Pre-made Bouquets</a>
          </div>
        </div>
        <div id="profilecontainer">
          <div id="profile1" class="profileitem">
            <a href="profile.php">Update Profile</a>
          </div>
          <div id="profile2" class="profileitem">
            <a href="cart.php">Your Cart</a>
          </div>
          <div id="profile3" class="profileitem">
            <a href="manage_orders.php">Your Orders</a>
          </div>
          <div id="profile4" class="profileitem">
            <a href="logout.php">Logout</a>
          </div>   
        </div>   
         <div id="content">
            <div id="head">Place your order now!</div>
            <form method="POST" action="order.php" id="formflex">
              <div id="rowsflex">
               <div id="row1">
                 <label for="name" class="labels">Name:</label>
                 <input type="text" id="name" name="name" class="fields" required>

                  <label for="email" class="labels">Email:</label>
                  <input type="email" id="email" name="email" class="fields"  required>

                  <label for="phone" class="labels">Phone:</label>
                  <input type="text" id="phone" name="phone" class="fields"  required>
                  <div>
                    <input type="submit" name="submit" value="Place Order" class="btn">
                    <input type="submit" name="cancel" value="Cancel Order" class="btn">
                  </div>
                </div>
                <div id="row2">
                  <label for="address" class="labels">Address:</label>
                  <textarea id="address" name="address" required></textarea>
                  <label for="payment_option" class="labels">Payment Option:</label>
                  <select id="payment_option" name="payment_option" class="format" required>
                     <option value="cash_on_delivery">Cash on Delivery</option>
                     <option value="online_payment">Online Payment</option>
                  </select>
                </div>
          </form>
         </div>
    </div>
    </div>
        <div id="container10">
      <div id="box101">
        <img src="/Images/Sugandh logo png.png" alt="" id="box101logo" />
      </div>
      <div id="box102">
        <div class="row">
          <img src="" alt="" class="ficons" />
          <div class="fdesc">+91 1234567890</div>
        </div>
        <div class="row">
          <img src="" alt="" class="ficons" />
          <div class="fdesc">+91 1234567890</div>
        </div>
      </div>
      <div id="box103">
        <div class="row">
          <img src="" alt="" class="ficons" />
          <div class="fdesc">
            456, Hawa Mahal Road,Pink City,Jaipur - 302002,Rajasthan, India
          </div>
        </div>
      </div>
      <div id="box104">
        <div class="row">
          <img src="" alt="" class="ficons" />
          <img src="" alt="" class="ficons" />
          <img src="" alt="" class="ficons" />
        </div>
      </div>
    </div>
    <script src="JS/order.js"></script>
</body>
</html>