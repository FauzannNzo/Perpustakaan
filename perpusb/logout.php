<?php
// session_start();
// session_unset();     // Menghapus semua data session
// session_destroy();   // Mengakhiri session

// header("Location: home.php");
// exit();

// session_start();
// // Hapus semua session
// $_SESSION = array();
// session_destroy();

// // Redirect ke halaman login dengan pesan
// header("Location: login.php?info=Anda berhasil logout!");
// exit();


session_start();
// Hapus semua data session
session_unset();
session_destroy();

// Redirect ke halaman login
header("Location: login.php?info=Anda berhasil logout");
exit();
?>