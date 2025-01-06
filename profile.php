  <?php
  session_start();
  require_once "db_connect.php";

  if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
  }

  
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $name = $row['name'];
    $phone = $row['phone'];
    $dob = $row['dob'];
    $address = $row['address'];
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link rel="stylesheet" href="/CSS/profile.css">
</head>
<body>
    <div id="container1" class="your-class">
      <div id="nav">
        <div id="logo">
          <img src="/Images/Sugandh logo png.png" id="logoimg" alt="" />
        </div>
        <div id="navitems">
          <div class="navitemstxt">Home</div>
          <div id="forarrow">
            <div class="navitemstxt" id="orders">Shop</div>
            <div id="arrow"></div>
          </div>
          <div class="navitemstxt"><a href="/about.html">About Us</a></div>
          <div class="navitemstxt">Contact Us</div>
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
        <div id="head1">Hello, you can manage your profile here! </div>

      <form action="update_profile.php" method="post" onsubmit="return validateForm()" id="formflex">
    <div id="rowsflex">
    <div id="row1">
     <label for="name" class="labels">Name:</label>
     <input type="text" id="name" class="fields"  name="name" value="<?php echo $name; ?>">

    <label for="phone" class="labels">Phone Number:</label>
    <input type="text" id="phone" class="fields"  name="phone" value="<?php echo $phone; ?>">

    <label for="email" class="labels">Email:</label>
    <input type="email" id="email" class="fields"  name="email" value="<?php echo $email; ?>">
    
   </div>
   <div id="row2">
    <label for="password" class="labels">Password:</label>
    <input type="password" id="password" class="fields"  name="password">

    <label for="dob" class="labels">Date of Birth:</label>
    <input type="date" id="dob" name="dob" class="fields"  value="<?php echo $dob; ?>">

    <label for="address" class="labels">Address:</label>
    <textarea id="address" name="address"><?php echo $address; ?></textarea>
    </div>
    </div>
    <button type="submit" id="Update">Update Profile</button>
  </form>

</div>
  <script>
  function validateForm() {
    // Get form field values
    var name = document.getElementById("name").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    // Perform validation checks
    if (name === "") {
      alert("Please enter your name.");
      return false;
    }
    if (phone === "") {
      alert("Please enter your phone number.");
      return false;
    }
    if (email === "") {
      alert("Please enter your email.");
      return false;
    }
    if (password === "") {
      alert("Please enter your password.");
      return false;
    }
    // Add additional validation checks if needed
    // ...
    return true; // Submit the form if all validations pass
  }
  </script>
  <script src="JS/profile.js"></script>
</body>
</html>
