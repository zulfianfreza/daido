<?php
$query = mysqli_query($koneksi, "SELECT*FROM lowongan limit 1");
$res = mysqli_fetch_assoc($query);
$id_lowongan = isset($_GET['id_lowongan']) ? $_GET['id_lowongan'] : $res['id_lowongan'];
?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Interview</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-end">
        <h6 class="font-weight-bold">Lowongan</h6>
    </div>
    <form action="" method="GET">
        <input type="hidden" name="halaman" value="keputusan">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <select name="id_lowongan" id="" class="form-control">
                        <?php

                        $query = mysqli_query($koneksi, "SELECT*FROM lowongan l JOIN departemen d ON l.id_departemen=d.id_departemen");
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <option value="<?= $data['id_lowongan'] ?>" <?= $data['id_lowongan'] == $id_lowongan ? 'selected' : '' ?>><?= $data['nama_departemen'] . ' (' . $data['tgl_mulai'] . ' - ' . $data['tgl_berakhir'] . ')' ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end align-items-center">
            <button class="btn btn-success" type="submit">Filter</button>
        </div>
    </form>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Data Pelamar</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelamar</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th>Status Pelamar</th>
                        <th width='120'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $ambil = $koneksi->query("SELECT * FROM pelamar JOIN status ON pelamar.id_status = status.id_status WHERE pelamar.id_lowongan='$id_lowongan' AND pelamar.id_status IN (5,7,8,9)"); ?>
                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <td> <?php echo $nomor; ?></td>
                            <td> <?php echo $pecah["nama_pelamar"] ?> </td>
                            <td> <?php echo $pecah["email"] ?> </td>
                            <td> <?php echo $pecah["jenis_kelamin"] ?> </td>
                            <td> <?php echo $pecah["tgl_lahir"] ?> </td>
                            <td> <?php echo $pecah["tlp"] ?> </td>
                            <td> <?php echo $pecah["alamat"] ?> </td>
                            <td> <?php echo $pecah["status"] ?> </td>
                            <td colspan="2">
                                <?php
                                $query = mysqli_query($koneksi, "SELECT*FROM interview WHERE id_pelamar='$pecah[id_pelamar]'");
                                $check = mysqli_num_rows($query);
                                $data = mysqli_fetch_assoc($query);
                                if ($check > 0) {
                                ?>
                                    <a href="index.php?halaman=detail-interview&id=<?php echo $pecah['id_pelamar']; ?>" class="btn btn-info" title="">Proses</a>

                                <?php
                                } else {
                                ?>
                                    <a href="index.php?halaman=tambah-interview&id=<?php echo $pecah['id_pelamar']; ?>" class="btn btn-info" title="">Atur Interview</a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>