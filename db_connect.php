<?php
// db details
$servername = "localhost";
$username = "u646572949_sugandh01"; 
$password = "Jodhpur@123"; 
$dbname = "u646572949_sugandh"; 

// db connection 
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
