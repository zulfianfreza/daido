<?php
$query = mysqli_query($koneksi, "SELECT*FROM pelamar WHERE id_pelamar='$_GET[id]'");
$data = mysqli_fetch_assoc($query);
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Dokumen Pelamar</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Detail Dokumen Pelamar</h6>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th>ID Pelamar</th>
                <td>: <?= $data['id_pelamar'] ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td>: <?= $data['email'] ?></td>
            </tr>
            <tr>
                <th>Nama Pelamar</th>
                <td>: <?= $data['nama_pelamar'] ?></td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>: <?= $data['tgl_lahir'] ?></td>
            </tr>
            <tr>
                <th>No. Telepon</th>
                <td>: <?= $data['tlp'] ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>: <?= $data['alamat'] ?></td>
            </tr>

            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM dokumen_pelamar dp JOIN tipe_dokumen td ON dp.id_tipe_dokumen=td.id_tipe_dokumen WHERE dp.id_pelamar='$_GET[id]'");
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <th><?= $data['tipe_dokumen'] ?></th>
                    <td>
                        <a href="../dokumen/<?= $data['nama_dokumen'] ?>" target="_blank">
                            <?= $data['nama_dokumen'] ?>
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>

        </table>
    </div>
</div>