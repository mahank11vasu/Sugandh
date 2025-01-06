<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

$email = $_SESSION['email'];
$userSql = "SELECT id FROM users WHERE email = '$email'";
$userResult = $conn->query($userSql);

if ($userResult && $userResult->num_rows > 0) {
    $userRow = $userResult->fetch_assoc();
    $userId = $userRow['id'];

    $ordersSql = "SELECT * FROM orders WHERE UserID = $userId";
    $ordersResult = $conn->query($ordersSql);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel-order'])) {
    $orderId = $_POST['cancel-order'];

    $statusSql = "SELECT Status FROM orders WHERE OrderID = $orderId";
    $statusResult = $conn->query($statusSql);
    $statusRow = $statusResult->fetch_assoc();
    $orderStatus = $statusRow['Status'];

    if ($orderStatus === 'Pending' || $orderStatus === 'Processing' || $orderStatus === 'Shipped') {
        $cancelSql = "UPDATE orders SET Status = 'Cancelled' WHERE OrderID = $orderId";
        $conn->query($cancelSql);

        $to = $email;
        $subject = "Order Cancelled";
        $message = "Dear Customer,\n\nYou have successfully cancelled your order with Order ID: $orderId.\n\nWe apologize for any inconvenience caused.\n\nThank you for choosing our service!";
        $headers = "From: visit@sugandh.shop";

        if (mail($to, $subject, $message, $headers)) {
            echo '<script>alert("Order cancelled successfully. You will receive a confirmation email.");</script>';
            header("Location: manage_orders.php");
            exit();
        } else {
            $error = "Error sending email. Please try again later.";
            header("Location: manage_orders.php");
            echo "<script>alert('$error');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Orders</title>
    <link rel="stylesheet" type="text/css" href="/CSS/manage_orders.css">
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
          <div class="navitemstxt"><a href="/contact.php">Contact Us</a></div>
        </div>
        <div id="log">
          <img src="/Images/user.png" alt="" id="user">
      </div>
     </div>
    </div>
    <div id="container2">
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
        <div id="head">Welcome! You can manage your orders from here.</div>
       <table>
          <thead>
            <tr id="heads">
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
                <th>Product Details</th> 
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $ordersResult->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['OrderID']; ?></td>
                <td><?php echo $row['OrderDate']; ?></td>
                <td><?php echo $row['TotalAmount']; ?></td>
                <td><?php echo $row['Status']; ?></td>
                <td>
                    <?php if ($row['Status'] !== 'Delivered' && $row['Status'] !== 'Cancelled') { ?>
                    <form method="POST">
                        <input type="hidden" name="cancel-order" value="<?php echo $row['OrderID']; ?>">
                        <button type="submit" class="btn">Cancel</button>
                    </form>
                    <?php } ?>
                </td>
                <td>
                    <?php
                    $orderID = $row['OrderID'];
                    $productSql = "SELECT * FROM order_details WHERE OrderID = $orderID";
                    $productResult = $conn->query($productSql);

                    if ($productResult && $productResult->num_rows > 0) {
                        while ($productRow = $productResult->fetch_assoc()) {
                            // Display the product details
                            echo $productRow['ProductName'] . ': ' . $productRow['Quantity'] . '<br>';
                        }
                    }
                    ?>
                </td>
            </tr>
             <?php } ?>
          </tbody>
      </table>
    </div>
    <div id="container10">
      <div id="box101"><img src="/Images/Sugandh logo png.png" alt="" id="box101logo"></div>
      <div id="box102">
        <div class="row">
          <img src="" alt="" class="ficons">
          <div class="fdesc">+91 1234567890</div>
        </div>
        <div class="row">
          <img src="" alt="" class="ficons">
          <div class="fdesc">+91 1234567890</div>
        </div>
      </div>
      <div id="box103">
        <div class="row">
          <img src="" alt="" class="ficons">
          <div class="fdesc">456, Hawa Mahal Road,Pink City,Jaipur - 302002,Rajasthan, India</div>
        </div>
      </div>
      <div id="box104">
        <div class="row">
          <img src="" alt="" class="ficons">
          <img src="" alt="" class="ficons">
          <img src="" alt="" class="ficons">
        </div>
      </div>
    </div>
    <script src="JS/manage_orders.js"></script>
</body>
</html>