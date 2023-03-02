<?php

include '../../koneksi.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include librari phpmailer
include('../../phpmailer/Exception.php');
include('../../phpmailer/PHPMailer.php');
include('../../phpmailer/SMTP.php');

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $tgl = $_POST['tgl'];
    $id_pelamar = $_GET['id_pelamar'];

    $query = mysqli_query($koneksi, "SELECT*FROM pelamar WHERE id_pelamar='$id_pelamar'");
    $user = mysqli_fetch_assoc($query);

    $query = mysqli_query($koneksi, "INSERT INTO interview(id_pelamar, tgl_interview) VALUES('$id_pelamar', '$tgl')");
    if ($query) {
        try {
            $email_pengirim = 'zulfianfreza04@gmail.com'; // Isikan dengan email pengirim
            $nama_pengirim = 'PT. Daido'; // Isikan dengan nama pengirim
            $email_penerima = $user['email']; // Ambil email penerima dari inputan form
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Username = $email_pengirim; // Email Pengirim
            $mail->Password = 'bwetoieazwjmbmth'; // Isikan dengan Password email pengirim
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            // $mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging
            $mail->setFrom($email_pengirim, $nama_pengirim);
            $mail->addAddress($email_penerima, '');
            $mail->isHTML(true);

            $mail->Subject = 'Lowongan';
            $mail->Body = 'Kepada ' . $user['nama_pelamar'] . ', tahap interview akan dilaksanakan pada tanggal ' . $tgl;
            $send = $mail->send();
        } catch (Exception $e) {
            echo "<h1>Email gagal dikirim</h1><br /><a href='index.php'>Kembali ke Form</a>";
            echo '<h1>ERROR<br /><small>Error while sending email: ' . $mail->ErrorInfo . '</small></h1>'; // Aktifkan untuk mengetahui error message
        }
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Atur interview berhasil';
        header('location:../index.php?halaman=interview');
    } else {
        echo mysqli_error($koneksi);
    }
}
if ($aksi == 'set') {
    $status = $_GET['status'];

    $query = mysqli_query($koneksi, "SELECT*FROM pelamar WHERE id_pelamar='$_GET[id_pelamar]'");
    $user = mysqli_fetch_assoc($query);

    if ($status == 8) {
        $content = 'Kepada ' . $user['nama_pelamar'] . ', selamat anda lolos di tahap interview. Untuk tahap berikutnya, tunggu informasi selanjutnya.';
    } else {
        $content = 'Kepada ' . $user['nama_pelamar'] . ', mohon maaf anda gagal di tahap cek berkas.';
    }

    $query = mysqli_query($koneksi, "UPDATE pelamar SET id_status='$status' WHERE id_pelamar='$_GET[id_pelamar]'");

    if ($query) {
        try {
            $email_pengirim = 'zulfianfreza04@gmail.com'; // Isikan dengan email pengirim
            $nama_pengirim = 'PT. Daido'; // Isikan dengan nama pengirim
            $email_penerima = $user['email']; // Ambil email penerima dari inputan form
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Username = $email_pengirim; // Email Pengirim
            $mail->Password = 'bwetoieazwjmbmth'; // Isikan dengan Password email pengirim
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            // $mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging
            $mail->setFrom($email_pengirim, $nama_pengirim);
            $mail->addAddress($email_penerima, '');
            $mail->isHTML(true);

            $mail->Subject = 'Lowongan';
            $mail->Body = $content;
            $send = $mail->send();
            $_SESSION['toast_type'] = 'success';
            $_SESSION['toast_message'] = 'Cek berkas untuk id pelamar ' . $_GET['id_pelamar'] . ' telah dilakukan';
            header('location:../index.php?halaman=interview');
        } catch (Exception $e) {
            echo "<h1>Email gagal dikirim</h1><br /><a href='index.php'>Kembali ke Form</a>";
            echo '<h1>ERROR<br /><small>Error while sending email: ' . $mail->ErrorInfo . '</small></h1>'; // Aktifkan untuk mengetahui error message
        }
    } else {
    }
}
