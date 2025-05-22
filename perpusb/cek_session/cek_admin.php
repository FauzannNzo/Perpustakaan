<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin') {
    header("Location: /perpusb/akses_ditolak.php");
    exit();
}