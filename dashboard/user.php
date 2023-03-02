 <h1 class="h3 mb-4 text-gray-800">User</h1>

 <div class="card shadow mb-4">
     <div class="card-header py-3 d-flex align-items-center justify-content-between">
         <h6 class="m-0 font-weight-bold">Data User</h6>
         <a href="index.php?halaman=tambah-user" class="btn btn-primary">
             <i class="fas fa-plus"></i> Tambah User
         </a>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table id="dataTable" class="table table-bordered">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Nama</th>
                         <th>Username</th>
                         <th>Level</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $nomor = 1; ?>
                     <?php $ambil = $koneksi->query("SELECT * FROM user"); ?>
                     <?php while ($data = $ambil->fetch_assoc()) { ?>
                         <tr>
                             <td> <?php echo $nomor; ?></td>
                             <td> <?php echo $data["nama"]; ?> </td>
                             <td> <?php echo $data["username"]; ?> </td>
                             <td> <?php echo $data["level"]; ?> </td>
                             <td colspan="2">
                                 <a href="index.php?halaman=ubah-user&id=<?php echo $data['id_user']; ?>" class="btn btn-warning" title="">Edit</a>
                                 <a href="./proses/proses_user.php?aksi=hapus&username=<?php echo $data['username']; ?>" class="btn btn-danger btn-delete" title="">Delete</a>
                             </td>
                         </tr>
                         <?php $nomor++; ?>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>