<?php
require_once "db_connect.php";

// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');
$productQuantities = json_decode($jsonData, true);

// Retrieve the logged-in user's email from the session variable
session_start();
$userEmail = $_SESSION['email'];

$sql = "SELECT id FROM users WHERE email = '$userEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userID = $row['id'];

    // Iterate over the productQuantities array
    foreach ($productQuantities as $item) {
        $productID = $item['productID'];
        $quantity = $item['quantity'];

        $sql = "SELECT Image, Name, Description, Price FROM products WHERE ProductID = '$productID'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $image = $row['Image'];
            $name = $row['Name'];
            $description = $row['Description'];
            $price = $row['Price'];

            $sql = "INSERT INTO cart (UserID, ProductID, PName, Quantity, Price, Image) VALUES ('$userID', '$productID', '$name', '$quantity', $price, '$image')";
            if ($conn->query($sql) === TRUE) {
                echo "Product added to cart successfully.";
            } else {
                echo "Error adding product to cart: " . $conn->error;
            }
        } else {
            echo "Product not found.";
        }
    }
} else {
    echo "User not found.";
}

$conn->close();
?>
