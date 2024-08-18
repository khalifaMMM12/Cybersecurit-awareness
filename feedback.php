<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Cybersecurity Awareness</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Admin</a>
                        </li>
                        <li>
                            <p class="text-white">We Value Your Feedback</p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

        <main>
            <?php
            // Get the module ID from the URL
            $module_id = $_GET['module_id'];
            ?>

            <form action="submit_feedback.php" method="POST">
                <input type="hidden" name="module_id" value="<?php echo $module_id; ?>">
                
                <div class="mb-3">
                    <label for="rating" class="form-label">Rate this module (1 to 5):</label>
                    <select class="form-select" id="rating" name="rating" required>
                        <option value="">Select a rating</option>
                        <option value="1">1 - Poor</option>
                        <option value="2">2 - Fair</option>
                        <option value="3">3 - Good</option>
                        <option value="4">4 - Very Good</option>
                        <option value="5">5 - Excellent</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="comments" class="form-label">Your Comments:</label>
                    <textarea class="form-control" id="comments" name="comments" rows="4" placeholder="Tell us about your experience..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
