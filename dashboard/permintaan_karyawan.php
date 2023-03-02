<h1 class="h3 mb-4 text-gray-800">Form Permintaan Karyawan</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Data Form Permintaan Karyawan</h6>
        <?php
        if ($user['level'] == 3) {
        ?>
            <a href="index.php?halaman=tambah-permintaan-karyawan" class="btn btn-primary">
                <i class="fas fa-plus"></i> Form Permintaan Karyawan
            </a>
        <?php
        }
        ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Form Permintaan</th>
                        <th>Tanggal Diminta</th>
                        <th>Posisi</th>
                        <th>Jumlah Karyawan Pria</th>
                        <th>Jumlah Karyawan Wanita</th>
                        <th>Status Karyawan</th>
                        <?php
                        if ($user['level'] == 2) {
                        ?>
                            <td>Status Permintaan</td>
                        <?php
                        }
                        ?>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $ambil = $koneksi->query("SELECT * FROM permintaan_karyawan"); ?>
                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <td> <?php echo $nomor; ?></td>
                            <td> <?php echo $pecah["id_permintaan_karyawan"] ?> </td>
                            <td> <?php echo $pecah["tgl_diminta"] ?> </td>
                            <td> <?php echo $pecah["posisi"] ?> </td>
                            <td> <?php echo $pecah["jumlah_karyawan_pria"] ?> </td>
                            <td> <?php echo $pecah["jumlah_karyawan_wanita"] ?> </td>
                            <td> <?php echo $pecah["status_karyawan"] ?> </td>
                            <?php
                            if ($user['level'] == 2) {
                            ?>
                                <td><?= $pecah['status_permintaan'] ?></td>
                            <?php
                            }
                            ?>
                            <td>
                                <?php
                                if ($user['level'] == 3) {
                                ?>

                                    <a href="index.php?halaman=detail-permintaan-karyawan&id<?= $pecah['id_permintaan_karyawan'] ?>">
                                        <button class="btn btn-info btn-sm">Detail</button>
                                    </a>
                                    <a href="index.php?halaman=ubah-permintaan-karyawan&id=<?= $pecah['id_permintaan_karyawan'] ?>">
                                        <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                    </a>
                                    <a href="./proses/proses_permintaan_karyawan.php?aksi=hapus&id=<?= $pecah['id_permintaan_karyawan'] ?>" class="btn btn-danger btn-sm btn-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php
                                } else if ($user['level'] == 2) {
                                ?>
                                    <a href="index.php?halaman=ubah-permintaan-karyawan&id=<?= $pecah['id_permintaan_karyawan'] ?>">
                                        <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                    </a>
                                    <a href="index.php?halaman=konfirmasi-permintaan-karyawan&id=<?= $pecah['id_permintaan_karyawan'] ?>">
                                        <button class="btn btn-primary btn-sm">Konfirmasi</button>
                                    </a>
                                <?php
                                } else if ($user['level'] == 1) {
                                ?>
                                    <a href="index.php?halaman=detail-permintaan-karyawan&id=<?= $pecah['id_permintaan_karyawan'] ?>">
                                        <button class="btn btn-primary btn-sm">Detail</button>
                                    </a>
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
</div