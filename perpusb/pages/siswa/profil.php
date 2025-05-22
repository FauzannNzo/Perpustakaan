<?php
include '../../config/controller.php';
include '../../cek_session/cek_siswa.php';
include '../../config/koneksi.php';

// Ambil username dari session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$user = [
    'nama' => '',
    'username' => '',
    'password' => ''
];
if (!empty($username)) {
    $query = mysqli_query($db, "SELECT * FROM login WHERE username = '" . mysqli_real_escape_string($db, $username) . "' LIMIT 1");
    if ($query && $row = mysqli_fetch_assoc($query)) {
        $user['nama'] = isset($row['name']) ? $row['name'] : '';
        $user['username'] = isset($row['username']) ? $row['username'] : '';
        $user['password'] = isset($row['password']) ? $row['password'] : '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Siswa - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 80px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        .main-content { flex: 1 0 auto; }
        .profile-card {
            background: #fff;
            border-radius: 28px;
            box-shadow: 0 8px 40px rgba(52,152,219,0.13), 0 2px 8px rgba(52,152,219,0.10);
            padding: 3.2rem 2.6rem 2.6rem 2.6rem;
            max-width: 540px;
            margin: 0 auto;
            margin-top: 4.5rem;
            text-align: center;
            position: relative;
            transition: box-shadow 0.3s, transform 0.3s;
        }
        .profile-card:hover, .profile-card:focus-within {
            box-shadow: 0 16px 56px rgba(52,152,219,0.20), 0 4px 16px rgba(52,152,219,0.13);
            transform: translateY(-6px) scale(1.018);
        }
        .profile-avatar {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 2rem;
            border: 6px solid #3498db;
            box-shadow: 0 0 0 8px rgba(52,152,219,0.12), 0 6px 32px rgba(52,152,219,0.13);
            background: linear-gradient(135deg, #e3f0fa 0%, #f5fafd 100%);
        }
        .profile-name {
            font-size: 2.1rem;
            font-weight: 800;
            color: #3498db;
            margin-bottom: 1.2rem;
            letter-spacing: 0.5px;
            text-align: center;
        }
        .profile-info {
            text-align: left;
            margin-top: 2.5rem;
        }
        .profile-info .info-label {
            font-weight: 500;
            color: #7ab6e6;
            width: 140px;
            display: inline-block;
            font-size: 0.97rem;
            margin-bottom: 0.2rem;
            letter-spacing: 0.1px;
        }
        .profile-info .form-control[readonly] {
            background: #f4f8fd;
            border: none;
            font-size: 1.22rem;
            color: #222;
            font-weight: 700;
            box-shadow: none;
            padding-left: 0.2rem;
            margin-bottom: 0.2rem;
        }
        .profile-info .mb-3 {
            margin-bottom: 2.1rem !important;
        }
        @media (max-width: 576px) {
            .profile-card { padding: 1.2rem 0.5rem; margin-top: 1.5rem; max-width: 98vw; }
            .profile-avatar { width: 90px; height: 90px; }
            .profile-info .info-label { width: 90px; font-size: 0.93rem; }
            .profile-name { font-size: 1.3rem; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
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
                        <a class="nav-link" href="katalog.php"><i class="fas fa-book me-1"></i>Katalog</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-1"></i><?= htmlspecialchars($user['username']) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item active" href="#"><i class="fas fa-user-circle me-2"></i>Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../../logout.php" onclick="return confirm('Yakin ingin logout?')"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <div class="container">
            <div class="profile-card">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['nama']) ?>&background=3498db&color=fff&size=256" alt="Avatar" class="profile-avatar">
                <div class="profile-name mb-2">Profil Siswa</div>
                <div class="profile-info mt-3">
                    <div class="mb-3">
                        <label class="info-label"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($user['nama']) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="info-label"><i class="fas fa-user-tag me-2"></i>Username</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="info-label"><i class="fas fa-lock me-2"></i>Password</label>
                        <input type="password" class="form-control" value="<?= htmlspecialchars($user['password']) ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
