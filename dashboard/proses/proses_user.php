<?php

session_start();
include '../../koneksi.php';

if ($_GET['aksi'] == 'tambah') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $password = md5($password);
    $level = $_POST['level'];
    $departemen = isset($_POST['departemen']) ? $_POST['departemen'] : 0;

    $query = mysqli_query($koneksi, "SELECT*FROM user WHERE username='$username'");
    $check = mysqli_num_rows($query);

    if ($check > 0) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Username sudah ada.';
        // header('location:../index.php?halaman=tambah-user');
        exit();
    }

    $query = mysqli_query($koneksi, "INSERT INTO user (nama, username, password, level, id_departemen) VALUES ('$nama', '$username', '$password', '$level', '$departemen')");
    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Tambah data user berhasil.';
        header('location:../index.php?halaman=user');
    } else {

        echo mysqli_error($koneksi);
    }
}

if ($_GET['aksi'] == 'ubah') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $level = $_POST['level'];
    $password = $_POST['password'];
    $id = $_GET['id'];
    $departemen = isset($_POST['departemen']) ? $_POST['departemen'] : 0;

    // $query = mysqli_query($koneksi, "SELECT*FROM user where username='$username'");
    // $data = mysqli_fetch_assoc($query);

    $query = mysqli_query($koneksi, "UPDATE user SET nama='$nama', password='$password', level='$level', username='$username', id_departemen='$departemen' WHERE id_user='$id'");
    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Ubah data user berhasil.';
        header('location:../index.php?halaman=user');
    } else {
        echo mysqli_error($koneksi);
    }
}

if ($_GET['aksi'] == 'hapus') {
    $username = $_GET['username'];

    $query = mysqli_query($koneksi, "DELETE FROM user WHERE username='$username'");

    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Hapus data user berhasil';
        header('location:../index.php?halaman=user');
    }
}
