<?php
$query = mysqli_query($koneksi, "SELECT*FROM interview JOIN pelamar ON interview.id_pelamar = pelamar.id_pelamar WHERE interview.id_pelamar='$_GET[id]'");
$data = mysqli_fetch_assoc($query);
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Interview</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Detail Interview</h6>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-sm-2">
                <p>Nama Pelamar</p>
            </div>
            <div class="col-sm-2">
                <p>: <?= $data['nama_pelamar'] ?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="form-label">Tanggal Interview</label>
            <input type="datetime-local" name="tgl" id="" class="form-control" value="<?= $data['tgl_interview'] ?>">
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <a href="./proses/proses_interview.php?aksi=set&status=9&id_pelamar=<?= $_GET['id'] ?>" class="btn btn-danger mr-2">Gagal</a>
        <a href="./proses/proses_interview.php?aksi=set&status=8&id_pelamar=<?= $_GET['id'] ?>" class="btn btn-primary">Lolos</a>
    </div>
</div>