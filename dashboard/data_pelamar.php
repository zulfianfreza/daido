<h1 class="h3 mb-4 text-gray-800">Pelamar</h1>

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
                        <th>Lowongan</th>
                        <th>Nama Pelamar</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th>Status Pelamar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    $ambil = $koneksi->query("SELECT * FROM pelamar JOIN status ON pelamar.id_status = status.id_status JOIN lowongan ON pelamar.id_lowongan = lowongan.id_lowongan JOIN departemen ON lowongan.id_departemen=departemen.id_departemen WHERE pelamar.email='$user[email]'");
                    $check = mysqli_num_rows($ambil);
                    if ($check > 0) {
                        while ($pecah = $ambil->fetch_assoc()) { ?>
                            <tr>
                                <td> <?php echo $nomor; ?></td>
                                <td> Lowongan Departemen <?php echo $pecah["nama_departemen"]; ?> </td>
                                <td> <?php echo $pecah["nama_pelamar"]; ?> </td>
                                <td> <?php echo $pecah["email"]; ?> </td>
                                <td> <?php echo $pecah["jenis_kelamin"]; ?> </td>
                                <td> <?php echo $pecah["tgl_lahir"]; ?> </td>
                                <td> <?php echo $pecah["tlp"]; ?> </td>
                                <td> <?php echo $pecah["alamat"]; ?> </td>
                                <td> <?php echo $pecah["status"]; ?> </td>
                                <td colspan="2">
                                    <a href="index.php?halaman=detail-pelamar&id=<?php echo $pecah['id_pelamar']; ?>" class="btn btn-info" title="">Detail</a>
                                </td>
                            </tr>
                    <?php
                            $nomor++;
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>