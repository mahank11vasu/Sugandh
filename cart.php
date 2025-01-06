<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION['email'])) {
  header('Location: index.php');
  exit();
}

$userEmail = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete-product'])) {
    $productId = $_POST['delete-product'];
    $deleteSql = "DELETE FROM cart WHERE ProductID = $productId";
    $conn->query($deleteSql);
}

$sql = "SELECT id FROM users WHERE email = '$userEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $userID = $row['id'];

  $sql = "SELECT * FROM cart WHERE UserID = '$userID'";
  $result = $conn->query($sql);

  // empty array to store the cart data
  $cartData = array();

  if ($result->num_rows > 0) {
    // Iterate over the cart data and store each row in the array
    while ($row = $result->fetch_assoc()) {
      $cartData[] = $row;
    }
  }
  
  $totalAmount = 0; 
  foreach ($cartData as $row) {
    $totalAmount += $row['Price'] * $row['Quantity']; 
  }

  $gstAmount = $totalAmount * 0.18; 
  $finalTotal = $totalAmount + $gstAmount; 
}

$_SESSION['cartData'] = $cartData;
$_SESSION['totalAmount'] = $totalAmount;
$_SESSION['gstAmount'] = $gstAmount;
$_SESSION['finalTotal'] = $finalTotal;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link rel="stylesheet" href="/CSS/cart.css">
  <script>
    function confirmDelete(productId) {
      if (confirm("Are you sure you want to remove this item from the cart?")) 
      {
        document.getElementById('delete-item-form-' + productId).submit();
      }
    }
  </script>
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
          <div class="navitemstxt"><a href="/contact.php">About Us</a>Contact Us</div>
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
            <a href="/vase.php">Vases</a>
          </div>
          <div id="predefinedorder" class="itemorder">
            <a href="/premade.php">Pre-made Bouquets</a>
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
        <table>
            <thead>
                <tr id="heads">
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartData as $row) { ?>
                <tr>
                    <td><?php echo $row['PName']; ?></td>
                    <td><?php echo $row['Quantity']; ?></td>
                    <td><?php echo $row['Price']; ?></td>
                    <td><img src="<?php echo $row['Image']; ?>" alt="Product Image" class="product-image"></td>
                    <td>
                        <button onclick="confirmDelete(<?php echo $row['ProductID']; ?>)" class="btn">Remove</button>
                        <form id="delete-item-form-<?php echo $row['ProductID']; ?>" method="POST" style="display: none;">
                            <input type="hidden" name="delete-product" value="<?php echo $row['ProductID']; ?>">
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
    <div id="con2box2">
      <div id="total">
          <div class="data">Products Total Amount: <?php echo number_format($totalAmount, 2); ?></div>
          <div class="data">GST (18%): <?php echo number_format($gstAmount, 2); ?></div>
          <div class="data">Amount To Pay: <?php echo number_format($finalTotal, 2); ?></div>
      </div>
      <div id="order">
        <form method="POST" action="order.php">
            <button id="placeorder" class="btn">Place Order</button>
        </form>
      </div>
    </div>
    
  </div>
<script src="JS/cart.js"></script>
</body>
</html>
