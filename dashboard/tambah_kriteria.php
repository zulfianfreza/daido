<h1 class="h3 mb-4 text-gray-800">Kriteria</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold tr-text-primary">Tambah Kriteria</h6>
    </div>
    <form action="./proses/proses_kriteria.php?aksi=tambah" method="POST">
        <div class="card-body">
            <div class="">
                <label class="form-label">Kode</label>
                <input type="text" class="form-control" name="kode" placeholder="" value="" required>
            </div>
            <div class="mt-3">
                <label class="form-label">Kriteria</label>
                <input type="text" class="form-control" onkeydown="return /[a-z]/i.test(event.key)" name="kriteria" placeholder="" value="" required>
            </div>
            <div class="mt-3">
                <label class="form-label">Bobot</label>
                <select name="bobot" id="" class="form-control" required>
                    <option value="" disabled selected>Pilih Bobot</option>
                    <option value="1">4 - Sangat Penting</option>
                    <option value="2">3 - Penting</option>
                    <option value="3">2 - Cukup Penting</option>
                    <option value="4">1 - Kurang Penting</option>
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