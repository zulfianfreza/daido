<?php

include '../../koneksi.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include librari phpmailer
include('../../phpmailer/Exception.php');
include('../../phpmailer/PHPMailer.php');
include('../../phpmailer/SMTP.php');

$id = $_GET['id'];
$status = $_POST['status'];
$tgl = $_POST['tgl'];
$tempat = $_POST['tempat'];

$query = mysqli_query($koneksi, "SELECT*FROM pelamar WHERE id_pelamar='$id'");
$res = mysqli_fetch_assoc($query);

if ($status == 2) {
    $content = 'Kepada ' . $res['nama_pelamar'] . ', selamat anda lolos di tahap cek berkas. Untuk tahap berikutnya merupakan tahap tes fisik & materi yang akan dilaksanakan di ' . $tempat . ' pada tanggal ' . $tgl;
} else {
    $content = 'Kepada ' . $res['nama_pelamar'] . ', mohon maaf anda gagal di tahap cek berkas.';
}


$query = mysqli_query($koneksi, "UPDATE pelamar SET id_status='$status' WHERE id_pelamar='$id'");
if ($query) {

    try {
        $email_pengirim = 'zulfianfreza04@gmail.com'; // Isikan dengan email pengirim
        $nama_pengirim = 'PT. Daido'; // Isikan dengan nama pengirim
        $email_penerima = $res['email']; // Ambil email penerima dari inputan form
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
        $_SESSION['toast_message'] = 'Cek berkas untuk id pelamar ' . $id . ' telah dilakukan';
        header('location:../index.php?halaman=cek-berkas');
    } catch (Exception $e) {
        echo "<h1>Email gagal dikirim</h1><br /><a href='index.php'>Kembali ke Form</a>";
        echo '<h1>ERROR<br /><small>Error while sending email: ' . $mail->ErrorInfo . '</small></h1>'; // Aktifkan untuk mengetahui error message
    }
    if ($status == 2) {

        $query2 = mysqli_query($koneksi, "INSERT INTO tes_fisik(id_pelamar, tempat, tanggal) VALUES('$id', '$tempat', '$tgl')");
        if ($query2) {
        } else {
            echo mysqli_error($koneksi);
        }
    }
} else {
    echo mysqli_error($koneksi);
}
