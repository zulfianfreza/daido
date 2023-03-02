<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Waktu Pembukaan Lowongan</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Lowongan</h6>
        <a href="index.php?halaman=tambah-lowongan" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Lowongan
        </a>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Departemen</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM lowongan l JOIN departemen d ON l.id_departemen=d.id_departemen");
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama_departemen'] ?></td>
                            <td><?= $data['tgl_mulai'] ?></td>
                            <td><?= $data['tgl_berakhir'] ?></td>
                            <td>
                                <a href="index.php?halaman=detail-lowongan&id=<?= $data['id_lowongan'] ?>">
                                    <button class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button>
                                </a>
                                <a href="index.php?halaman=ubah-lowongan&id=<?= $data['id_lowongan'] ?>">
                                    <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                </a>
                                <a href="./proses/proses_lowongan.php?aksi=hapus&id=<?= $data['id_lowongan'] ?>" class="btn btn-danger btn-sm btn-delete">
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