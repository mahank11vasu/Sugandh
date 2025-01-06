<?php
require_once "db_connect.php";

$category = "Vase";


$sql = "SELECT * FROM products WHERE Category = '$category'";
$result = $conn->query($sql);


$products = array();


if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        $products[] = $product;
    }
} else {
    echo "No products found.";
}

echo json_encode($products);
?>