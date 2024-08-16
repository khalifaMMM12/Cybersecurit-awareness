<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cybersecurity Awareness Modules</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="py-3">
            <h1 class="text-center">Cybersecurity Awareness Modules</h1>
        </header>

        <main>
            <section id="modules">
                <div class="row">
                    <?php
                    // Connect to MySQL database
                    $host = 'localhost';
                    $db = 'cybersecurity_db';
                    $user = 'root';
                    $pass = '';

                    $conn = new mysqli($host, $user, $pass, $db);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch modules
                    $sql = "SELECT * FROM modules";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-md-4">';
                            echo '<div class="card mb-4">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $row['title'] . '</h5>';
                            echo '<p class="card-text">' . $row['description'] . '</p>';
                            echo '<a href="module.php?id=' . $row['id'] . '" class="btn btn-primary">Learn More</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No modules found.</p>';
                    }

                    $conn->close();
                    ?>
                </div>
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
