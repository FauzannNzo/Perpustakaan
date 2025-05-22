<?php
include '../../../config/controller.php';
include '../../../cek_session/cek_admin.php';

if (isset($_POST['tambah'])) {
    if (create_kategori($_POST) > 0) {
        echo "<script>
            alert('Data Berhasil Ditambahkan');
            document.location.href='data-kategori.php';
            </script>";
    } else {
        echo "<script>
            alert('Data Gagal Ditambahkan');
            document.location.href='tambahKategori.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - Perpustakaan Digital</title>
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

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
            width: 100%;
            max-width: 500px;
            backdrop-filter: blur(10px);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h1 {
            color: var(--text-color);
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .form-header p {
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

        .btn-submit {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-submit:hover {
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
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .btn-back:hover {
            background-color: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 2rem 1.5rem;
            }

            .form-header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <h1>Tambah Kategori</h1>
            <p>Silakan isi data kategori baru</p>
        </div>

        <form action="" method="POST">
            <div class="form-floating">
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kategori" required>
                <label for="nama">Nama Kategori</label>
            </div>

            <button type="submit" class="btn btn-submit" name="tambah">
                <i class="fas fa-plus me-2"></i>Tambah Kategori
            </button>

            <a href="data-kategori.php" class="btn btn-back">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>