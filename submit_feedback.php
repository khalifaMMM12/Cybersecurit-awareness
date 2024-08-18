<?php
$host = 'localhost';
$db = 'cybersecurity_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$module_id = $_POST['module_id'];
$rating = $_POST['rating'];
$comments = $_POST['comments'];

$sql = "INSERT INTO feedback (module_id, rating, comments) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $module_id, $rating, $comments);

if ($stmt->execute()) {
    echo "<script>alert('Thank you for your feedback!') window.location.href = 'feedback.php'; </script>;"
} else {
    echo "<script>alert('Error submitting feedback:') window.location.href = 'feedback.php';</script>;" $stmt->error;
}

$stmt->close();
$conn->close();
?>
