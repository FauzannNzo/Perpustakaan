<?php
include '../../config/controller.php';
include '../../cek_session/cek_admin.php';


// perintah sql menampilkan data
$data_akun = select("SELECT * FROM login");
$data_kategori = select("SELECT * FROM kategori");

// Mendapatkan jumlah total aktivitas
$total_aktivitas = select("SELECT COUNT(*) as total FROM aktivitas")[0]['total'];

$data_aktivitas = select("SELECT a.*, l.name as user_name, l.username 
    FROM aktivitas a
    LEFT JOIN login l ON a.user_id = l.id
    ORDER BY a.waktu DESC
    LIMIT 20
");

// Filter hanya akun petugas
$data_petugas = array_filter($data_akun, function ($akun) {
    return $akun['level'] == 'petugas';
});

// Menghitung jumlah siswa, staff, kategori, dan buku
$data_jumlah_siswa = select("SELECT COUNT(*) as total FROM login WHERE level='siswa'")[0]['total'];
$data_jumlah_staff = select("SELECT COUNT(*) as total FROM login WHERE level='petugas'")[0]['total'];
$data_jumlah_kategori = select("SELECT COUNT(*) as total FROM kategori")[0]['total'];
$data_jumlah_buku = select("SELECT COUNT(*) as total FROM buku")[0]['total'];

// Berfungsi untuk mendapatkan ikon yang sesuai untuk jenis aktivitas
function getActivityIcon($aktivitas_type, $tabel)
{
    switch ($aktivitas_type) {
        case 'INSERT':
            if ($tabel == 'login') return 'user-plus';
            if ($tabel == 'kategori') return 'folder-plus';
            if ($tabel == 'buku') return 'book';
            return 'plus-circle';
        case 'UPDATE':
            if ($tabel == 'login') return 'user-edit';
            if ($tabel == 'kategori') return 'folder-open';
            if ($tabel == 'buku') return 'book-open';
            return 'edit';
        case 'DELETE':
            if ($tabel == 'login') return 'user-minus';
            if ($tabel == 'kategori') return 'folder-minus';
            if ($tabel == 'buku') return 'book-dead';
            return 'trash';
        default:
            return 'info-circle';
    }
}

// Fungsi untuk mendapatkan kelas latar belakang untuk jenis aktivitas
function getActivityClass($aktivitas_type)
{
    switch ($aktivitas_type) {
        case 'INSERT':
            return 'bg-success';
        case 'UPDATE':
            return 'bg-warning';
        case 'DELETE':
            return 'bg-danger';
        default:
            return 'bg-info';
    }
}

// Berfungsi untuk memformat waktu relatif
function timeAgo($datetime)
{
    $timestamp = strtotime($datetime);
    $current_time = time();
    $diff = $current_time - $timestamp;

    if ($diff < 60) {
        return "Baru saja";
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . " menit yang lalu";
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . " jam yang lalu";
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return $days . " hari yang lalu";
    } else {
        return date("d M Y H:i", $timestamp);
    }
}

// Fungsi untuk mendapatkan judul aktivitas
function getActivityTitle($aktivitas_type, $tabel)
{
    $action = '';
    switch ($aktivitas_type) {
        case 'INSERT':
            $action = 'Ditambahkan';
            break;
        case 'UPDATE':
            $action = 'Diperbarui';
            break;
        case 'DELETE':
            $action = 'Dihapus';
            break;
    }

    switch ($tabel) {
        case 'login':
            return 'Akun ' . $action;
        case 'kategori':
            return 'Kategori ' . $action;
        case 'buku':
            return 'Buku ' . $action;
        default:
            return ucfirst($tabel) . ' ' . $action;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Perpustakaan Digital</title>
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

        /* Main Content */
        .main-content {
            margin-top: 80px;
            padding: 2rem 5%;
        }

        /* Welcome Section Enhancement */
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

        /* Buttons */
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

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .stat-card h2 {
            font-size: 2rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .stat-card h5 {
            color: #666;
            font-size: 1rem;
        }

        /* Badges */
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

        /* Responsive Design */
        @media (max-width: 1200px) {
            .welcome-section h1 {
                font-size: 2.4rem;
            }

            .welcome-section p {
                font-size: 1.1rem;
            }

            .welcome-stats {
                gap: 1.5rem;
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

            .welcome-stats {
                flex-wrap: wrap;
                justify-content: center;
            }

            .welcome-stat-item {
                flex: 0 0 calc(50% - 1rem);
                margin-bottom: 1rem;
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

            .welcome-stats {
                flex-direction: column;
                align-items: center;
            }

            .welcome-stat-item {
                width: 100%;
                max-width: 300px;
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

            .welcome-stat-item h3 {
                font-size: 1.5rem;
            }

            .welcome-stat-item p {
                font-size: 0.8rem;
            }
        }

        /* Additional Responsive Utilities */
        .table-responsive {
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Activity Timeline Styles */
        .activity-timeline {
            position: relative;
            padding: 20px 0;
            max-height: 600px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #3498db #f1f1f1;
        }

        .activity-timeline::-webkit-scrollbar {
            width: 8px;
        }

        .activity-timeline::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .activity-timeline::-webkit-scrollbar-thumb {
            background: #3498db;
            border-radius: 4px;
        }

        .activity-timeline::-webkit-scrollbar-thumb:hover {
            background: #2980b9;
        }

        .activity-item {
            position: relative;
            padding-left: 60px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            transform: translateX(5px);
        }

        .activity-icon {
            position: absolute;
            left: 15px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            z-index: 1;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .activity-item:hover .activity-icon {
            transform: scale(1.1);
        }

        .activity-content {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .activity-item:hover .activity-content {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .activity-header h5 {
            margin: 0;
            font-size: 1.1rem;
            color: #2c3e50;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .activity-time {
            font-size: 0.9rem;
            color: #6c757d;
            background: #f8f9fa;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .activity-text {
            margin: 0 0 12px 0;
            color: #495057;
            font-size: 1rem;
            line-height: 1.6;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .activity-user {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
            padding-top: 12px;
            margin-top: 12px;
        }

        .activity-user i {
            color: var(--primary-color);
        }

        .activity-filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .activity-filter-btn {
            padding: 8px 16px;
            border-radius: 20px;
            border: none;
            background: #f8f9fa;
            color: #6c757d;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .activity-filter-btn:hover,
        .activity-filter-btn.active {
            background: var(--primary-color);
            color: white;
        }

        .activity-empty {
            text-align: center;
            padding: 40px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .activity-empty i {
            font-size: 3rem;
            color: #dee2e6;
            margin-bottom: 15px;
        }

        .activity-empty p {
            color: #6c757d;
            font-size: 1.1rem;
            margin: 0;
        }

        .bg-success {
            background: linear-gradient(45deg, #2ecc71, #27ae60) !important;
        }

        .bg-warning {
            background: linear-gradient(45deg, #f1c40f, #f39c12) !important;
        }

        .bg-danger {
            background: linear-gradient(45deg, #e74c3c, #c0392b) !important;
        }

        .bg-info {
            background: linear-gradient(45deg, #3498db, #2980b9) !important;
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
                        <a class="nav-link active" href="pageAdmin.php"><i class="fas fa-home me-1"></i>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="siswa/data-siswa.php"><i class="fas fa-user-graduate me-1"></i>Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kategori/data-kategori.php"><i class="fas fa-book me-1"></i>Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buku/data-buku.php"><i class="fas fa-book me-1"></i>Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../logout.php" onclick="return confirm('Yakin ingin logout?')">
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
            <!-- <p>Anda login sebagai: <?= $_SESSION['level']; ?></p> -->
            <p>Kelola perpustakaan digital dengan mudah dan efisien.</p>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <i class="fas fa-book-open"></i>
                    <h2><?= $data_jumlah_buku; ?></h2>
                    <h5>Total Buku</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <i class="fas fa-book"></i>
                    <h2><?= $data_jumlah_kategori; ?></h2>
                    <h5>Total Kategori</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <i class="fas fa-book-reader"></i>
                    <h2>0</h2>
                    <h5>Total Peminjaman</h5>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h2><?= $data_jumlah_siswa; ?></h2>
                    <h5>Total Siswa</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card">
                    <i class="fas fa-user-tie"></i>
                    <h2><?= $data_jumlah_staff; ?></h2>
                    <h5>Total Staff</h5>
                </div>
            </div>
        </div>

        <!-- PETUGAS -->
        <div class="card" id="staff">
            <div class="card-header">
                <h2>Data Akun Petugas</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data_petugas as $petugas): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $petugas['name']; ?></td>
                                    <td><?= $petugas['username']; ?></td>
                                    <td><?= $petugas['password']; ?></td>
                                    <td>
                                        <span class="badge <?= $petugas['status'] == 'aktif' ? 'bg-success' : 'bg-danger'; ?>">
                                            <?= $petugas['status']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="ubahData.php?id=<?= $petugas['id']; ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="hapusData.php?id=<?= $petugas['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a href="tambahData.php?level=petugas" class="btn btn-primary mt-3">
                    <i class="fas fa-plus me-1"></i>Tambah Petugas
                </a>
            </div>
        </div>

        <!-- Aktivitas -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2><i class="fas fa-history me-2"></i>Aktivitas Terbaru</h2>
                        <div>
                            <span class="badge bg-primary me-2"><?= count($data_aktivitas) ?> Aktivitas Ditampilkan</span>
                            <span class="badge bg-secondary">Total: <?= $total_aktivitas ?> Aktivitas</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline">
                            <?php if (empty($data_aktivitas)): ?>
                                <div class="activity-empty">
                                    <i class="fas fa-inbox"></i>
                                    <p>Belum ada aktivitas tercatat</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($data_aktivitas as $aktivitas): ?>
                                    <div class="activity-item">
                                        <div class="activity-icon <?= getActivityClass($aktivitas['aktivitas_type']) ?>">
                                            <i class="fas fa-<?= getActivityIcon($aktivitas['aktivitas_type'], $aktivitas['tabel']) ?>"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-header">
                                                <h5>
                                                    <i class="fas fa-<?= getActivityIcon($aktivitas['aktivitas_type'], $aktivitas['tabel']) ?>"></i>
                                                    <?= getActivityTitle($aktivitas['aktivitas_type'], $aktivitas['tabel']) ?>
                                                </h5>
                                                <span class="activity-time"><?= timeAgo($aktivitas['waktu']) ?></span>
                                            </div>
                                            <p class="activity-text"><?= $aktivitas['deskripsi'] ?></p>
                                            
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>