<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'visit@sugandh.shop') {
    header('Location: index.php');
    exit();
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Delete User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete-user'])) {
    $userId = $_POST['delete-user'];

    // Perform the deletion
    $deleteSql = "DELETE FROM users WHERE id = $userId";
    $conn->query($deleteSql);
}

// Block User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['block-user'])) {
    $userId = $_POST['block-user'];

    // Perform the update
    $blockSql = "UPDATE users SET status = 'Blocked' WHERE id = $userId";
    $conn->query($blockSql);
}

// Export User Data as CSV
if (isset($_POST['export-users'])) {
    $filename = "user_data.csv";
    $delimiter = ",";

    $output = fopen('php://output', 'w');

    // Fetch user data
    $data = [];
    $data[] = array('ID', 'Name', 'Email', 'Phone', 'DOB', 'Address');

    $usersSql = "SELECT id, name, email, phone, dob, address FROM users";
    $usersResult = $conn->query($usersSql);

    while ($row = $usersResult->fetch_assoc()) {
        $data[] = $row;
    }

    // Write data to CSV file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    foreach ($data as $row) {
        fputcsv($output, $row, $delimiter);
    }

    fclose($output);
    exit();
}

$productsSql = "SELECT * FROM products";
$productsResult = $conn->query($productsSql);

// Add or modify product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save-product'])) {
    $productId = $_POST['product-id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $availableStock = $_POST['available-stock'];
    $season = $_POST['season'];
    $size = $_POST['size'];
    $customizable = isset($_POST['customizable']) ? 1 : 0;
    $color = $_POST['color'];
    
    // Handle image upload
    $targetDir = 'PImages/';
    $targetFile = $targetDir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if a valid image
    if (getimagesize($_FILES['image']['tmp_name'])) {
        // Move the uploaded file to the target directory
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

        $image = $targetFile;

        if (empty($productId)) {
            // new product
            $insertSql = "INSERT INTO products (Name, Category, Description, Price, AvailableStock, Season, Size, Customizable, Color, Image) VALUES ('$name', '$category', '$description', $price, $availableStock, '$season', '$size', $customizable, '$color', '$image')";
            $conn->query($insertSql);
        } else {
            // existing product
            $updateSql = "UPDATE products SET Name = '$name', Category = '$category', Description = '$description', Price = $price, AvailableStock = $availableStock, Season = '$season', Size = '$size', Customizable = $customizable, Color = '$color', Image = '$image' WHERE ProductID = $productId";
            $conn->query($updateSql);
        }

        header('Location: admin.php?page=products');
        exit();
    } else {
        // Invalid image file uploaded
        echo "Invalid image file.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete-product'])) {
    $productId = $_POST['delete-product'];

    $deleteSql = "DELETE FROM products WHERE ProductID = $productId";
    $conn->query($deleteSql);
}


$ordersSql = "SELECT * FROM orders";
$ordersResult = $conn->query($ordersSql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-status']) && isset($_POST['order-id'])) {
    $status = $_POST['update-status'];
    $orderId = $_POST['order-id'];

    $updateSql = "UPDATE orders SET Status = '$status' WHERE OrderID = $orderId";
    $conn->query($updateSql);
    $emailSql = "SELECT u.id, u.email, o.*
             FROM orders o
             INNER JOIN users u ON o.UserID = u.id
             WHERE o.OrderID = $orderId";
    $emailResult = $conn->query($emailSql);
    if ($emailResult && $emailResult->num_rows > 0) {
        $row = $emailResult->fetch_assoc();
        $email = $row['email'];
        $name = $row['Name'];
        $details = $row['Details'];
        $totalAmount = $row['TotalAmount'];

        $to = $email;
        $subject = "Order Update - $status";
        $message = "Dear $name,\n\nYour order has been updated to: $status\n\nOrder Details:\n\n";
        $message .= "Product Details: $details\n";
        $message .= "Total Amount: $totalAmount\n";
        $message .= "\n\nThank you for choosing our service!";
        $headers = "From: visit@sugandh.shop";

        if (mail($to, $subject, $message, $headers)) {
            // Redirect the user to a success page
            echo '<script>alert("Order updated successfully. An email notification has been sent to the customer.");</script>';
            header('Location: admin.php?page=orders');
            exit();
        } else {
            // Handle email sending failure
            $error = "Error sending email. Please try again later.";
            echo "<script>alert('$error');</script>";
        }
    
    }
}

?>



<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<script>
    // Function to confirm user deletion
    function confirmDelete(userId) {
        if (confirm("Are you sure you want to delete this user?")) {
            document.getElementById('delete-user-form-' + userId).submit();
        }
    }

    // Function to confirm user blocking
    function confirmBlock(userId) {
        if (confirm("Are you sure you want to block this user?")) {
            document.getElementById('block-user-form-' + userId).submit();
        }
    }

    // Function to confirm product deletion
    function confirmDeleteProduct(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            document.getElementById('delete-product-form-' + productId).submit();
        }
    }

    // Function to set product details for modification
    function modifyProduct(productId, name, category, description, price, availableStock, season, size, customizable) {
        document.getElementById('product-id').value = productId;
        document.getElementById('name').value = name;
        document.getElementById('category').value = category;
        document.getElementById('description').value = description;
        document.getElementById('price').value = price;
        document.getElementById('available-stock').value = availableStock;
        document.getElementById('season').value = season;
        document.getElementById('size').value = size;
        document.getElementById('customizable').checked = customizable;
        document.getElementById('color').value = color;
        document.getElementById('save-product').innerText = 'Update';
    }
    
