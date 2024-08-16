<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
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
    <div class="container">
        <header class="py-3">
            <h1 class="text-center">Edit Module</h1>
        </header>

        <main>
            <?php
            // Connect to the database
            $host = 'localhost';
            $db = 'cybersecurity_db';
            $user = 'root';
            $pass = '';

            $conn = new mysqli($host, $user, $pass, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get module ID from URL
            $module_id = $_GET['id'];

            // Fetch the module data
            $sql = "SELECT * FROM modules WHERE id = $module_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $module = $result->fetch_assoc();
            } else {
                echo "Module not found.";
                exit;
            }
            ?>

            <form action="edit_module_action.php?id=<?php echo $module_id; ?>" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Module Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $module['title']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Module Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $module['description']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Module</button>
            </form>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
