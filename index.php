<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include './koneksi.php';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$query = mysqli_query($koneksi, "SELECT*FROM login_pelamar WHERE email='$username'");
$check_user = mysqli_num_rows($query);
$user = mysqli_fetch_assoc($query);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Daido</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./assets/css/style.css">


</head>

<body>

    <div class="min-vh-100 d-flex flex-column bg-light">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="">
                    <img src="./assets/img/daido-logo.png" alt="" class="d-inline-block align-text-top" height="50px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="index.php?halaman=lowongan">Lowongan</a>
                        </li>
                    </ul>
                    <div class="d-flex gap-x-2">
                        <?php
                        if ($check_user > 0) {
                        ?>
                            <div class="dropdown">
                                <a class="dropdown-toggle text-decoration-none" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $user['nama'] ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="./dashboard/">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="./proses_autentikasi.php?aksi=logout">Logout</a></li>
                                </ul>
                            </div>
                        <?php
                        } else {
                        ?>
                            <a href="./login.php" class="btn btn-outline-primary me-2 ms-2" type="submit">Masuk</a>
                            <a href="./daftar.php" class="btn btn-primary" type="submit">Daftar</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>

        <?php
        $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : '';
        if ($halaman == '') {
            include './home.php';
        } else if ($halaman == 'lowongan') {
            include './lowongan.php';
        } else if ($halaman == 'detail-lowongan') {
            include './detail_lowongan.php';
        } else if ($halaman == 'kirim-lamaran') {
            include './kirim_lamaran.php';
        }
        ?>

        <div class="w-100 bg-dark text-white pt-5 pb-4 mt-auto">
            <div class="container">
                <p>Copyright &copy; PT. Daido Indonesia Manufacturing</p>
            </div>
        </div>

    </div>

</body>

</html>