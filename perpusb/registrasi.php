<?php
include "config/koneksi.php";
include "config/app.php";

if (isset($_POST['buat'])) {
    // Menetapkan nilai default untuk level dan status
    $_POST['level'] = 'siswa'; // Mengatur level ke siswa secara default
    $_POST['status'] = '1'; // Mengatur status ke 1(aktif) secara default

    if (create_akun($_POST) > 0) {
        echo "<script>
            alert('Berhasil Membuat Akun');
            document.location.href='login.php';
            </script>";
    } else {
        echo "<script>
            alert('Gagal Membuat Akun');
            document.location.href='registrasi.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Perpustakaan Digital</title>
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

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
            width: 100%;
            max-width: 500px;
            backdrop-filter: blur(10px);
            margin: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-header h1 {
            color: var(--text-color);
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .register-header p {
            color: #666;
            font-size: 1rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 1rem;
            height: auto;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .form-label {
            color: #666;
            font-size: 0.9rem;
        }

        .btn-register {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-register:hover {
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

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px 12px;
        }

        @media (max-width: 576px) {
            .register-container {
                padding: 2rem 1.5rem;
            }
            .register-header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-header">
            <h1>Buat Akun Baru</h1>
            <p>Silakan lengkapi data diri Anda</p>
        </div>

        <form action="" method="POST">
            <div class="form-floating">
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                <label for="name">Nama Lengkap</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                <label for="username">Username</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <button type="submit" class="btn btn-register" name="buat">Daftar</button>
            <a href="home.php" class="btn btn-back">Kembali ke Beranda</a>
        </form>

        <div class="login-link">
            Sudah Punya Akun? <a href="login.php">Login Di Sini</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>