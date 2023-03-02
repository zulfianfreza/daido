<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
include '../../koneksi.php';

if ($_GET['aksi'] == 'tambah') {
    $id_pelamar = $_POST['id_pelamar'];
    $id_kriteria = $_POST['id_kriteria'];
    $sekarang = date("Y-m-d H:i:s");
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];

    $query = mysqli_query($koneksi, "INSERT INTO penilaian (id_pelamar, tanggal) 
    VALUES ('$id_pelamar', '$sekarang')");
    if ($query) {
        $id = mysqli_insert_id($koneksi);

        for ($i = 0; $i < count($nilai); $i++) {
            $query = mysqli_query($koneksi, "INSERT INTO detail_penilaian (id_penilaian, id_kriteria, nilai, keterangan) 
            VALUES ('$id', '$id_kriteria[$i]', '$nilai[$i]', '$keterangan[$i]')");

            if (!$query) {
                echo mysqli_error($koneksi);
            }
        }

        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Penilaian berhasil';
        header('location:../index.php?halaman=penilaian');
    } else {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = mysqli_error($koneksi);
        header('location:../index.php?halaman=tambah-penilaian&id=' . $id_pelamar);
    }
}

if ($_GET['aksi'] == 'ubah') {

    $sekarang = date("Y-m-d H:i:s");
    $id = $_GET['id'];
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];
    $id_detail_penilaian = $_POST['id_detail_penilaian'];

    $query = mysqli_query($koneksi, "SELECT*FROM penilaian JOIN pelamar ON penilaian.id_pelamar = pelamar.id_pelamar WHERE penilaian.id_penilaian='$id'");
    $data = mysqli_fetch_assoc($query);



    for ($i = 0; $i < count($nilai); $i++) {
        $query = mysqli_query($koneksi, "UPDATE detail_penilaian SET nilai='$nilai[$i]', keterangan='$keterangan[$i]' WHERE id='$id_detail_penilaian[$i]'");

        if (!$query) {
            $_SESSION['toast_type'] = 'success';
            $_SESSION['toast_message'] = mysqli_error($koneksi);
            header('location:../index.php?halaman=ubah_penilaian_pelamar');
        }
    }

    $_SESSION['toast_type'] = 'success';
    $_SESSION['toast_message'] = 'Ubah Penilaian berhasil';
    header('location:../index.php?halaman=penilaian_pelamar');
}

if ($_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT*FROM penilaian JOIN pelamar ON penilaian.id_pelamar = pelamar.id_pelamar WHERE penilaian.id_penilaian='$id'");
    $data = mysqli_fetch_assoc($query);

    $query = mysqli_query($koneksi, "DELETE FROM penilaian WHERE id_penilaian='$id'");


    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Hapus data penilaian berhasil';
        header('location:../index.php?halaman=penilaian_pelamar');
    } else {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = mysqli_error($koneksi);
        header('location:../index.php?halaman=penilaian_pelamar');
    }
}
