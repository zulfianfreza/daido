<?php
$query = mysqli_query($koneksi, "SELECT*FROM user WHERE id_user='$_GET[id]'");
$data = mysqli_fetch_assoc($query);
?>
<h1 class="h3 mb-4 text-gray-800">Ubah User</h1>

<div class="card shadow mb-4">
    <form action="./proses/proses_user.php?aksi=ubah&id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="">nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>">
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control" name="username" value="<?= $data['username'] ?>">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" class="form-control" name="password" value="<?= $data['password'] ?>">
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <select name="level" id="level" class="form-control" onchange="showDepartemen(this)">
                    <option value="0" <?= $data['level'] == 0 ? 'selected' : '' ?>>0 - Admin</option>
                    <option value="1" <?= $data['level'] == 1 ? 'selected' : '' ?>>1 - HRD</option>
                    <option value="2" <?= $data['level'] == 2 ? 'selected' : '' ?>>2 - Manajer HRD</option>
                    <option value="3" <?= $data['level'] == 3 ? 'selected' : '' ?>>3 - Kepala Divisi</option>
                </select>
            </div>
            <div class="form-group" id="departemen" style="display: <?= $data['level'] == 3 ? 'block' : '' ?>;">
                <label class="form-label">Departemen</label>
                <select name="departemen" id="" class="form-control">
                    <option value="" selected disabled>Departemen</option>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT*FROM departemen WHERE id_departemen !=6");
                    while ($res = mysqli_fetch_assoc($query)) {
                    ?>
                        <option value="<?= $res['id_departemen'] ?>" <?= $res['id_departemen'] == $data['id_departemen'] ? 'selected' : '' ?>><?= $res['nama_departemen'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success">
                Ubah
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