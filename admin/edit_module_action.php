<?php
session_start();

$host = 'localhost';
$db = 'cybersecurity_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$module_id = $_GET['id'];
$title = $_POST['title'];
$description = $_POST['description'];

$sql = "UPDATE modules SET title = '$title', description = '$description' WHERE id = $module_id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Module updated successfully!";
} else {
    $_SESSION['error'] = "Error updating module: " . $conn->error;
}

$conn->close();
header("Location: index.php");
?>
