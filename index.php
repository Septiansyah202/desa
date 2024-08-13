<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index_admin.php'); // Redirect to admin dashboard
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Sumberjaya</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
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
    
    <main class="container mt-5">
        <section id="home" class="text-center mb-5">
            <h1 class="display-4">Selamat Datang di Desa Sumberjaya</h1>
            <p class="lead">Desa Sumberjaya adalah desa yang indah dengan masyarakat yang ramah. Di sini, Anda dapat menikmati pemandangan alam yang menakjubkan dan budaya yang kaya.</p>
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
        
    <footer class="bg-success text-white text-center py-3">
        <p>&copy; 2024 Desa Sumberjaya</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
