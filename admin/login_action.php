<?php
session_start();

// Predefined credentials
$admin_username = "admin";
$admin_password = "password123"; 

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == $admin_username && $password == $admin_password) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: index.php");
} else {
    echo "Invalid credentials";
}
?>
