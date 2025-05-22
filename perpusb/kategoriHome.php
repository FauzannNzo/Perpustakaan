<?php
include "config/koneksi.php";
include "config/app.php";
$data_kategori = select("SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Buku - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 40vh;
            display: flex;
            align-items: center;
            color: white;
            margin-top: 70px;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3498db !important;
        }

        .navbar-brand:hover {
            color: #2980b9 !important;
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

        .search-form {
            position: relative;
            margin-right: 1rem;
        }

        .search-input {
            border: none;
            background: rgba(0, 0, 0, 0.05);
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border-radius: 25px;
            width: 250px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
            background: rgba(0, 0, 0, 0.08);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
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
                margin: 1rem auto;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                position: relative;
            }

            .search-input {
                width: 100%;
                max-width: 300px;
                margin: 0 auto;
                padding-left: 2.5rem;
            }

            .search-icon {
                left: 50%;
                transform: translateX(-150px) translateY(-50%);
            }

            .nav-link {
                padding: 0.5rem 0 !important;
            }
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
                        <a class="nav-link" href="home.php"><i class="fas fa-home me-1"></i>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="kategoriHome.php"><i class="fas fa-book me-1"></i>Kategori</a>
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
                    <h1 class="display-4 fw-bold mb-4">Kategori Buku</h1>
                    <p class="lead">Temukan buku berdasarkan kategori yang Anda minati</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <?php foreach ($data_kategori as $kategori): ?>
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
                <?php endforeach; ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>