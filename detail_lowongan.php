<?php
include './koneksi.php';
$query = mysqli_query($koneksi, "SELECT*FROM lowongan l JOIN departemen d ON l.id_departemen=d.id_departemen WHERE l.id_lowongan='$_GET[id]'");
$res = mysqli_fetch_assoc($query);
$tgl_berakhir = strtotime($res['tgl_berakhir']);
$sekarang = strtotime(date('Y-m-d h:i:s'));

?>

<div class="container py-5 bg-light">
    <p class="fs-5"><b>Lowongan Departemen <?= $res['nama_departemen'] ?></b></p>
    <p>
        Tanggal dibuka: <?= $res['tgl_mulai'] ?> <br>
        Tanggal ditutup: <?= $res['tgl_berakhir'] ?>
    </p>
    <p><b>Deskripsi</b></p>
    <?= $res['deskripsi'] ?>
    <div class="mt-5"></div>
    <?php
    if ($sekarang < $tgl_berakhir) {
        if ($check_user > 0) {
            $query = mysqli_query($koneksi, "SELECT*FROM pelamar WHERE email='$user[email]' AND id_lowongan='$_GET[id]'");
            $check = mysqli_num_rows($query);
            if ($check > 0) {
    ?>
                <p>Anda sudah mengirimkan lamaran.</p>
            <?php
            } else {
            ?>
                <a href="index.php?halaman=kirim-lamaran&id=<?= $_GET['id'] ?>" class="btn btn-primary">Kirim Lamaran</a>
            <?php
            }
        } else {

            ?>

            <a href="index.php?halaman=kirim-lamaran&id=<?= $_GET['id'] ?>" class="btn btn-primary">Kirim Lamaran</a>
        <?php
        }
    } else {
        ?>
        <p>Lowongan sudah berakhir.</p>
    <?php
    }
    ?>
</div>