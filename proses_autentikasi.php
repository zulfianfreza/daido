<?php

session_start();
include './koneksi.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include librari phpmailer
include('./phpmailer/Exception.php');
include('./phpmailer/PHPMailer.php');
include('./phpmailer/SMTP.php');

$aksi = $_GET['aksi'];

if ($aksi == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $password = md5($password);
    if (!$username or !$password) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Username atau password tidak boleh kosong.';
        header('location:login.php');
        exit();
    }
    $query = mysqli_query($koneksi, "SELECT*FROM user WHERE username='$username' AND password='$password'");
    $check = mysqli_num_rows($query);


    if ($check > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Login berhasil.';
        $_SESSION['login_type'] = 'admin';
        header('location:dashboard');
    } else {
        $query2 = mysqli_query($koneksi, "SELECT*FROM login_pelamar WHERE email='$username' AND password='$password'");
        $check2 = mysqli_num_rows($query2);
        echo $check2;

        if ($check2 > 0) {
            $data = mysqli_fetch_assoc($query2);
            if ($data['status'] == 0) {
                $_SESSION['toast_type'] = 'error';
                $_SESSION['toast_message'] = 'Email anda belum aktif. Silahkan cek email untuk proses aktivasi';
                header('location:login.php');
                exit();
            } else {


                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $data['email'];
                $_SESSION['level'] = $data['level'];
                $_SESSION['toast_type'] = 'success';
                $_SESSION['toast_message'] = 'Login berhasil.';
                $_SESSION['login_type'] = 'pelamar';
                header('location:index.php');
                exit();
            }
        } else {
            echo mysqli_error($koneksi);
            $_SESSION['toast_type'] = 'error';
            $_SESSION['toast_message'] = 'Username atau password salah, silahkan coba kembali.';
            header('location:login.php');
            exit();
        }
        echo mysqli_error($koneksi);
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Username atau password salah, silahkan coba kembali.';
        header('location:login.php');
        exit();
    }
}


if ($aksi == 'daftar') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sekarang = date("Y-m-d H:i:s");

    if (!$nama or !$email or !$password) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Nama, Email atau password tidak boleh kosong.';
        header('location:daftar.php');
        exit();
    }

    $query = mysqli_query($koneksi, "SELECT*FROM login_pelamar WHERE email='$email'");
    $check = mysqli_num_rows($query);
    if ($check > 0) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Email sudah ada';
        header('location:daftar.php');
        exit();
    }

    $query = mysqli_query($koneksi, "INSERT INTO login_pelamar(nama, email, password, tanggal) VALUES('$nama', '$email', '$password', '$sekarang')");
    if ($query) {
        try {
            $token = base64_encode($email);
            $link = 'http://localhost/daido/aktivasi_akun.php?token=' . $token;
            $content = 'Klik link berikut untuk aktivasi akun ada. <br /> ' . $link;
            $email_pengirim = 'zulfianfreza04@gmail.com'; // Isikan dengan email pengirim
            $nama_pengirim = 'PT. Daido'; // Isikan dengan nama pengirim
            $email_penerima = $email; // Ambil email penerima dari inputan form
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
            $_SESSION['toast_message'] = 'Proses daftar berhasil';
            header('location:login.php');
        } catch (Exception $e) {
            echo "<h1>Email gagal dikirim</h1><br /><a href='index.php'>Kembali ke Form</a>";
            echo '<h1>ERROR<br /><small>Error while sending email: ' . $mail->ErrorInfo . '</small></h1>'; // Aktifkan untuk mengetahui error message
        }
    } else {
        echo mysqli_error($koneksi);
    }
}

if ($aksi == 'logout') {
    unset($_SESSION['username']);
    header('location:index.php');
}
