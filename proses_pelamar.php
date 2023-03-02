<?php
session_start();
include 'koneksi.php';

if ($_GET['aksi'] == 'tambah') {
    $nama_pelamar = $_POST['nama_pelamar'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $tlp = $_POST['tlp'];
    $alamat = $_POST['alamat'];
    $id_lowongan = $_POST['id_lowongan'];

    $id_tipe_dokumen = $_POST['id_tipe_dokumen'];
    $nama_file = $_FILES['dokumen']['name'];
    $nama_sementara = $_FILES['dokumen']['tmp_name'];
    $dir = 'dokumen/';



    if ($nama_pelamar == '') {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Silahkan lengkapi semua data.';
        header('location:index.php?halaman=kirim-lamaran&id=' . $id_lowongan);
        exit();
    }



    $query = mysqli_query($koneksi, "INSERT INTO pelamar (id_lowongan, nama_pelamar, email, jenis_kelamin, tgl_lahir, tlp, alamat, id_status) VALUES('$id_lowongan', '$nama_pelamar', '$email', '$jenis_kelamin', '$tgl_lahir', '$tlp', '$alamat', '1')");
    if ($query) {

        $id = mysqli_insert_id($koneksi);

        for ($i = 0; $i < count($nama_file); $i++) {
            $filename = $id_tipe_dokumen[$i] . time() . '-' . $nama_file[$i];
            $query = mysqli_query($koneksi, "INSERT INTO dokumen_pelamar(id_pelamar, id_tipe_dokumen, nama_dokumen) VALUES('$id', '$id_tipe_dokumen[$i]', '$filename')");

            if (!$query) {
                echo mysqli_error($koneksi);
            }

            move_uploaded_file($nama_sementara[$i], $dir . $filename);
        }


        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Tambah data pelamar berhasil.';
        header('location:index.php?halaman=lowongan');
    } else {
        echo mysqli_error($koneksi);
    }
}
