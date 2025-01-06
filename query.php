<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $name = $_POST['name'];
  $phone = $_POST['number'];
  $email = $_POST['email'];

  // Prepare email content
  $to = 'visit@sugandh.shop'; // Replace with your own email address
  $subject = "New Query";
  $message = "Name: $name\n";
  $message .= "Phone Number: $phone\n";
  $message .= "Email: $email\n";

  // Send email
  if (mail($to, $subject, $message)) {
    echo '<script>alert("Your query has been submitted. We will get back to you soon.");</script>';
    header("Location: index.php");
    exit();
  } else {
    echo '<script>alert("Failed to submit the query. Please try again later.");</script>';
    header("Location: index.php");
    exit();
  }
}
?>