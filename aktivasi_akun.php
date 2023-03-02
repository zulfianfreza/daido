<?php
session_start();
include './koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PT. Daido</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="" />
    <link rel="shortcut icon" href="">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
</head>

<body>
    <div class="min-vw-100 min-vh-100 d-flex align-items-center bg-light">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-4">
                    <div class="card p-4 shadow-sm">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <!-- <p class="fs-4 my-3 mb-5 fw-bold">RSU Khalishah</p> -->
                                <a href="./index.php">
                                    <img src="./assets/img/daido-logo.png" alt="" height="50px" class="my-3 mb-5">
                                </a>
                            </div>
                            <?php
                            $email = base64_decode($_GET['token']);
                            $query = mysqli_query($koneksi, "SELECT*FROM login_pelamar WHERE email='$email'");
                            $data = mysqli_fetch_assoc($query);
                            $query = mysqli_query($koneksi, "UPDATE login_pelamar SET status='1' WHERE email='$email'");
                            if ($query) {


                            ?>
                                <div class="alert alert-info">
                                    Akun <?= $data['email'] ?> telah aktif. Silahkan <a href="./login.php">Login</a>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
    if (isset($_SESSION['toast_type'])) {
        unset($_SESSION['toast_type']);
    }
    ?>


</body>

</html>