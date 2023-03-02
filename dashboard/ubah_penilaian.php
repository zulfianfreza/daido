<?php
$query = mysqli_query($koneksi, "SELECT*FROM penilaian JOIN pelamar ON penilaian.id_pelamar = pelamar.id_pelamar WHERE id_penilaian='$_GET[id]'");
$res = mysqli_fetch_assoc($query);
?>
<h1 class="h3 mb-4 text-gray-800">Penilaian</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold tr-text-primary">Ubah Penilaian Pelamar</h6>
    </div>
    <form action="./proses/proses_penilaian.php?aksi=ubah&id=<?= $_GET['id'] ?>" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <p>Nama Pelamar</p>
                </div>
                <div class="col-sm-4">
                    <p>: <?= $res['nama_pelamar'] ?></p>
                </div>
            </div>
            <?php
            $query = mysqli_query($koneksi, "SELECT*FROM detail_penilaian JOIN kriteria ON detail_penilaian.id_kriteria = kriteria.id_kriteria WHERE id_penilaian='$_GET[id]'");
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <input type="hidden" name="id_detail_penilaian[]" value="<?= $data['id'] ?>">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="" class="col-sm-6 col-form-label"><?= $data['kriteria'] ?></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="nilai[]" value="<?= $data['nilai'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea name="keterangan[]" id="" rows="1" class="form-control"><?= $data['keterangan'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Ubah
            </button>
        </div>
    </form>
</div>