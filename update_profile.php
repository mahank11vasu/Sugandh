<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION['email'])) {
  header('Location: index.php');
  exit();
}

// Retrieve the updated profile information from the form submission
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$dob = $_POST['dob'];
$address = $_POST['address'];

$email = $_SESSION['email'];
$sql = "UPDATE users SET name='$name', phone='$phone', email='$email', password='$password', dob='$dob', address='$address' WHERE email='$email'";

if ($conn->query($sql) === TRUE) {
  echo '<script>alert("Profile updated successfully."); window.location.href = "profile.php";</script>';
  exit();
} else {
  echo '<script>alert("Error updating profile. Please try again."); window.location.href = "profile.php";</script>';
  exit();
}
?>
