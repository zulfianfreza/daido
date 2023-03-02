<?php
$kode = $_GET['kode'];
$query = mysqli_query($koneksi, "SELECT*FROM kriteria JOIN bobot ON kriteria.id_bobot = bobot.id_bobot WHERE id_kriteria='$kode'");
$data = mysqli_fetch_assoc($query);
?>

<h1 class="h3 mb-4 text-gray-800">Kriteria</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold tr-text-primary">Ubah Kriteria</h6>
    </div>
    <form action="./proses/proses_kriteria.php?aksi=ubah" method="POST">
        <div class="card-body">
            <div class="">
                <label class="form-label">Kode</label>
                <input type="text" class="form-control" name="kode" placeholder="" value="<?= $data['id_kriteria'] ?>" required>
            </div>
            <div class="mt-3">
                <label class="form-label">Kriteria</label>
                <input type="text" class="form-control" onkeydown="return /[a-z ]/i.test(event.key)" name="kriteria" placeholder="" value="<?= $data['kriteria'] ?>" required>
            </div>
            <div class="mt-3">
                <label class="form-label">Bobot</label>
                <select name="bobot" id="" class="form-control" required>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT*FROM bobot");
                    while ($res = mysqli_fetch_assoc($query)) {
                    ?>
                        <option value="<?= $res['id_bobot'] ?>" <?= $res['id_bobot'] == $data['id_bobot'] ? 'selected' : '' ?>><?= $res['skala'] . ' - ' . $res['keterangan'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Ubah
            </button>
        </div>
    </form>
</div>