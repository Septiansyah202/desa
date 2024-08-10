<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Desa Sumberjaya</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
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
                        <a class="nav-link" href="#home">Home</a>
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
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <main class="container mt-5">
        <section id="home" class="text-center mb-5">
            <h1 class="display-4">Selamat Datang di Dashboard Admin</h1>
            <p class="lead">Kelola berita dan informasi Desa Sumberjaya dengan mudah melalui dashboard ini.</p>
        </section>

        <section id="struktur" class="mb-5">
            <h2 class="mb-4">Struktur Desa</h2>
            <img src="img/contoh.jfif" alt="Struktur Organisasi Desa Sumberjaya" class="img-fluid">
        </section>

        <section id="alamat" class="mb-5">
            <h2 class="mb-4">Alamat Desa</h2>
            <p>Jalan Raya Sumberjaya No. 123, Kecamatan Sumberjaya, Kabupaten [Nama Kabupaten], Provinsi [Nama Provinsi], Indonesia.</p>
        </section>

        <section id="visi-misi" class="mb-5">
            <h2 class="mb-4">Visi & Misi</h2>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Visi</h3>
                    <p class="card-text">Menjadikan Desa Sumberjaya sebagai desa mandiri, sejahtera, dan berbudaya melalui pengembangan potensi lokal.</p>
                    <h3 class="card-title">Misi</h3>
                    <ul>
                        <li>Meningkatkan kualitas pendidikan dan kesehatan masyarakat.</li>
                        <li>Mendorong pertumbuhan ekonomi berbasis potensi lokal.</li>
                        <li>Memperkuat kearifan lokal dan budaya.</li>
                        <li>Meningkatkan infrastruktur dan pelayanan publik.</li>
                    </ul>
                </div>
            </div>
        </section>
        
        <section id="berita">
            <h2 class="mb-4">Berita Terkini</h2>
            <a href="admin_add_news.html" class="btn btn-primary mb-3">Add News</a>
            <?php
            include 'koneksi.php'; // Database connection

            // Fetch news items from the database
            $result = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='card mb-3'>";
                    echo "<div class='card-body'>";
                    echo "<h3 class='card-title'>" . htmlspecialchars($row['title']) . "</h3>";
                    echo "<p class='card-text'>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
                    echo "<small>Published on: " . $row['created_at'] . "</small>";
                    echo "<p>";
                    echo "<a href='edit_news.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a> ";
                    echo "<a href='delete_news.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this news item?\");'>Delete</a>";
                    echo "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No news items found.</p>";
            }
            ?>
        </section>
    </main>

    <footer class="bg-success text-white text-center py-3">
        <p>&copy; 2024 Desa Sumberjaya</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
