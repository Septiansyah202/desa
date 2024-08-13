<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - Desa Sumberjaya</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
        .card-img-top {
            height: 200px; /* Tinggi gambar tetap */
            object-fit: cover; /* Pastikan gambar menutupi area tanpa distorsi */
        }
        
    </style>
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
                        <a class="nav-link" href="index.php">Home</a>
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
                        <a class="nav-link" href="berita.php">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">Admin</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container mt-4">
        <h1 class="mb-4">Berita Terkini</h1>
        <?php
include 'koneksi.php'; // Database connection

// Fetch news items from the database
$result = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card mb-3'>";
        if (!empty($row['image_url'])) {
            echo "<img src='" . htmlspecialchars($row['image_url']) . "' class='card-img-top'>";
        }
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
        // Display only the first 150 characters of the content
        $summary = substr(htmlspecialchars($row['content']), 0, 150) . '...';
        echo "<p class='card-text'>" . nl2br($summary) . "</p>";
        echo "<p class='card-text'><small class='text-muted'>Published on: " . $row['created_at'] . "</small></p>";
        echo "<a href='detail_berita.php?id=" . $row['id'] . "' class='btn btn-primary'>Read More</a> ";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No news items found.</p>";
}
?>
</div>
    </div>
    <footer class="bg-success text-white text-center py-3">
        <p>&copy; 2024 Desa Sumberjaya</p>
    </footer>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>