<?php
$query = mysqli_query($koneksi, "SELECT*FROM pelamar WHERE id_pelamar='$_GET[id]'");
$data = mysqli_fetch_assoc($query);
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Interview</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Detail Interview</h6>
    </div>
    <form action="./proses/proses_interview.php?aksi=tambah&id_pelamar=<?= $_GET['id'] ?>" method="post">
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
                <input type="datetime-local" name="tgl" id="" class="form-control">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>