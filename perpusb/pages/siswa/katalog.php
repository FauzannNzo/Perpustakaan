<?php
include '../../config/controller.php';
include '../../cek_session/cek_siswa.php';

$data_kategori = select("SELECT * FROM kategori");

// Inisialisasi array untuk menyimpan kategori yang dipilih
$selected_categories = [];

// Handle filter dari POST (checkbox)
if (isset($_POST['kategori'])) {
    $selected_categories = $_POST['kategori'];
    if (!empty($selected_categories)) {
        $kategori_list = implode("','", $selected_categories);
        $data_buku = select("SELECT buku.*, kategori.nama 
                            FROM buku 
                            JOIN kategori ON buku.id_kategori = kategori.id_kategori 
                            WHERE kategori.nama IN ('$kategori_list')");
    } else {
        $data_buku = select("SELECT buku.*, kategori.nama 
                            FROM buku 
                            JOIN kategori ON buku.id_kategori = kategori.id_kategori");
    }
} 
// Handle filter dari GET (link dari halaman lain)
elseif (isset($_GET['kategori'])) {
    $selected_categories[] = $_GET['kategori'];
    $data_buku = select("SELECT buku.*, kategori.nama 
                        FROM buku 
                        JOIN kategori ON buku.id_kategori = kategori.id_kategori 
                        WHERE kategori.nama = '{$_GET['kategori']}'");
} 
// Default query jika tidak ada filter
else {
    $data_buku = select("SELECT buku.*, kategori.nama 
                        FROM buku 
                        JOIN kategori ON buku.id_kategori = kategori.id_kategori");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
            body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 80px;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 0;
            height: 70px;
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

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 40vh;
            display: flex;
            align-items: center;
            color: white;
            margin-top: -10px;
        }

        .sidebar {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
        }

        .sidebar .filter-section {
            margin-bottom: 1.5rem;
        }

        .sidebar .filter-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1976d2;
            margin-bottom: 0.5rem;
            margin-top: 1rem;
        }

        .sidebar .form-check {
            margin-bottom: 0.4rem;
        }

        .sidebar hr {
            margin: 1.2rem 0;
            border-top: 1px solid #eee;
        }

        .sidebar-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 1.5rem;
        }

        .empty-books {
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            font-size: 1.2rem;
            font-weight: 500;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .book-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.15);
        }

        .book-cover {
            height: 280px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .book-cover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50%;
            background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
            pointer-events: none;
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .book-card:hover .book-cover img {
            transform: scale(1.08);
        }

        .book-info {
            padding: 1.5rem;
            position: relative;
            background: #fff;
        }

        .book-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.8rem;
            line-height: 1.4;
            height: 3.1em;
            overflow: hidden;
            -webkit-box-orient: vertical;
        }

        .book-publisher {
            color: #666;
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .book-publisher i {
            color: #f4b400;
        }

        .book-category {
            display: inline-block;
            background: #1976d2;
            color: #fff;
            border-radius: 20px;
            font-size: 0.8rem;
            padding: 0.3rem 1rem;
            margin-bottom: 1rem;
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(25, 118, 210, 0.2);
        }

        .book-amount {
            color: #1976d2;
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            background: rgba(25, 118, 210, 0.1);
            border-radius: 8px;
        }

        .book-amount i {
            font-size: 1rem;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            padding: 1rem 0;
        }

        .btn-outline-primary {
            border-width: 2px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(25, 118, 210, 0.2);
        }

        .btn-primary {
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(25, 118, 210, 0.3);
        }

        @media (max-width: 768px) {
            .book-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 1.5rem;
            }

            .book-cover {
                height: 240px;
            }

            .book-info {
                padding: 1.2rem;
            }
        }

        @media (max-width: 991px) {
            .search-bar {
                width: 100%;
            }
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
                        <a class="nav-link" href="siswa.php"><i class="fas fa-home me-1"></i>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kategori.php"><i class="fas fa-book me-1"></i>Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="katalog.php"><i class="fas fa-book me-1"></i>Katalog</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($user['username']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profil.php"><i class="fas fa-user-circle me-2"></i>Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../home.php" onclick="return confirm('Yakin ingin logout?')"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
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
                    <h1 class="display-4 fw-bold mb-4">Daftar Buku</h1>
                    <p class="lead">Temukan buku berdasarkan kategori yang Anda minati</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar Filter -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="sidebar sticky-top" style="top: 90px;">
                    <div class="sidebar-title">Filter kategori :</div>
                    <form action="" method="POST" id="filterForm">
                        <div class="filter-section">
                            <?php foreach ($data_kategori as $kategori): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?= htmlspecialchars($kategori['nama']) ?>" 
                                           id="kategori<?= $kategori['id_kategori'] ?>" name="kategori[]" 
                                           <?= (isset($_POST['kategori']) && in_array($kategori['nama'], $_POST['kategori'])) ? 'checked' : '' ?>
                                           onchange="this.form.submit()">
                                    <label class="form-check-label" for="kategori<?= $kategori['id_kategori'] ?>">
                                        <?= htmlspecialchars($kategori['nama']) ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Katalog Buku -->
            <div class="col-lg-9 col-md-8">
                <?php if (empty($data_buku)): ?>
                    <div class="empty-books">
                        <span><i class="fas fa-box-open fa-2x me-2"></i>Belum ada buku tersedia</span>
                    </div>
                <?php else: ?>
                    <div class="book-grid">
                        <?php foreach ($data_buku as $buku): ?>
                            <div class="book-card">
                                <div class="book-cover">
                                    <img src="<?= $buku['cover'] ?>" alt="<?= htmlspecialchars($buku['judul_buku']) ?>">
                                </div>
                                <div class="book-info">
                                    <div class="book-amount">
                                        <i class="fas fa-book"></i>
                                        Available Book <?= $buku['jumlah_buku'] ?>
                                    </div>
                                    <div class="book-publisher">
                                        <i class="fas fa-user-edit"></i>
                                        <?= $buku['pengarang'] ?>
                                    </div>
                                    <span class="book-category"><?= $buku['nama'] ?></span>
                                    <div class="book-title" title="<?= htmlspecialchars($buku['judul_buku']) ?>">
                                        <?= htmlspecialchars($buku['judul_buku']) ?>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <a href="detailBuku.php?id=<?= $buku['id_buku'] ?>" class="btn btn-outline-primary rounded-pill">
                                            <i class="fas fa-info-circle me-1"></i>Lihat Selengkapnya
                                        </a>
                                        <button type="button" class="btn btn-primary rounded-pill" onclick="alert('Fitur peminjaman buku ini belum tersedia🙏')">
                                            <i class="fas fa-book-reader me-1"></i>Pinjam
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

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