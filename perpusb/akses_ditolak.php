<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                        url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .error-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
            width: 100%;
            max-width: 500px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .error-icon {
            font-size: 4rem;
            color: #e74c3c;
            margin-bottom: 1.5rem;
            animation: shake 1s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .error-title {
            color: var(--text-color);
            font-size: 2.2rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .error-message {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn {
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            color: white;
        }

        @media (max-width: 576px) {
            .error-container {
                padding: 2rem;
            }

            .error-title {
                font-size: 1.8rem;
            }

            .error-message {
                font-size: 1rem;
            }

            .btn {
                padding: 0.7rem 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h1 class="error-title">Akses Ditolak!</h1>
        <p class="error-message">Maaf, Anda tidak memiliki hak akses untuk membuka halaman tersebut.</p>

        <?php if (isset($_SESSION['level'])): ?>
            <?php if ($_SESSION['level'] == 'admin'): ?>
                <a href="/perpusb/pages/admin/pageAdmin.php" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    <span>Kembali ke Dashboard Admin</span>
                </a>
            <?php elseif ($_SESSION['level'] == 'petugas'): ?>
                <a href="/perpusb/pages/petugas/pagePetugas.php" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    <span>Kembali ke Dashboard Petugas</span>
                </a>
            <?php elseif ($_SESSION['level'] == 'siswa'): ?>
                <a href="/perpusb/pages/siswa/siswa.php" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    <span>Kembali ke Dashboard Siswa</span>
                </a>
            <?php endif; ?>
        <?php else: ?>
            <a href="login.php" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login</span>
            </a>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>