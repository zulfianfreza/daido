<div class="container py-5 bg-light">
    <p class="fs-5"><b>Info Lowongan</b></p>
    <div class="row">
        <?php
        $query = mysqli_query($koneksi, "SELECT*FROM lowongan l JOIN departemen d ON l.id_departemen=d.id_departemen");
        while ($data = mysqli_fetch_assoc($query)) {
        ?>
            <div class="col-sm-4">
                <div class="border rounded-3 p-3 shadow-sm">
                    <a href="index.php?halaman=detail-lowongan&id=<?= $data['id_lowongan'] ?>" class="fs-5 text-decoration-none">Lowongan Departemen <?= $data['nama_departemen'] ?></a>
                    <p class="fs-6 mt-2">Tanggal dibuka: <?= $data['tgl_mulai'] ?> <br>
                        Tanggal ditutup: <?= $data['tgl_berakhir'] ?>
                    </p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>