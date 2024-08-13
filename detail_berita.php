<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            max-width: 500px; /* Mengatur lebar maksimum kartu */
            margin: auto; /* Pusatkan kartu */
        }
        .card-img-top {
            height: 200px; /* Tinggi gambar tetap */
            object-fit: cover; /* Pastikan gambar menutupi area tanpa distorsi */
            margin-top: 20px; /* Tambahkan margin atas */
        }
        .card-body {
            padding: 10px; /* Padding lebih kecil untuk tampilan yang lebih ringkas */
        }
        .news-title {
            font-weight: bold; /* Membuat teks judul tebal */
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <?php
    include 'koneksi.php'; // Include your database connection

    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    // Fetch the news item from the database
    $sql = "SELECT * FROM news WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        echo "<h1>" . htmlspecialchars($row['title']) . "</h1>";
        if (!empty($row['image_path'])) {
            echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='News Image' style='max-width:100%;height:auto;'>";
        }
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
        if (!empty($row['video_path'])) {
            echo "<video controls style='max-width:100%;height:auto;'>
                    <source src='" . htmlspecialchars($row['video_path']) . "' type='video/mp4'>
                    Your browser does not support the video tag.
                  </video>";
        }
        // Add a Back button
        echo "<button onclick='history.back()' class='btn btn-secondary mt-3'>Kembali</button>";
    } else {
        echo "News item not found.";
    }
    $stmt->close();
    $conn->close();
    ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>