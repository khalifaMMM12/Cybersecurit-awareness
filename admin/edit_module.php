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

// Fetch module images
$sql_images = "SELECT * FROM module_images WHERE module_id = ?";
$stmt_images = $conn->prepare($sql_images);
$stmt_images->bind_param("i", $module_id);
$stmt_images->execute();
$result_images = $stmt_images->get_result();

$images = [];
while ($row = $result_images->fetch_assoc()) {
    $images[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Module</h1>
        <form action="update_module_action.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="module_id" value="<?php echo $module['id']; ?>">
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($module['title']); ?>">
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($module['description']); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5"><?php echo htmlspecialchars($module['content']); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="images" class="form-label">Upload New Images</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
            </div>
            
            <div class="mb-3">
                <h5>Existing Images</h5>
                <?php foreach ($images as $image) { ?>
                    <div class="mb-2">
                        <img src="<?php echo $image['image_path']; ?>" alt="Module Image" class="img-fluid" style="max-width: 200px;">
                        <a href="delete_image.php?id=<?php echo $image['id']; ?>&module_id=<?php echo $module['id']; ?>" class="btn btn-danger btn-sm mt-2">Delete</a>
                    </div>
                <?php } ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Module</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
