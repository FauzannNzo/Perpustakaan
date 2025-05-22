<?php
    include "../../../config/controller.php";

    // Untuk menerima id buku yang dipilih untuk dihapus
    $id_buku = (int)$_GET["id"];

    // Kondisi ketika tombol hapus diklik
    if (delete_buku($id_buku) > 0) {
        echo "<script>
        alert('Data Berhasil Dihapus');
        document.location.href='data-buku.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Dihapus');
        document.location.href='data-buku.php';
        </script>";
    }
?>