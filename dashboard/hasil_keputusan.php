<?php
$query = mysqli_query($koneksi, "SELECT*FROM lowongan");
$res = mysqli_fetch_assoc($query);
$id_lowongan = isset($_GET['id_lowongan']) ? $_GET['id_lowongan'] : $res['id_lowongan'];
?>

<h1 class="h3 mb-4 text-gray-800">Hasil Keputusan Pelamar</h1>

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-end">
        <h6 class="font-weight-bold">Lowongan</h6>
    </div>
    <form action="" method="GET">
        <input type="hidden" name="halaman" value="hasil-keputusan">
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
        <h6 class="m-0 font-weight-bold">Hasil Keputusan Pelamar </h6>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Pelamar</th>
                        <th>Nama Pelamar</th>
                        <th>Vektor V</th>
                        <th>Vektor S</th>
                        <th>Peringkat</th>
                        <th>Keputusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT*FROM keputusan WHERE id_lowongan='$id_lowongan'");
                    $data = mysqli_fetch_assoc($query);
                    $no = 1;
                    $check = mysqli_num_rows($query);
                    if ($check == 0) {
                    ?>
                        <script>
                            Swal.fire({
                                title: "Hasil keputusan pada periode tersebut kosong.",
                                icon: 'warning',
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'OK',

                            })
                        </script>
                        <?php
                    } else {
                        $query = mysqli_query($koneksi, "SELECT*FROM detail_keputusan JOIN pelamar ON detail_keputusan.id_pelamar = pelamar.id_pelamar JOIN status ON detail_keputusan.keputusan=status.id_status WHERE detail_keputusan.id_keputusan='$data[id_keputusan]' ORDER BY detail_keputusan.vektor_v DESC");
                        while ($res = mysqli_fetch_assoc($query)) {
                        ?>

                            <tr class="">
                                <td><?= $res['id_pelamar'] ?></td>
                                <td><?= $res['nama_pelamar'] ?></td>
                                <td><?= $res['vektor_v'] ?></td>
                                <td><?= $res['vektor_s'] ?></td>
                                <td><?= $no++ ?></td>
                                <td><?= $res['status'] ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>