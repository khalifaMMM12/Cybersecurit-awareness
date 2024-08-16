<?php
session_start();

// Predefined credentials with hashed password
$admin_username = "admin";
$admin_password_hash = password_hash("password123", PASSWORD_DEFAULT);  

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == $admin_username && password_verify($password, $admin_password_hash)) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: index.php");
} else {
    echo "Invalid credentials";
}
?>
