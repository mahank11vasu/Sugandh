<?php
require_once "db_connect.php";

// Create the "users" table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    dob DATE NOT NULL,
    address VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    // Table created successfully
} else {
    // Error creating table
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['register-username'];
    $email = $_POST['register-email'];
    $phone = $_POST['register-phone'];
    $dob = $_POST['register-dob'];
    $address = $_POST['register-add'];
    $password = $_POST['register-password'];
    $confirmPassword = $_POST['register-confirm-password'];

    // Validate the input fields
    $errors = [];

    if (empty($name) || empty($email) || empty($phone) || empty($dob) || empty($address) || empty($password) || empty($confirmPassword) || empty($dob)) {
        $errors[] = "All fields are required.";
        echo "<script>alert('" . implode("<br>", $errors) . "');</script>";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
        echo "<script>alert('" . implode("<br>", $errors) . "');</script>";
    }

    if (count($errors) === 0) {
        $sql = "INSERT INTO users (name, email, phone, dob, address, password) VALUES ('$name', '$email', '$phone', '$dob', '$address', '$password')";

        if ($conn->query($sql) === TRUE) {
           //send email to the user
            $to = $email;
            $subject = "Registration Successful";
            $message = "Dear $name,\n\nThank you for registering on Sugandh!\n\nYour registration was successful.";
            $headers = "From: visit@sugandh.shop";

            if (mail($to, $subject, $message, $headers)) {
                echo '<script>alert("Registration Successful! Please log in using your email and password.");</script>';
                echo '<script>window.location.href = "index.php";</script>';
            } else {
                $error = "Error sending email.";
                echo "<script>alert('$error');</script>"; 
            }
        } else {
            // Handle registration failure
            $error = "Error: " . $sql . "<br>" . $conn->error;
            echo "<script>alert('$error');</script>";
            echo '<script>window.location.href = "index.php";</script>';
        }
    } else {
        // Handle validation errors
        $error = implode("<br>", $errors);
        echo "<script>alert('$error');</script>";
        echo '<script>window.location.href = "index.php";</script>';
    }
}
?>
