<!DOCTYPE html>
<html lang="en">

<?php
session_start()
?>

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
                            <?php if (isset($_SESSION['toast_type'])) {
                            ?>

                                <div class="alert <?= $_SESSION['toast_type'] == 'success' ? 'alert-success' : 'alert-danger' ?>"><?= $_SESSION['toast_message'] ?></div>

                            <?php } ?>
                            <form action="./proses_autentikasi.php?aksi=daftar" method="POST">
                                <div class="mb-3">
                                    <input type="text" class="form-control py-2" placeholder="Name" name="nama" value="">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control py-2" placeholder="Email" name="email" value="">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control py-2 border-end-0" placeholder="Password" name="password" id="password">
                                    <span class="input-group-text bg-transparent border-start-0">
                                        <i class="far fa-eye" id="toggle" onclick="togglePassword()" style="cursor: pointer"></i>
                                    </span>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label text-secondary" for="exampleCheck1">Biarkan saya login</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Daftar</button>
                            </form>
                            <div class="mt-3 d-flex justify-content-center">
                                <p class="text-secondary">Sudah punya akun pelamar? <a href="./login.php" class="tr-text-primary">Masuk</a></p>
                                <!-- <a href="./login.php">Buat Akun Pelamar.</a> -->
                            </div>
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

    <script>
        function togglePassword() {


            const toggle = document.getElementById("toggle");
            const password = document.getElementById("password");

            // toggle.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the eye icon
            toggle.classList.toggle('fa-eye');
            toggle.classList.toggle('fa-eye-slash');
            // });
        }
    </script>

</body>

</html>