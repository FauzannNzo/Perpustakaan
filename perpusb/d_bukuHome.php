<?php
include 'config/app.php';
include 'config/koneksi.php';

// Ambil id buku dari URL
$id_buku = isset($_GET['id']) ? intval($_GET['id']) : 0;
$buku = null;
if ($id_buku > 0) {
    $query = mysqli_query($db, "SELECT buku.*, kategori.nama as kategori_nama FROM buku JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE id_buku = $id_buku LIMIT 1");
    if ($query && $row = mysqli_fetch_assoc($query)) {
        $buku = $row;
    }
}
if (!$buku) {
    echo '<div style="padding:2rem;text-align:center;">Buku tidak ditemukan.</div>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - <?= htmlspecialchars($buku['judul_buku']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 80px;
        }
        .back-button-container {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
        }
        .back-button {
            background: linear-gradient(45deg, #3498db, #2980b9);
            border: none;
            border-radius: 25px;
            padding: 0.8rem 1.5rem;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.2);
        }
        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            color: white;
        }
        .detail-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 24px rgba(52,152,219,0.10);
            padding: 3.2rem 3.2rem;
            max-width: 1100px;
            margin: 2.5rem auto 0 auto;
            display: flex;
            gap: 2.5rem;
            align-items: flex-start;
        }
        .detail-cover {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f4f8fd;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(52,152,219,0.08);
            padding: 0.5rem;
        }
        .detail-cover img {
            max-width: 100%;
            max-height: 420px;
            height: auto;
            width: auto;
            display: block;
        }
        .detail-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .detail-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #3498db;
            margin-bottom: 0.6rem;
            text-align: left;
            letter-spacing: 0.5px;
        }
        .detail-meta {
            color: #555;
            font-size: 1.05rem;
            margin-bottom: 0.7rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1.2rem;
            align-items: center;
        }
        .detail-meta span {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .detail-row {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 1.2rem;
        }
        .detail-category {
            display: inline-block;
            background: #1976d2;
            color: #fff;
            border-radius: 20px;
            font-size: 0.98rem;
            padding: 0.3rem 1.1rem;
            margin-bottom: 1.1rem;
            font-weight: 500;
            margin-right: 0.7rem;
        }
        .detail-amount {
            color: #1976d2;
            font-size: 1.08rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .detail-amount .badge {
            background: #e3f0fa;
            color: #1976d2;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 12px;
            padding: 0.4em 1em;
        }
        .desc-label {
            font-size: 1.05rem;
            color: #888;
            font-weight: 600;
            margin-bottom: 0.3rem;
            margin-top: 0.7rem;
        }
        .detail-desc {
            font-size: 1.08rem;
            color: #333;
            margin-bottom: 1.2rem;
            line-height: 1.7;
            background: #f4f8fd;
            border-radius: 10px;
            padding: 1.2rem 1.5rem;
            word-break: break-word;
        }
        .btn-back {
            margin-top: 1.5rem;
            align-self: flex-start;
        }
        .btn-see-all {
            background: linear-gradient(45deg, #3498db, #2980b9);
            border: none;
            border-radius: 25px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-see-all:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            color: white;
        }
        @media (max-width: 900px) {
            .detail-card {
                flex-direction: column;
                align-items: center;
                padding: 1.5rem 0.5rem;
            }
            .detail-cover {
                width: 160px;
                height: 220px;
            }
            .detail-title {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <div class="back-button-container">
        <a href="katalogHome.php" class="back-button">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Katalog
        </a>
    </div>
    <div class="detail-card">
        <div class="detail-cover">
            <img src="<?= htmlspecialchars($buku['cover']) ?>" alt="<?= htmlspecialchars($buku['judul_buku']) ?>">
        </div>
        <div class="detail-info">
            <div class="detail-title"><?= htmlspecialchars($buku['judul_buku']) ?></div>
            <div class="detail-meta">
                <span title="Pengarang"><i class="fas fa-user-edit"></i> <?= htmlspecialchars($buku['pengarang']) ?></span>
                <span title="Tahun Terbit"><i class="fas fa-calendar"></i> <?= htmlspecialchars($buku['tahun_terbit']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-category" title="Kategori"><i class="fas fa-tag"></i> <?= htmlspecialchars($buku['kategori_nama']) ?></span>
                <div class="detail-amount"><i class="fas fa-book"></i> <span class="badge">Tersedia: <?= $buku['jumlah_buku'] ?> buku</span></div>
            </div>
            <div class="desc-label">Deskripsi</div>
            <div class="detail-desc">
                <?= !empty($buku['deskripsi']) ? nl2br(htmlspecialchars($buku['deskripsi'])) : '<span class="text-muted">Tidak ada deskripsi.</span>' ?>
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <a href="#" class="btn btn-see-all text-white" style="padding: 1rem 2rem; font-size: 1.1rem; display: inline-flex; align-items: center; gap: 0.7rem;" onclick="alert('Silahkan login terlebih dahulu, tetapi fitur peminjaman buku ini belum tersedia🙏')">
                    <i class="fas fa-book-open me-2"></i>
                    Pinjam buku
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
