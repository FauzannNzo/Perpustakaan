<?php
include 'config/app.php';
include 'config/koneksi.php';
$data_kategori = select("SELECT * FROM kategori");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            align-items: center;
            color: white;
            padding-top: 80px;
        }

        @media (max-width: 768px) {
            .hero-section {
                height: 60vh;
                text-align: center;
            }

            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section p {
                font-size: 1rem;
            }

            .category-card {
                margin-bottom: 1rem;
            }
        }

        .category-card {
            transition: transform 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .category-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #0d6efd;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                background: white;
                padding: 1rem;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin-top: 1rem;
            }

            .search-form {
                display: none !important;
            }

            .nav-link {
                padding: 0.5rem 0 !important;
            }
        }

        .nav-link {
            font-weight: 500;
            color: #2c3e50 !important;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: #3498db !important;
        }

        .nav-link.active {
            color: #3498db !important;
            font-weight: 600;
        }

        .btn-see-all {
            background: linear-gradient(45deg, #3498db, #2980b9);
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-see-all:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3498db !important;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: #2980b9 !important;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <span class="navbar-brand">
                <i class="fas fa-book-open me-2"></i>PERPUSTAKAAN
            </span>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php"><i class="fas fa-home me-1"></i>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kategoriHome.php"><i class="fas fa-book me-1"></i>Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="katalogHome.php"><i class="fas fa-book me-1"></i>Katalog</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-1"></i>Login
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdown">
                            <li><a class="dropdown-item" href="login.php"><i class="fas fa-sign-in-alt me-2"></i>Login</a></li>
                            <li><a class="dropdown-item" href="registrasi.php"><i class="fas fa-user-plus me-2"></i>Register</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Selamat Datang di Perpustakaan Digital</h1>
                    <p class="lead mb-4">Temukan buku favorit Anda dan jelajahi dunia pengetahuan tanpa batas. Akses ribuan koleksi buku digital dengan mudah dan praktis.</p>
                    <a href="login.php" class="btn btn-see-all text-white"><i class="fas fa-sign-in-alt me-2"></i>Login Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5 mt-5" >
        <div class="container">
            <h2 class="fw-bold mb-4">Kategori</h2>
            <div class="row g-4">
                <?php 
                $count = 0;
                foreach ($data_kategori as $kategori): 
                    if ($count >= 3) break;
                ?>
                    <div class="col-md-4">
                        <div class="card category-card shadow-sm h-100">
                            <div class="card-body text-center p-5">
                                <i class="fas fa-book category-icon text-primary"></i>
                                <h4 class="card-title"><?= htmlspecialchars($kategori['nama']) ?></h4>
                                <p class="card-text">Koleksi buku <?= htmlspecialchars($kategori['nama']) ?></p>
                                <a href="katalogHome.php?kategori=<?= urlencode($kategori['nama']) ?>" class="btn btn-outline-primary rounded-pill">Lihat Buku</a>
                            </div>
                        </div>
                    </div>
                <?php 
                    $count++;
                endforeach; 
                ?>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="kategoriHome.php" class="btn btn-see-all text-white">Lihat Semua Kategori</a>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-light" id="tentang">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">Tentang Kami</h2>
                    <p class="lead mb-4">Perpustakaan Digital adalah platform yang menyediakan akses ke ribuan buku digital dari berbagai kategori dan genre.</p>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle text-primary me-2"></i>
                        <p class="mb-0">Menyediakan akses mudah ke berbagai koleksi buku digital</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle text-primary me-2"></i>
                        <p class="mb-0">Mendorong minat baca masyarakat melalui teknologi digital</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle text-primary me-2"></i>
                        <p class="mb-0">Menyediakan platform yang ramah pengguna dan responsif</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="img-fluid rounded shadow" alt="Library">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Keunggulan Kami</h2>
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="text-center">
                        <i class="fas fa-book-reader feature-icon"></i>
                        <h4>Koleksi Lengkap</h4>
                        <p>Ribuan buku digital dari berbagai kategori dan genre</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="text-center">
                        <i class="fas fa-clock feature-icon"></i>
                        <h4>Akses 24/7</h4>
                        <p>Baca kapan saja dan di mana saja tanpa batasan waktu</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="text-center">
                        <i class="fas fa-mobile-alt feature-icon"></i>
                        <h4>Responsif</h4>
                        <p>Akses melalui berbagai perangkat dengan tampilan optimal</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-4 mb-md-0">
                    <h5 class="mb-3">Perpustakaan Digital</h5>
                    <p class="text-muted">Menyediakan akses ke pengetahuan tanpa batas untuk semua kalangan.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <h5 class="mb-3">Hubungi Kami</h5>
                    <p class="text-muted">
                        <i class="fas fa-envelope me-2"></i>info@perpustakaan.com<br>
                        <i class="fas fa-phone me-2"></i>+62 123 4567 890
                    </p>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-muted">&copy; 2025 Perpustakaan Digital. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-muted me-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-muted me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-muted me-3"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function showLoginAlert() {
            alert("Silahkan login terlebih dahulu untuk membuka halaman ini!");
            window.location.href = 'login.php';
        }
    </script>
</body>

</html></html>
