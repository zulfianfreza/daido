<?php

session_start();
include '../../koneksi.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include librari phpmailer
include('../../phpmailer/Exception.php');
include('../../phpmailer/PHPMailer.php');
include('../../phpmailer/SMTP.php');

if ($_GET['aksi'] == 'tambah') {
    $id_pelamar = $_POST['id_pelamar'];
    $vektor_v = $_POST['vektor_v'];
    $vektor_s = $_POST['vektor_s'];
    $keputusan = $_POST['keputusan'];
    $id_lowongan = $_POST['id_lowongan'];
    $tahun = date('Y');
    $sekarang = date("Y-m-d H:i:s");



    if ($keputusan == 5) {
        $content = 'Kepada ' . $res['nama_pelamar'] . ', selamat anda lolos di tahap tes fisik & materi. Untuk berikutnya, tunggu informasi selanjutnya.';
    } else {
        $content = 'Kepada ' . $res['nama_pelamar'] . ', mohon maaf anda gagal di tahap tes fisik & materi.';
    }

    $query = mysqli_query($koneksi, "SELECT*FROM keputusan WHERE id_lowongan='$id_lowongan' AND tahun='$tahun'");
    $check = mysqli_num_rows($query);

    if ($check > 0) {
        $data = mysqli_fetch_assoc($query);
        $query = mysqli_query($koneksi, "UPDATE keputusan SET tanggal='$sekarang' WHERE id_keputusan='$data[id_keputusan]'");

        $query = mysqli_query($koneksi, "DELETE FROM detail_keputusan WHERE id_keputusan='$data[id_keputusan]'");


        for ($i = 0; $i < count($keputusan); $i++) {
            $query = mysqli_query($koneksi, "INSERT INTO detail_keputusan(id_keputusan, id_pelamar, vektor_v, vektor_s, keputusan) VALUES('$data[id_keputusan]', '$id_pelamar[$i]', '$vektor_v[$i]', '$vektor_s[$i]', '$keputusan[$i]')");

            mysqli_query($koneksi, "UPDATE pelamar SET id_status='$keputusan[$i]' WHERE id_pelamar='$id_pelamar[$i]'");

            if (!$query) {
                echo mysqli_error($koneksi);
                exit();
            }

            $query = mysqli_query($koneksi, "SELECT*FROM pelamar WHERE id_pelamar='$id_pelamar[$i]'");
            $user = mysqli_fetch_assoc($query);

            if ($keputusan[$i] == 5) {
                $content = 'Kepada ' . $user['nama_pelamar'] . ', selamat anda lolos di tahap tes fisik & materi. Untuk berikutnya, tunggu informasi selanjutnya.';
            } else {
                $content = 'Kepada ' . $user['nama_pelamar'] . ', mohon maaf anda gagal di tahap tes fisik & materi.';
            }

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
            } catch (Exception $e) {
                echo "<h1>Email gagal dikirim</h1><br /><a href='index.php'>Kembali ke Form</a>";
                echo '<h1>ERROR<br /><small>Error while sending email: ' . $mail->ErrorInfo . '</small></h1>'; // Aktifkan untuk mengetahui error message
            }
        }

        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Keputusan berhasil diperbarui';
        header('location:../index.php?halaman=keputusan&lowongan=' . $id_lowongan);
    } else {

        $query = mysqli_query($koneksi, "INSERT INTO keputusan (id_lowongan, tahun, tanggal) VALUES('$id_lowongan', '$tahun', '$sekarang')");
        if ($query) {
            $id = mysqli_insert_id($koneksi);

            for ($i = 0; $i < count($keputusan); $i++) {
                $query = mysqli_query($koneksi, "INSERT INTO detail_keputusan(id_keputusan, id_pelamar, vektor_v, vektor_s, keputusan) VALUES('$id', '$id_pelamar[$i]', '$vektor_v[$i]', '$vektor_s[$i]', '$keputusan[$i]')");

                mysqli_query($koneksi, "UPDATE pelamar SET id_status='$keputusan[$i]' WHERE id_pelamar='$id_pelamar[$i]'");

                if (!$query) {
                    echo mysqli_error($koneksi);
                }

                $query = mysqli_query($koneksi, "SELECT*FROM pelamar WHERE id_pelamar='$id_pelamar[$i]'");
                $user = mysqli_fetch_assoc($query);

                if ($keputusan[$i] == 5) {
                    $content = 'Kepada ' . $user['nama_pelamar'] . ', selamat anda lolos di tahap tes fisik & materi. Untuk berikutnya, tunggu informasi selanjutnya.';
                } else {
                    $content = 'Kepada ' . $user['nama_pelamar'] . ', mohon maaf anda gagal di tahap tes fisik & materi.';
                }

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
                } catch (Exception $e) {
                    echo "<h1>Email gagal dikirim</h1><br /><a href='index.php'>Kembali ke Form</a>";
                    echo '<h1>ERROR<br /><small>Error while sending email: ' . $mail->ErrorInfo . '</small></h1>'; // Aktifkan untuk mengetahui error message
                }
            }

            $_SESSION['toast_type'] = 'success';
            $_SESSION['toast_message'] = 'Pemberian keputusan berhasil';
            header('location:../index.php?halaman=keputusan&lowongan=' . $id_lowongan);
        }
    }
}
