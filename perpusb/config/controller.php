<?php
    include "koneksi.php";
    include "app.php";

    // Start session
    // session_start();

    // Check if user is logged in
    // if (!isset($_SESSION['username'])) {
    //     header("Location: ../login.php");
    //     exit();
    // }

    // Get user information
    $username = $_SESSION['username'];
    $query = "SELECT * FROM login WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
?>