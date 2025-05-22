<?php
    include "../../../config/controller.php";

    // Untuk menerima id produk yang dipilih untuk dihapus
    $id = (int)$_GET["id"];

    // Kondisi ketika tombol hapus diklik
    if (delete_data($id) > 0) {
        echo "<script>
        alert('Data Berhasil Dihapus');
        document.location.href='data-siswa.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Dihapus');
        document.location.href='data-siswa.php';
        </script>";
    }
?>