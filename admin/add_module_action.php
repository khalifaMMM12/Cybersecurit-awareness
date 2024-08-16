<?php
$host = 'localhost';
$db = 'cybersecurity_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$description = $_POST['description'];

$sql = "INSERT INTO modules (title, description) VALUES ('$title', '$description')";

if ($conn->query($sql) === TRUE) {
    echo "New module added successfully";
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
