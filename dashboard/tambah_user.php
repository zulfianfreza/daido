<h1 class="h3 mb-4 text-gray-800">Tambah User</h1>

<div class="card shadow mb-4">
    <form action="./proses/proses_user.php?aksi=tambah" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama">
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <select name="level" id="level" class="form-control" onchange="showDepartemen(this)">
                    <option value="0">0 - Admin</option>
                    <option value="1">1 - HRD</option>
                    <option value="2">2 - Manajer HRD</option>
                    <option value="3">3 - Kepala Divisi</option>
                </select>
            </div>
            <div class="form-group" id="departemen" style="display: none;">
                <label class="form-label">Departemen</label>
                <select name="departemen" id="" class="form-control">
                    <option value="" selected disabled>Departemen</option>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT*FROM departemen WHERE id_departemen !=6");
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <option value="<?= $data['id_departemen'] ?>"><?= $data['nama_departemen'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success">
                Simpan
            </button>
        </div>
    </form>
</div>

<script>
    function showDepartemen(element) {
        console.log(element.value)
        document.getElementById('departemen').style.display = element.value == '3' ? 'block' : 'none'
    }
</script>