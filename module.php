<?php
$host = 'localhost';
$db = 'cybersecurity_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the module ID from the URL
$module_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch module data from the database
$sql = "SELECT * FROM modules WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $module_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $module = $result->fetch_assoc();
} else {
    echo "Module not found.";
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $module['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo $module['title']; ?></h1>

        <!-- Display the Image if available -->
        <?php
        if (!empty($module['image_path'])) {
            echo '<img src="' . $module['image_path'] . '" alt="Module Image" class="img-fluid mb-4">';
        } else {
            echo "No image available.";
        }
        ?>
        
        <div class="content">
            <?php echo nl2br($module['content']); ?>
        </div>

        <!-- Feedback Button -->
        <div class="mt-5">
            <a href="feedback.php?module_id=<?php echo $module_id; ?>" class="btn btn-primary">Give Feedback</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