</script>

<body>
    <div class="container">
        <div id="navbar">
            <div id="navflex">
                <div><a href="admin.php" class="navitems">Dashboard</a></div>
                <div><a href="?page=users" class="navitems">Users</a></div>
                <div><a href="?page=products" class="navitems">Products</a></div>
                <div><a href="?page=orders" class="navitems">Orders</a></div>
                <div><a class="logout navitems" href="logout.php">Logout</a></div>
            </div>
        </div>
               <?php
               // Check if the "Users" option is clicked
               if (isset($_GET['page']) && $_GET['page'] === 'users') {
               ?>
           <div id="content1">
            <div id="contentflex1">
                   <div class="head1">Welcome, Admin!</div>
                   <div class="head2">Registered Users</div>
                   <div>
                        <table>
                            <thead>
                              <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>DOB</th>
                              <th>Address</th>
                              <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                               <?php while ($row = $result->fetch_assoc()) { ?>
                               <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['dob']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td class="action-buttons">
                                    <button onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
                                    <button onclick="confirmBlock(<?php echo $row['id']; ?>)">Block</button>
                                </td>
                               </tr>
                               <form id="delete-user-form-<?php echo $row['id']; ?>" method="POST" style="display: none;">
                                 <input type="hidden" name="delete-user" value="<?php echo $row['id']; ?>">
                               </form>
                               <form id="block-user-form-<?php echo $row['id']; ?>" method="POST" style="display: none;">
                                <input type="hidden" name="block-user" value="<?php echo $row['id']; ?>">
                               </form>
                               <?php } ?>
                            </tbody>
                        </table>
                    </div>    

                <form method="POST">
                    <button type="submit" name="export-users" id="export-users">Export Users Data</button>
                </form>
            </div>    
            </div>    
                
                
                <?php } elseif (isset($_GET['page']) && $_GET['page'] === 'products') { ?>
        <div id="content2">
            <div id="contentflex2">
                <div class="head1">Welcome, Admin!</div>
                <div class="head2">Manage Your Products</div>
                <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Available Stock</th>
                            <th>Season</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Customizable</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $productsResult->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['ProductID']; ?></td>
                                <td><?php echo $row['Name']; ?></td>
                                <td><?php echo $row['Category']; ?></td>
                                <td><?php echo $row['Description']; ?></td>
                                <td><?php echo $row['Price']; ?></td>
                                <td><?php echo $row['AvailableStock']; ?></td>
                                <td><?php echo $row['Season']; ?></td>
                                <td><?php echo $row['Size']; ?></td>
                                <td><?php echo $row['Color']; ?></td>
                                <td><?php echo $row['Customizable'] ? 'Yes' : 'No'; ?></td>
                                <td class="action-buttons">
                                    <button onclick="modifyProduct(<?php echo $row['ProductID']; ?>, '<?php echo $row['Name']; ?>', '<?php echo $row['Category']; ?>', '<?php echo $row['Description']; ?>', <?php echo $row['Price']; ?>, <?php echo $row['AvailableStock']; ?>, '<?php echo $row['Season']; ?>', '<?php echo $row['Size']; ?>', '<?php echo $row['Color']; ?>', <?php echo $row['Customizable']; ?>)">Edit</button>
                                    <button onclick="confirmDeleteProduct(<?php echo $row['ProductID']; ?>)">Delete</button>
                                </td>
                            </tr>
                            <form id="delete-product-form-<?php echo $row['ProductID']; ?>" method="POST" style="display: none;">
                                <input type="hidden" name="delete-product" value="<?php echo $row['ProductID']; ?>">
                            </form>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
                <div>
                <h3 class="head4">You can add/edit your products from below:</h3>
                <form method="POST" enctype="multipart/form-data" id="formflex">
                    <div id="rowsflex">
                      <div id="row1">
                          <input type="hidden" id="product-id" name="product-id" value="">
                          <label class="labels">Name:</label>
                          <input type="text" id="name" name="name" class="fields" required>
                          <label class="labels">Category:</label>
                          <select id="category" name="category" class="format" required>
                            <option value="Flower">Flower</option>
                            <option value="Vase">Vase</option>
                            <option value="Pre-Made Bouquet">Pre-Made Bouquet</option>
                          </select>
                          <label class="labels">Season:</label>
                          <select id="season" name="season" class="format"  required>
                            <option value="NULL">None</option>
                            <option value="Summer">Summer</option>
                            <option value="Winter">Winter</option>
                            <option value="Spring">Spring</option>
                            <option value="Autumn">Autumn</option>
                          </select>
                          <label class="labels">Size:</label>
                          <select id="size" name="size" class="format"  required>
                           <option value="NULL">None</option>
                           <option value="Big">Big</option>
                           <option value="Medium">Medium</option>
                           <option value="Small">Small</option>
                         </select>
                         <label class="labels">Color:</label>
                         <select id="color" name="color" class="format"  required>
                          <option value="NULL">None</option>
                          <option value="Red">Red</option>
                          <option value="White">White</option>
                          <option value="Pink">Pink</option>
                          <option value="Yellow">Yellow</option>
                         </select>
                      </div>
                      <div id="row2">
                         <label class="labels">Description:</label>
                         <textarea id="description" name="description" required></textarea>
                          <label class="labels">Price:</label>
                          <input type="number" id="price" name="price" class="fields" required>
                          <label class="labels">Available Stock:</label>
                          <input type="number" id="available-stock" name="available-stock" class="fields" required>
                          <label class="containercheck labels">Customizable
                               <input type="checkbox" id="customizable" name="customizable">
                               <span class="checkmark"></span>
                           </label>
                          <label class="labels">Image:</label>
                           <input type="file" name="image" id="image" required>
                      </div>
                    </div>
                    <button type="submit" name="save-product" id="save-product">Save</button>
                </form>
                </div>
            </div>
        </div>
                
                
        
        <?php } elseif (isset($_GET['page']) && $_GET['page'] === 'orders') { ?>
     <div id="content4">
        <div id="contentflex4">
            <div class="head1">Order Management</div>
            <table id="orders">
             <thead>
              <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Shipping Address</th>
                <th>Status</th>
                <th>Details</th>
                <th>Payment Method</th>
                <th>Recipient Name</th>
                <th>Recipient Phone</th>
              </tr>
             </thead>
             <tbody>
             <?php while ($row = $ordersResult->fetch_assoc()) { ?>
             <tr id="tr">
              <td><?php echo $row['OrderID']; ?></td>
              <td><?php echo $row['UserID']; ?></td>
              <td><?php echo $row['OrderDate']; ?></td>
              <td><?php echo $row['TotalAmount']; ?></td>
              <td><?php echo $row['ShippingAddress']; ?></td>
              <td>
                <form method="POST">
                    <select name="update-status" id="status">
                        <option value="Pending" <?php echo $row['Status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="Processing" <?php echo $row['Status'] === 'Processing' ? 'selected' : ''; ?>>Processing</option>
                        <option value="Shipped" <?php echo $row['Status'] === 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                        <option value="Delivered" <?php echo $row['Status'] === 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                        <option value="Cancelled" <?php echo $row['Status'] === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                    <input type="hidden" name="order-id" value="<?php echo $row['OrderID']; ?>">
                    <button type="submit" id="update">Update</button>
                </form>
              </td>
              <td>
                <?php
                    // Fetch product details for the current order from order_details table
                    $orderID = $row['OrderID'];
                    $productSql = "SELECT * FROM order_details WHERE OrderID = $orderID";
                    $productResult = $conn->query($productSql);

                    if ($productResult && $productResult->num_rows > 0) {
                        while ($productRow = $productResult->fetch_assoc()) {
                            // Display product name, quantity, and price
                            echo $productRow['ProductName'] . '<br>';
                            echo 'Quantity: ' . $productRow['Quantity'] . '<br>';
                            echo 'Price: ' . $productRow['Price'] . '<br>';
                        }
                    }
                ?>
              </td>
              <td><?php echo $row['PaymentMethod']; ?></td>
              <td><?php echo $row['RecipientName']; ?></td>
              <td><?php echo $row['RecipientPhone']; ?></td>
              </tr>
              <?php } ?>
             </tbody>
            </table>
       </div>
    </div>
<?php } else { ?>
        <div id="content3">
            <div id="contentflex3">
                    <div class="head1">Welcome, Admin!</div>
                    <div class="head3">Welcome to your Sugandh's admin panel dashboard! We are here to help you manage your online presence and make your business bloom. You can find differernt options here that will assist you in effectively running your Sugandh's website.</div>
                    </div>
                    </div>
            <?php } ?>
        </div>
        </div>
    </div>
</body>
</html>
