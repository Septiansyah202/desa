<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Handle file uploads
    $target_dir = "uploads/";
    $image_path = "";
    $video_path = "";

    $uploadOk = 1;

    // Handle image upload
    if (!empty($_FILES["image"]["name"])) {
        $image_path = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your image file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedImageTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedImageTypes)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed for images.<br>";
            $uploadOk = 0;
        }

        // Attempt to upload file
        if ($uploadOk == 1) {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
                echo "Sorry, there was an error uploading your image.<br>";
                $uploadOk = 0;
            }
        }
    }

    // Handle video upload
    if (!empty($_FILES["video"]["name"])) {
        $video_path = $target_dir . basename($_FILES["video"]["name"]);
        $videoFileType = strtolower(pathinfo($video_path, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["video"]["size"] > 10000000) {
            echo "Sorry, your video file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedVideoTypes = ["mp4", "avi", "mov"];
        if (!in_array($videoFileType, $allowedVideoTypes)) {
            echo "Sorry, only MP4, AVI, & MOV files are allowed for videos.<br>";
            $uploadOk = 0;
        }

        // Attempt to upload file
        if ($uploadOk == 1) {
            if (!move_uploaded_file($_FILES["video"]["tmp_name"], $video_path)) {
                echo "Sorry, there was an error uploading your video.<br>";
                $uploadOk = 0;
            }
        }
    }

    // Only insert into database if uploads are successful
    if ($uploadOk == 1) {
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $sql = "INSERT INTO news (title, content, image_path, video_path, created_at) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing SQL statement: " . $conn->error);
        }

        $stmt->bind_param("ssss", $title, $content, $image_path, $video_path);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Sorry, your file was not uploaded.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News - Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <a class="navbar-brand" href="#">Desa Sumberjaya</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index_admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#struktur">Struktur Desa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#alamat">Alamat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#visi-misi">Visi & Misi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambahberita.php">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container mt-5">
        <h2 class="mb-4">Add News</h2>
        <form action="tambahberita.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image (JPG, JPEG, PNG, GIF only)</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="video">Video (MP4, AVI, MOV only)</label>
                <input type="file" class="form-control-file" id="video" name="video">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container">
    <h1 class="my-4">News</h1>
    <?php
    include 'koneksi.php'; // Database connection

    // Fetch news items from the database
    $result = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='news-item my-3'>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo "<small>Published on: " . $row['created_at'] . "</small>";
            // Admin delete link (visible only to admins)
            echo "<p><a href='delete_news.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this news item?\");'>Delete</a></p>";
            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "<p>No news items found.</p>";
    }
    ?>
</div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
