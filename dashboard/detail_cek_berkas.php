<?php
$query = mysqli_query($koneksi, "SELECT*FROM pelamar WHERE id_pelamar='$_GET[id]'");
$data = mysqli_fetch_assoc($query);
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Dokumen Pelamar</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Detail Dokumen Pelamar</h6>
    </div>
    <form action="./proses/proses_cek_berkas.php?id=<?= $_GET['id'] ?>" method="post">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>ID Pelamar</th>
                    <td>: <?= $data['id_pelamar'] ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>: <?= $data['email'] ?></td>
                </tr>
                <tr>
                    <th>Nama Pelamar</th>
                    <td>: <?= $data['nama_pelamar'] ?></td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>: <?= $data['tgl_lahir'] ?></td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td>: <?= $data['tlp'] ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: <?= $data['alamat'] ?></td>
                </tr>

                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM dokumen_pelamar dp JOIN tipe_dokumen td ON dp.id_tipe_dokumen=td.id_tipe_dokumen WHERE dp.id_pelamar='$_GET[id]'");
                while ($data = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <th><?= $data['tipe_dokumen'] ?></th>
                        <td>
                            <a href="../dokumen/<?= $data['nama_dokumen'] ?>" target="_blank">
                                <?= $data['nama_dokumen'] ?>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </table>
            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label">Status Cek Berkas</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status_gagal" value="3">
                        <label class="form-check-label" for="status_gagal">Gagal</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status_lolos" value="2">
                        <label class="form-check-label" for="status_lolos">Lolos</label>
                    </div>
                </div>
            </div>
            <div class="col" id="cek_fisik" style="display:none;">
                <div class="form-group">
                    <label for="" class="form-label">Tanggal Cek Fisik</label>
                    <input type="datetime-local" name="tgl" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Tempat</label>
                    <input type="datetime-text" name="tempat" id="" class="form-control">
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <!-- <a href="./proses/proses_cek_berkas.php?status=3&id_pelamar=<?= $_GET['id'] ?>" class="btn btn-danger mr-2">Gagal</a>
            <a href="./proses/proses_cek_berkas.php?status=2&id_pelamar=<?= $_GET['id'] ?>" class="btn btn-primary">Lolos</a> -->
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
</div>

<script>
    const cek_fisik = document.getElementById('cek_fisik');

    function handleRadioClick() {
        if (document.getElementById('status_lolos').checked) {
            cek_fisik.style.display = 'block';
        } else {
            cek_fisik.style.display = 'none';
        }
    }

    const radioButtons = document.querySelectorAll('input[name="status"]');
    radioButtons.forEach(radio => {
        radio.addEventListener('click', handleRadioClick);
    });
</script>