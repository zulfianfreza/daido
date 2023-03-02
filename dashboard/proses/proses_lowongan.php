<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
include '../../koneksi.php';

if ($_GET['aksi'] == 'tambah') {
    $id_departemen = $_POST['id_departemen'];
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_berakhir = $_POST['tgl_berakhir'];
    $deskripsi = $_POST['deskripsi'];

    echo $deskripsi;

    if ($tgl_mulai == '') {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Silahkan lengkapi semua data.';
        header('location:../index.php?halaman=tambah-lowongan');
        exit();
    }

    $query = mysqli_query($koneksi, "INSERT INTO lowongan (id_departemen, tgl_mulai, tgl_berakhir, deskripsi) VALUES('$id_departemen', '$tgl_mulai','$tgl_berakhir', '$deskripsi')");
    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Tambah data lowongan berhasil.';
        header('location:../index.php?halaman=lowongan');
    } else {
        echo mysqli_error($koneksi);
    }
}

if ($_GET['aksi'] == 'ubah') {
    $id_departemen = $_POST['id_departemen'];
    $deskripsi = $_POST['deskripsi'];
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_berakhir = $_POST['tgl_berakhir'];
    $id = $_GET['id'];

    if (!$tgl_mulai || !$tgl_berakhir) {
        header('location:index.php?halaman=ubah_lowongan');
    }

    $query = mysqli_query($koneksi, "UPDATE lowongan SET tgl_mulai='$tgl_mulai', tgl_berakhir='$tgl_berakhir', id_departemen='$id_departemen', deskripsi='$deskripsi' WHERE id_lowongan='$id'");

    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Ubah data lowongan berhasil.';
        header('location:../index.php?halaman=lowongan');
    }
}

if ($_GET['aksi'] == 'hapus') {
    $id_lowongan = $_GET['id'];

    $query = mysqli_query($koneksi, "DELETE FROM lowongan WHERE id_lowongan='$id_lowongan'");

    if ($query) {
        header('location:../index.php?halaman=lowongan');
    }
}
