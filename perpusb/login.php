<?php
session_start();
include 'config/koneksi.php'; // File koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi input tidak boleh kosong
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=Username dan Password wajib diisi!");
        exit();
    }

    // Query untuk mencari user
    $stmt = $db->prepare("SELECT * FROM login WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Cek password (kalau sudah di-hash, ganti dengan password_verify)
        if ($password === $user['password']) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];

            // Pengalihan halaman berdasarkan level
            switch ($user['level']) {
                case 'admin':
                    header("Location: pages/admin/pageAdmin.php");
                    break;
                case 'petugas':
                    header("Location: pages/petugas/pagePetugas.php");
                    break;
                case 'siswa':
                    header("Location: /perpusb/pages/siswa/siswa.php");
                    break;
                default:
                    header("Location: login.php?error=Level user tidak dikenali!");
                    break;
            }
            exit();
        } else {
            header("Location: login.php?error=Password salah!");
            exit();
        }
    } else {
        header("Location: login.php?error=Username tidak ditemukan!");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan Digital</title>
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

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            backdrop-filter: blur(10px);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            color: var(--text-color);
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .login-header p {
            color: #666;
            font-size: 1rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 1rem;
            height: auto;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .form-label {
            color: #666;
            font-size: 0.9rem;
        }

        .btn-login {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-back {
            background-color: transparent;
            color: var(--secondary-color);
            border: 2px solid var(--secondary-color);
            padding: 0.8rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-back:hover {
            background-color: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        .form-check {
            margin: 1rem 0;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            background-color: rgba(231, 76, 60, 0.1);
            padding: 0.8rem;
            border-radius: 10px;
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 2rem 1.5rem;
            }

            .login-header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Selamat Datang</h1>
            <p>Silakan login untuk melanjutkan</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-floating">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                <label for="username">Username</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Ingatkan Saya</label>
                <a href="#" class="forgot-password float-end">Lupa Password?</a>
            </div>

            <button type="submit" class="btn btn-login" name="buat">Login</button>
            <a href="home.php" class="btn btn-back">Kembali ke Beranda</a>
        </form>

        <div class="register-link">
            Belum Punya Akun? <a href="registrasi.php">Registrasi Di Sini</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>