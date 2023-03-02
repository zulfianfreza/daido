<?php
$query = mysqli_query($koneksi, "SELECT*FROM permintaan_karyawan JOIN departemen ON permintaan_karyawan.id_departemen = departemen.id_departemen WHERE permintaan_karyawan.id_permintaan_karyawan='$_GET[id]'");
$data = mysqli_fetch_assoc($query);
$pendidikan = explode(',', $data['pendidikan']);
?>

<h1 class="h3 mb-4 text-gray-800">Form Permintaan Karyawan</h1>

<div class="card shadow mb-4">
    <form action="./proses/proses_permintaan_karyawan.php?aksi=ubah&id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Departemen/Bagian</label>
                <select name="id_departemen" id="" class="form-control" required>
                    <option value=""><?= $data['id_departemen'] ?></option>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT*FROM departemen");
                    while ($res = mysqli_fetch_assoc($query)) {
                    ?>
                        <option value="<?= $res['id_departemen'] ?>" <?= $res['id_departemen'] == $data['id_departemen'] ? 'selected' : '' ?>><?= $res['id_departemen'] . ' - ' . $res['nama_departemen'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Tanggal Diminta</label>
                <input type="date" name="tgl_diminta" id="tgl_diminta" class="form-control" value="<?= $data['tgl_diminta'] ?>">
            </div>
            <div class="form-group">
                <label for="">Status Karyawan</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status_karyawan" id="status_karyawan1" value="Permanen" <?= $data['status_karyawan'] == 'Permanen' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="status_karyawan1">
                        Permanen
                    </label>
                    <input class="form-check-input" type="radio" name="status_karyawan" id="status_karyawan2" value="Kontrak" <?= $data['status_karyawan'] == 'Kontrak' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="status_karyawan2">
                        Kontrak
                    </label>
                    <input class="form-check-input" type="radio" name="status_karyawan" id="status_karyawan3" value="Harian" <?= $data['status_karyawan'] == 'Harian' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="status_karyawan3">
                        Harian
                    </label>

                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <label for="">Posisi/Bagian</label>
                        <input type="text" class="form-control" name="posisi" id="posisi" value="<?= $data['posisi'] ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Tanggal Bergabung</label>
                        <input type="date" class="form-control" name="tgl_bergabung" id="tgl_bergabung" value="<?= $data['tgl_bergabung'] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="input-group mb-3">
                        <label for="" class="form-label">Jumlah Karyawan Pria</label>
                        <input type="number" class="form-control" name="jumlah_karyawan_pria" style="margin-left:5px" value="<?= $data['jumlah_karyawan_pria'] ?>">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="input-group mb-3">
                        <label for="" class="form-label">Jumlah Karyawan Wanita</label>
                        <input type="number" class="form-control" name="jumlah_karyawan_wanita" style="margin-left:5px" value="<?= $data['jumlah_karyawan_wanita'] ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="">Pendidikan</label>
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <input class="form-check-input" type="checkbox" value="universitas" name="pendidikan[]" id="pendidikan1" <?= in_array('universitas', $pendidikan) ? 'checked' : '' ?>>
                            <label class="form-check-label mr-5" for="pendidikan1">
                                Universitas (S1)
                            </label>
                        </div>
                        <div class="col-3">
                            <input class="form-check-input" type="checkbox" value="diploma" name="pendidikan[]" id="pendidikan2" <?= in_array('diploma', $pendidikan) ? 'checked' : '' ?>>
                            <label class="form-check-label mr-5" for="pendidikan2">
                                Diploma (D3)
                            </label>
                        </div>
                        <div class="col-3">
                            <input class="form-check-input" type="checkbox" value="sma" name="pendidikan[]" id="pendidikan3" <?= in_array('sma', $pendidikan) ? 'checked' : '' ?>>
                            <label class="form-check-label mr-5" for="pendidikan3">
                                SMA
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <input class="form-check-input" type="checkbox" value="stm" name="pendidikan[]" id="pendidikan4" <?= in_array('stm', $pendidikan) ? 'checked' : '' ?>>
                            <label class="form-check-label mr-5" for="pendidikan4">
                                STM
                            </label>
                        </div>
                        <div class="col-3">
                            <input class="form-check-input" type="checkbox" value="smp" name="pendidikan[]" id="pendidikan5" <?= in_array('smp', $pendidikan) ? 'checked' : '' ?>>
                            <label class="form-check-label mr-5" for="pendidikan5">
                                SMP
                            </label>
                        </div>
                        <div class="col-3">
                            <input class="form-check-input" type="checkbox" value="lainnya" name="pendidikan[]" id="pendidikan6" <?= in_array('lainnya', $pendidikan) ? 'checked' : '' ?>>
                            <label class="form-check-label mr-5" for="pendidikan6">
                                Lain-lain......................
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="form-label">Pengalaman</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="ya" name="pengalaman" id="pengalaman1" <?= $data['pengalaman'] == 'ya' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="pengalaman1">
                        Ya
                    </label>
                    <input class="form-check-input" type="radio" value="tidak" name="pengalaman" id="pengalaman2" <?= $data['pengalaman'] == 'tidak' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="pengalaman2">
                        Tidak
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Pelatihan</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="ya" name="pelatihan" id="pelatihan1" <?= $data['pelatihan'] == 'ya' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="pelatihan1">
                        Ya, pada posisi yang sama
                    </label>
                    <input class="form-check-input" type="radio" value="tidak" name="pelatihan" id="pelatihan2" <?= $data['pelatihan'] == 'tidak' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="pelatihan2">
                        Tidak
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Keahlian</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="ya" name="keahlian" id="keahlian1" <?= $data['keahlian'] == 'ya' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="keahlian1">
                        Ya, pada posisi yang sama
                    </label>
                    <input class="form-check-input" type="radio" value="tidak" name="keahlian" id="keahlian2" <?= $data['keahlian'] == 'tidak' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="keahlian2">
                        Tidak
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Kualifikasi Lain</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="ya" name="kualifikasi_lain" id="kualifikasi_lain1" <?= $data['kualifikasi_lain'] == 'ya' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="kualifikasi_lain1">
                        Ya
                    </label>
                    <input class="form-check-input" type="radio" value="tidak" name="kualifikasi_lain" id="kualifikasi_lain2" <?= $data['kualifikasi_lain'] == 'tidak' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="kualifikasi_lain2">
                        Tidak
                    </label>
                </div>
            </div>

            <table class="table mt-5 mb-5">
                <thead>
                    <tr>
                        <th scope="col">Diminta Oleh</th>
                        <th scope="col">Disetujui Oleh</th>
                        <th scope="col">Diketahui Oleh</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <select name="diminta_oleh" id="" class="form-control">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT*FROM departemen WHERE id_departemen!=6");
                                    while ($res = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?= 'Kepala Divisi ' . $res['nama_departemen'] ?>">Kepala Divisi <?= $res['nama_departemen'] ?></option>
                                    <?php
                                    }
                                    ?>
                                    <option value="Manajer HRD & GA">Manajer HRD & GA</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <select name="disetujui_oleh" id="" class="form-control">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT*FROM departemen WHERE id_departemen!=6");
                                    while ($res = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?= 'Kepala Divisi ' . $res['nama_departemen'] ?>">Kepala Divisi <?= $res['nama_departemen'] ?></option>
                                    <?php
                                    }
                                    ?>
                                    <option value="Manajer HRD & GA">Manajer HRD & GA</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <select name="diketahui_oleh" id="" class="form-control">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT*FROM departemen WHERE id_departemen!=6");
                                    while ($res = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?= 'Kepala Divisi ' . $res['nama_departemen'] ?>">Kepala Divisi <?= $res['nama_departemen'] ?></option>
                                    <?php
                                    }
                                    ?>
                                    <option value="Manajer HRD & GA">Manajer HRD & GA</option>
                                </select>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>


            <div class="form-group">
                <label for="">Ringkasan Tugas Pokok</label>
                <input type="text" class="form-control" name="ringkasan_tugas" id="ringkasan_tugas" value="<?= $data['ringkasan_tugas'] ?>">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Tanggal Rekrutmen</label>
                <input type="date" name="tgl_rekrutmen" id="tgl_rekrutmen" class="form-control" value="<?= $data['tgl_rekrutmen'] ?>">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Pemenuhan Tenaga Kerja Berasal Dari :</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="internal" name="ptkbd" id="ptkbd1" <?= $data['ptkbd'] == 'internal' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="ptkbd2">
                        Internal
                    </label>
                    <input class="form-check-input" type="radio" value="eksternal" name="ptkbd" id="ptkbd2" <?= $data['ptkbd'] == 'eksternal' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="ptkbd2">
                        External, Nama Penyalur
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Wawancara Dilakukan Oleh :</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="terkait" name="pewawancara" id="pewawancara1" <?= $data['pewawancara'] == 'terkait' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="pewawancara1">
                        Departemen Terkait
                    </label>
                    <input class="form-check-input" type="radio" value="lain" name="pewawancara" id="pewawancara2" <?= $data['pewawancara'] == 'lain' ? 'checked' : '' ?>>
                    <label class="form-check-label mr-5" for="pewawancara2">
                        Departemen lain (jika diperlukan)
                    </label>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-dark" name="save">Simpan</button>

        </div>
    </form>
</div>