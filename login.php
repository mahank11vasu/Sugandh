<?php
session_start();
require_once "db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    // Validate
    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
        echo '<script>alert("' . $error . '");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if ($row['email'] === 'visit@sugandh.shop') {
                // Admin 
                $_SESSION['email'] = $email;
                $_SESSION['isAdmin'] = true;
                $_SESSION['flag'] = 1; // flag for admin user
                echo '<script>alert("Login successful! As Admin!!");</script>';
                echo '<script>window.location.href = "admin.php";</script>';
                exit();
            } else {
                // Non-admin 
                $_SESSION['email'] = $email;
                $_SESSION['isAdmin'] = false;
                $_SESSION['flag'] = 2; // flag for non-admin user
                echo '<script>alert("Login successful!");</script>';
                echo '<script>window.location.href = "index.php";</script>';
                exit();
            }
        } else {
            $error = "Invalid email or password.";
            echo '<script>alert("' . $error . '");</script>';
            echo '<script>window.location.href = "index.php";</script>';
            exit();
        }
    }
}
?>
