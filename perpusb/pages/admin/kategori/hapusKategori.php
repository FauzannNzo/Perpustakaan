<?php
    include "../../../config/controller.php";

    // Untuk menerima id produk yang dipilih untuk dihapus
    $id_kategori = (int)$_GET["id"];

    // Kondisi ketika tombol hapus diklik
    if (delete_kategori($id_kategori) > 0) {
        echo "<script>
        alert('Data Berhasil Dihapus');
        document.location.href='data-kategori.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Dihapus');
        document.location.href='data-kategori.php';
        </script>";
    }
?>