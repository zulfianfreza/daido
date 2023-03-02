<?php
$query = mysqli_query($koneksi, "SELECT*FROM permintaan_karyawan");
$data = mysqli_fetch_assoc($query);
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Form Pengajuan Kebutuhan Karyawan</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Detail Form Pengajuan Kebutuhan Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <p>Id Permintaan Karyawan</p>
                <p>Id Departemen</p>
                <p>Tanggal Diminta</p>
                <p>Jumlah Karyawan Pria</p>
                <p>Jumlah Karyawan Wanita</p>
                <p>Posisi</p>
                <p>Tanggal Bergabung</p>
                <p>Pendidikan</p>
                <p>Pengalaman</p>
                <p>pelatihan</p>
                <p>Keahlian</p>
                <p>Kualifikasi Lain</p>
                <p>Diminta Oleh</p>
                <p>Disetujui Oleh</p>
                <p>Diketahui Oleh</p>
                <p>Ringkasan Tugas</p>
                <p>Tanggal Rekrutmen</p>
                <p>Pemenuhan Tenaga Kerja</p>
                <p>Pewawancara</p>
            </div>
            <div class="col-sm-4">
                <p>: <?= $data['id_permintaan_karyawan'] ?></p>
                <p>: <?= $data['id_departemen'] ?></p>
                <p>: <?= $data['tgl_diminta'] ?></p>
                <p>: <?= $data['jumlah_karyawan_pria'] ?></p>
                <p>: <?= $data['jumlah_karyawan_wanita'] ?></p>
                <p>: <?= $data['posisi'] ?></p>
                <p>: <?= $data['tgl_bergabung'] ?></p>
                <p>: <?= $data['pendidikan'] ?></p>
                <p>: <?= $data['pengalaman'] ?></p>
                <p>: <?= $data['pelatihan'] ?></p>
                <p>: <?= $data['keahlian'] ?></p>
                <p>: <?= $data['kualifikasi_lain'] ?></p>
                <p>: <?= $data['diminta_oleh'] ?></p>
                <p>: <?= $data['disetujui_oleh'] ?></p>
                <p>: <?= $data['diketahui_oleh'] ?></p>
                <p>: <?= $data['ringkasan_tugas'] ?></p>
                <p>: <?= $data['tgl_rekrutmen'] ?></p>
                <p>: <?= $data['ptkbd'] ?></p>
                <p>: <?= $data['pewawancara'] ?></p>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex">
        <a href="index.php?halaman=formkaryawan">
            <button class="btn btn-dark">Kembali</button>
        </a>
    </div>
</div>