<script src="https://cdn.tiny.cloud/1/fhonnakhsc91v4qk9l6ii4z3nf44d55az5avrpywwd7hnh9j/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#tiny',
        plugins: [
            'advlist', 'autolink',
            'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
            'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +
            'bullist numlist checklist outdent indent'
    })
</script>

<h1 class="h3 mb-4 text-gray-800">Tambah Lowongan</h1>

<div class="card shadow mb-4">
    <form action="./proses/proses_lowongan.php?aksi=tambah" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="" class="form-label">Departemen</label>
                <select name="id_departemen" id="" class="form-control">
                    <?php
                    $query = mysqli_query($koneksi, "SELECT*FROM departemen");
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <option value="<?= $data['id_departemen'] ?>"><?= $data['nama_departemen'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Tanggal Berakhir</label>
                <input type="date" name="tgl_berakhir" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Deskripsi Lowongan</label>
                <textarea name="deskripsi" id="tiny" cols="30" rows="10" class="form-control"></textarea>
            </div>


        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Simpan
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>