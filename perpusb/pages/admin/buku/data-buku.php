<?php 
include '../../../config/controller.php';
include '../../../cek_session/cek_admin.php';

// perintah sql menampilkan data
$data_buku = select("SELECT b.*, k.nama FROM buku b LEFT JOIN  kategori k ON b.id_kategori = k.id_kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --text-color: #2c3e50;
            --light-bg: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--text-color);
        }

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-color) !important;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-color) !important;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: var(--primary-color) !important;
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 600;
        }
        @media (max-width: 991px) {
            .navbar-collapse {
                background: white;
                padding: 1rem;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin-top: 1rem;
            }
            
            .nav-link {
                padding: 0.5rem 0 !important;
            }
        }
        /* Cards */
        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            border: none;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .card-body {
            padding: 2rem;
        }
        /* Tables */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table th {
            background-color: var(--light-bg);
            color: var(--text-color);
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }

        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 500;
        }

        .bg-success {
            background: linear-gradient(45deg, #2ecc71, #27ae60);
        }

        .bg-warning {
            background: linear-gradient(45deg, #f1c40f, #f39c12);
        }

        .bg-danger {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            padding: 2rem 5%;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .welcome-section {
            text-align: left;
            margin-bottom: 3rem;
            position: relative;
            padding: 2rem;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 20px;
            color: white;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(52, 152, 219, 0.2);
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center/cover;
            opacity: 0.1;
            clip-path: polygon(100% 0, 0 0, 100% 100%);
        }

        .welcome-section h1 {
            color: white;
            font-size: 2.8rem;
            margin-bottom: 1rem;
            font-weight: 700;
            position: relative;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .welcome-section p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            max-width: 600px;
            line-height: 1.6;
            position: relative;
        }

        .welcome-section .welcome-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.9);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .welcome-stats {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
        }

        .welcome-stat-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem 1.5rem;
            border-radius: 15px;
            backdrop-filter: blur(5px);
        }

        .welcome-stat-item h3 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .welcome-stat-item p {
            font-size: 0.9rem;
            margin: 0;
            opacity: 0.8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin-top: 60px;
                padding: 1rem;
            }

            .table {
                display: block;
                overflow-x: auto;
            }

            .stat-card {
                margin-bottom: 1rem;
            }
        }
        
        @media (max-width: 1200px) {
            .welcome-section h1 {
                font-size: 2.4rem;
            }

            .welcome-section p {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 992px) {
            .main-content {
                padding: 1.5rem 3%;
            }

            .welcome-section {
                padding: 1.5rem;
            }

            .welcome-section h1 {
                font-size: 2rem;
            }

            .card-body {
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-top: 60px;
                padding: 1rem;
            }

            .welcome-section {
                text-align: center;
                padding: 1.5rem;
            }

            .welcome-section h1 {
                font-size: 1.8rem;
            }

            .welcome-section p {
                font-size: 1rem;
                margin: 0 auto;
            }

            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.9rem;
            }

            .card-body {
                padding: 1rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .nav-link {
                padding: 0.4rem 0.8rem !important;
                font-size: 0.9rem;
            }

            .stat-card {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 576px) {
            .welcome-section h1 {
                font-size: 1.5rem;
            }

            .welcome-section p {
                font-size: 0.9rem;
            }

            .card-header h2 {
                font-size: 1.4rem;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-user-shield me-2"></i>ADMIN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../pageAdmin.php"><i class="fas fa-home me-1"></i>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../siswa/data-siswa.php"><i class="fas fa-user-graduate me-1"></i>Siswa</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="../kategori/data-kategori.php"><i class="fas fa-book me-1"></i>Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="data-buku.php"><i class="fas fa-book me-1"></i>Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../../logout.php" onclick="return confirm('Yakin ingin logout?')">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="welcome-section">
            <i class="fas fa-user-shield welcome-icon"></i>
            <h1>Dashboard Admin</h1>
            <h2>Selamat Datang, <?= $_SESSION['username']; ?>!</h2>
            <p>Kelola data buku dengan mudah dan efisien.</p>
        </div>

       <!-- Data Buku -->
       <div class="row">
            <div class="col-12">
                <div class="card" id="buku">
                    <div class="card-header">
                        <h2>Data Buku</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 5%">No</th>
                                        <th style="width: 20%">Judul Buku</th>
                                        <th style="width: 15%">Pengarang</th>
                                        <th class="text-center" style="width: 10%">Tahun Terbit</th>
                                        <th class="text-center" style="width: 10%">Jumlah Buku</th>
                                        <th style="width: 15%">Cover</th>
                                        <th style="width: 20%">Deskripsi</th>
                                        <th style="width: 15%">Kategori</th>
                                        <th class="text-center" style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_buku as $buku): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="fw-bold"><?= $buku['judul_buku']; ?></td>
                                            <td><?= $buku['pengarang']; ?></td>
                                            <td class="text-center"><?= $buku['tahun_terbit']; ?></td>
                                            <td class="text-center"><?= $buku['jumlah_buku']; ?></td>
                                            <td>
                                                <?php if($buku['cover']): ?>
                                                    <img src="<?= $buku['cover'] ?>" alt="Cover" class="img-thumbnail" style="max-width: 100px;">
                                                <?php else: ?>
                                                    <span class="text-muted">No Image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $desc = strip_tags($buku['deskripsi']);
                                                    if(strlen($desc) > 60) {
                                                        echo htmlspecialchars(substr($desc,0,60)) . '...';
                                                    } else {
                                                        echo htmlspecialchars($desc);
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">
                                                    <?= $buku['nama']; ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="ubah-buku.php?id=<?= $buku['id_buku']; ?>" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="hapus-buku.php?id=<?= $buku['id_buku']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="tambah-buku.php?level=petugas" class="btn btn-primary mt-3">
                            <i class="fas fa-plus me-1"></i>Tambah Buku
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>