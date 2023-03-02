<?php
$query = mysqli_query($koneksi, "SELECT*FROM lowongan limit 1");
$res = mysqli_fetch_assoc($query);
$id_lowongan = isset($_GET['id_lowongan']) ? $_GET['id_lowongan'] : $res['id_lowongan'];
?>

<h1 class="h3 mb-4 text-gray-800">Hasil Penilaian</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-end">
        <h6 class="font-weight-bold">Lowongan</h6>
    </div>
    <form action="" method="GET">
        <input type="hidden" name="halaman" value="hasil-penilaian">
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

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Hasil Penilaian Pegawai</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <p>Bobot</p>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kriteria</th>
                            <th>Skala</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT*FROM kriteria JOIN bobot on kriteria.id_bobot = bobot.id_bobot");
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?= $data['id_kriteria'] ?></td>
                                <td><?= $data['kriteria'] ?></td>
                                <td><?= $data['skala'] ?></td>
                                <td><?= $data['keterangan'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <p>Perbaikan Bobot</p>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kriteria</th>
                            <th>Skala</th>
                            <th>Perbaikan Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT*FROM perbaikan_bobot");
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?= $data['id_kriteria'] ?></td>
                                <td><?= $data['kriteria'] ?></td>
                                <td><?= $data['skala'] ?></td>
                                <td><?= $data['perbaikan_bobot'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Pelamar</th>
                        <th>Nama</th>
                        <th>Nilai Vektor S</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query1 = mysqli_query($koneksi, "SELECT*FROM pelamar JOIN penilaian ON pelamar.id_pelamar = penilaian.id_pelamar WHERE pelamar.id_pelamar AND pelamar.id_lowongan='$id_lowongan'");
                    $vektors = 0;
                    $vektorv = 0;
                    $data_vektors = [];
                    $data_id_pelamar = [];
                    $data_nama_pelamar = [];
                    while ($data1 = mysqli_fetch_assoc($query1)) {
                        $vektors_temp = 1;
                        $query2 = mysqli_query($koneksi, "SELECT*FROM detail_penilaian dp1 JOIN perbaikan_bobot pb1 
                        ON dp1.id_kriteria = pb1.id_kriteria WHERE dp1.id_penilaian='$data1[id_penilaian]'");
                        while ($data2 = mysqli_fetch_assoc($query2)) {
                            $s = pow($data2['nilai'], $data2['perbaikan_bobot']);
                            $vektors_temp = $vektors_temp * $s;
                        }
                        $vektors = $vektors_temp;
                        $vektorv = $vektorv + $vektors;
                        array_push($data_vektors, $vektors_temp);
                        array_push($data_id_pelamar, $data1['id_pelamar']);
                        array_push($data_nama_pelamar, $data1['nama_pelamar']);
                    ?>
                        <tr>
                            <td><?= $data1['id_pelamar'] ?></td>
                            <td><?= $data1['nama_pelamar'] ?></td>
                            <td><?= $vektors ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Pelamar</th>
                        <th>Nama Pelamar</th>
                        <th>Nilai Vektor S</th>
                        <th>Nilai Vektor V</th>
                        <th>Peringkat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    array_multisort($data_vektors, SORT_DESC, $data_id_pelamar, $data_nama_pelamar);
                    for ($i = 0; $i < count($data_id_pelamar); $i++) {
                        // foreach ($data_vektorv as $res) {
                    ?>
                        <tr>
                            <td><?= $data_id_pelamar[$i] ?></td>
                            <td><?= $data_nama_pelamar[$i] ?></td>
                            <td><?= $data_vektors[$i] ?></td>
                            <td><?= $data_vektors[$i] / $vektorv ?></td>
                            <td><?= $i + 1 ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>