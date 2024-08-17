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
$content = $_POST['content'];
$image_path = '';

// Check if an image was uploaded
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = 'uploads/' . $image_name;

    // Move the uploaded file to the 'uploads' folder
    move_uploaded_file($image_tmp, $image_path);
}

// Insert the module into the database
$sql = "INSERT INTO modules (title, description, content, image_path) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $title, $description, $content, $image_path);

if ($stmt->execute()) {
    header("Location: index.php?message=Module added successfully");
} else {
    echo "Error adding module: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
