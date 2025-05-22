<?php
// Panggil koneksi database
include 'koneksi.php';
session_start();

// Menampilkan data
function select($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Menambahkan data
function create_akun($post)
{
    global $db;
    $name = strip_tags($post['name']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);
    $status = strip_tags($post['status']);

    // Query tambah data
    $query = "INSERT INTO login VALUES (null, '$name', '$username', '$password', '$level', '$status')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Menambah kategori
function create_kategori($post)
{
    global $db;
    $nama = strip_tags($post['nama']);

    // Query tambah kategori
    $query = "INSERT INTO kategori VALUES (null, '$nama')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Menambah Buku
function create_buku($post)
{
    global $db;
    $id_kategori = strip_tags($post['id_kategori']);
    $cover = strip_tags($post['cover']);
    $judul_buku = strip_tags($post['judul_buku']);
    $pengarang = strip_tags($post['pengarang']);
    $tahun_terbit = strip_tags($post['tahun_terbit']);
    $jumlah_buku = strip_tags($post['jumlah_buku']);
    $deskripsi = strip_tags($post['deskripsi']);

    // Query tambah buku
    $query = "INSERT INTO buku VALUES (null, '$id_kategori', '$cover', '$judul_buku', '$pengarang', '$tahun_terbit', '$jumlah_buku', '$deskripsi')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Edit data
function ubah_data($post)
{
    global $db;
    $id = $post['id'];
    $name = $post['name'];
    $username = $post['username'];
    $password = $post['password'];
    $level = $post['level'];
    $status = $post['status'];

    // SQL ubah data
    $query = "UPDATE login SET name = '$name', username = '$username', password = '$password', level = '$level', status = '$status' WHERE id=$id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Edit kategori
function ubah_kategori($post)
{
    global $db;
    $id_kategori = $post['id_kategori'];
    $nama = strip_tags($post['nama']);

    // SQL ubah kategori
    $query = "UPDATE kategori SET nama = '$nama' WHERE id_kategori= $id_kategori";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Edit buku
function ubah_buku($post)
{
    global $db;
    $id_buku = $post['id_buku'];
    $nama = $post['id_kategori'];
    $cover = $post['cover'];
    $judul_buku = $post['judul_buku'];
    $pengarang = $post['pengarang'];
    $tahun_terbit = $post['tahun_terbit'];
    $jumlah_buku = $post['jumlah_buku'];
    $deskripsi = $post['deskripsi'];

    // SQL ubah buku
    $query = "UPDATE buku SET judul_buku = '$judul_buku', cover = '$cover', pengarang = '$pengarang', tahun_terbit = '$tahun_terbit', jumlah_buku = '$jumlah_buku',  id_kategori = '$nama', deskripsi = '$deskripsi' WHERE id_buku=$id_buku";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Hapus data
function delete_data($id)
{
    global $db;

    // Get user info before deleting
    $user_info = select("SELECT name, username FROM login WHERE id = $id")[0];
    $name = $user_info['name'];
    $username = $user_info['username'];

    // SQL delete data
    $query = "DELETE FROM login WHERE id=$id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Hapus kategori
function delete_kategori($id_kategori)
{
    global $db;

    // Get category info before deleting
    $category_info = select("SELECT nama FROM kategori WHERE id_kategori = $id_kategori")[0];
    $nama = $category_info['nama'];

    // SQL delete kategori
    $query = "DELETE FROM kategori WHERE id_kategori = $id_kategori";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Hapus buku
function delete_buku($id_buku)
{
    global $db;

    // Get book info before deleting
    $book_info = select("SELECT judul_buku FROM buku WHERE id_buku = $id_buku")[0];
    $judul = $book_info['judul_buku'];

    // SQL delete buku
    $query = "DELETE FROM buku WHERE id_buku = $id_buku";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
