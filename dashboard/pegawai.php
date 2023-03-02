<h1 class="h3 mb-4 text-gray-800">Pegawai</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Data Pegawai</h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pegawai</th>
                        <th>Nama Pegawai</th>
                        <th>Jenis Kelamin</th>
                        <th>Departemen</th>
                        <th>Status</th>
                        <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $ambil = $koneksi->query("SELECT * FROM pegawai JOIN departemen ON pegawai.id_departemen = departemen.id_departemen WHERE pegawai.id_departemen='$user[id_departemen]'"); ?>
                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <td> <?php echo $nomor; ?></td>
                            <td> <?php echo $pecah["id_pegawai"]; ?> </td>
                            <td> <?php echo $pecah["nama_pegawai"]; ?> </td>
                            <td> <?php echo $pecah["jenis_kelamin"] == 'F' ? 'Perempuan' : 'Laki-laki'; ?> </td>
                            <td> <?php echo $pecah["nama_departemen"]; ?> </td>
                            <td> <?php echo $pecah["status"]; ?> </td>
                            <!-- <td colspan="2">
                                <a href="index.php?halaman=detail-pelamar&id=<?php echo $pecah['id_pegawai']; ?>" class="btn btn-info" title="">Detail</a>
                            </td> -->
                        </tr>
                        <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>