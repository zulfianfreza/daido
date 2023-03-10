<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Kriteria</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Data Kriteria</h6>
        <a href="index.php?halaman=tambah-kriteria" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kriteria
        </a>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT kriteria.id_kriteria, kriteria.kriteria, bobot.skala, bobot.keterangan from kriteria JOIN bobot ON kriteria.id_bobot=bobot.id_bobot");
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['id_kriteria'] ?></td>
                            <td><?= $data['kriteria'] ?></td>
                            <td><?= $data['skala'] ?></td>
                            <td><?= $data['keterangan'] ?></td>
                            <td>
                                <a href="index.php?halaman=ubah-kriteria&kode=<?= $data['id_kriteria'] ?>">
                                    <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                </a>
                                <a href="./proses/proses_kriteria.php?aksi=hapus&kode=<?= $data['id_kriteria'] ?>" class="btn btn-danger btn-sm btn-delete">
                                    <i class="fa fa-trash"></i>
                                </a>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>