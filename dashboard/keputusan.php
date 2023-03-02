<?php
$query = mysqli_query($koneksi, "SELECT*FROM lowongan limit 1");
$res = mysqli_fetch_assoc($query);
$id_lowongan = isset($_GET['id_lowongan']) ? $_GET['id_lowongan'] : $res['id_lowongan'];
?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Keputusan</h1>

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

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Keputusan Pelamar</h6>
    </div>
    <form action="./proses/proses_keputusan.php?aksi=tambah" method="post">
        <div class="card-body">


            <div class="table-responsive">
                <?php
                $vektorv = 0;
                $vektors = 0;
                $data_vektorv = [];
                $data_id_pelamar = [];
                $data_nama = [];
                $query = mysqli_query($koneksi, "SELECT*FROM pelamar JOIN penilaian ON pelamar.id_pelamar = penilaian.id_pelamar WHERE pelamar.id_lowongan='$id_lowongan'");
                while ($data = mysqli_fetch_assoc($query)) {
                    $vektorv_temp = 1;
                ?>
                    <?php
                    $query2 = mysqli_query($koneksi, "SELECT AVG(dp.nilai) as 'nilai', pb.perbaikan_bobot FROM detail_penilaian dp JOIN perbaikan_bobot pb ON dp.id_kriteria = pb.id_kriteria WHERE dp.id_penilaian IN (SELECT penilaian.id_penilaian FROM penilaian WHERE penilaian.id_pelamar='$data[id_pelamar]') GROUP BY dp.id_kriteria;");
                    while ($data2 = mysqli_fetch_assoc($query2)) {
                        $v = pow($data2['nilai'], $data2['perbaikan_bobot']);
                        $vektorv_temp = $vektorv_temp * $v;
                    }
                    $check = mysqli_num_rows($query2);
                    $vektorv = $check == 0 ? 0 : $vektorv_temp;
                    $vektors = $vektors + $vektorv;
                    array_push($data_vektorv, $check == 0 ? 0 : $vektorv_temp);
                    array_push($data_id_pelamar, $data['id_pelamar']);
                    array_push($data_nama, $data['nama_pelamar']);
                    ?>
                <?php
                }
                ?>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Pelamar</th>
                            <th>Nama Pelamar</th>
                            <th>Nilai Vektor V</th>
                            <th>Nilai Vektor S</th>
                            <th>Peringkat</th>
                            <th>Keputusan</th>
                        </tr>
                    </thead>
                    <tbody>



                        <?php
                        array_multisort($data_vektorv, SORT_DESC, $data_id_pelamar, $data_nama);
                        for ($i = 0; $i < count($data_id_pelamar); $i++) {
                            // foreach ($data_vektorv as $res) {
                            $query = mysqli_query($koneksi, "SELECT*FROM detail_keputusan dk JOIN pelamar p ON dk.id_pelamar=p.id_pelamar WHERE dk.id_pelamar='$data_id_pelamar[$i]' AND p.id_lowongan='$id_lowongan'");
                            $data = mysqli_fetch_assoc($query);
                            $check = mysqli_num_rows($query);
                        ?>
                            <tr>
                                <input type="hidden" name="id_lowongan" value="<?= $id_lowongan ?>">
                                <td><?= $data_id_pelamar[$i] ?></td>
                                <input type="hidden" name="id_pelamar[]" value="<?= $data_id_pelamar[$i] ?>">
                                <td><?= $data_nama[$i] ?></td>
                                <td><?= $data_vektorv[$i] ?></td>
                                <input type="hidden" name="vektor_v[]" value="<?= $data_vektorv[$i] ?>">
                                <td><?= $data_vektorv[$i] / $vektors ?></td>
                                <input type="hidden" name="vektor_s[]" value="<?= $data_vektorv[$i] / $vektors ?>">
                                <td><?= $i + 1 ?></td>
                                <td>
                                    <select name="keputusan[]" id="" class="form-control">
                                        <?php

                                        ?>
                                        <option value="-">-</option>
                                        <option value="5" <?= $check > 0 ? ($data['keputusan'] == '5' ? 'selected' : '') : '' ?>>Lolos</option>
                                        <option value="6" <?= $check > 0 ? ($data['keputusan'] == '6' ? 'selected' : '') : '' ?>>Gagal</option>
                                    <?php
                                }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <?php
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-success" type="submit">
                <?php
                $query = mysqli_query($koneksi, "SELECT*FROM keputusan WHERE id_lowongan='$id_lowongan'");
                $check = mysqli_num_rows($query);
                ?>
                <?= $check == 1 ? 'Perbarui' : 'Simpan' ?>
            </button>
        </div>
    </form>
</div>