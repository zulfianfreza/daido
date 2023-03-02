<?php
$query = mysqli_query($koneksi, "SELECT*FROM lowongan l JOIN departemen d ON l.id_departemen = d.id_departemen WHERE l.id_lowongan='$_GET[id]'");
$res = mysqli_fetch_assoc($query);
?>

<h1 class="h3 mb-4 text-gray-800">Lowongan</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold tr-text-primary">Detail Lowongan</h6>
    </div>
    <div class="card-body">
        <p><b>Departemen</b> : <?= $res['nama_departemen'] ?></p>
        <p><b>Tanggal dibuka lowongan</b> : <?= $res['tgl_mulai'] ?></p>
        <p><b>Tanggal ditutup lowongan</b> : <?= $res['tgl_berakhir'] ?></p>
        <br>
        <p><b>Deskripsi</b></p>
        <div>
            <?= $res['deskripsi'] ?>
        </div>
    </div>
    <!-- <div class="card-footer d-flex justify-content-end">
        <button type="submit" class="btn btn-success">
            Simpan
        </button>
    </div> -->
</div>