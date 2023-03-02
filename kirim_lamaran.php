<?php
if ($check_user == 0) {
    header('location:login.php');
    exit();
}
?>

<div class="w-100 bg-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-sm-8 mx-auto">


                <form action="./proses_pelamar.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_lowongan" value="<?= $_GET['id'] ?>">
                    <div class="mb-3">
                        <label for="">Nama Pelamar</label>
                        <input type="text" class="form-control" name="nama_pelamar" id="nama_pelamar" value="<?= $check_user > 0 ? $user['nama'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $check_user > 0 ? $user['email'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="Laki-laki" checked>
                            <label class="form-check-label" for="jenis_kelamin1">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Perempuan">
                            <label class="form-check-label" for="jenis_kelamin2">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">No. Telp</label>
                        <input type="text" name="tlp" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Alamat</label>
                        <textarea name="alamat" id="" class="form-control" cols="30" rows="2"></textarea>
                    </div>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT*FROM tipe_dokumen");
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?> <div class="mb-3">
                            <input type="hidden" name="id_tipe_dokumen[]" value="<?= $data['id_tipe_dokumen'] ?>">
                            <label for="" class="form-label"> <?= $data['tipe_dokumen'] ?></label>
                            <input type="file" name="dokumen[]" id="" class="form-control">
                        </div>
                    <?php

                    }
                    ?>
                    <div class="mb-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-dark" name="save">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>