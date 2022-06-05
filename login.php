<?php
include 'koneksi.php';

session_start();

if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: ./admin/index.php");
    } else {
        header("Location: ./user/index.php");
    }
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek pw
        $item = mysqli_fetch_assoc($result);

        if ($item['password'] == $password) {
            if ($item['role'] == "admin") {
                $_SESSION["username"] = $item['username'];
                $_SESSION["no_telepon"] = $item['no_telepon'];
                $_SESSION["address"] = $item['address'];
                $_SESSION["role"] = $item['role'];
                header("Location: ./admin/index.php");
            } else {
                $_SESSION["username"] = $item['username'];
                $_SESSION["no_telepon"] = $item['no_telepon'];
                $_SESSION["address"] = $item['address'];
                $_SESSION["role"] = $item['role'];
                header("Location: ./user/index.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- head -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- cdn bootstrap 5 link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- end cdn bootstrap 5 link -->

    <!-- link login css -->
    <link rel="stylesheet" href="./css/auth.css">
    <!-- end of link login css -->

    <!-- AOS link -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- end of AOS link -->

    <!-- title of cafe shop app -->
    <title>Login | Bersihin</title>
    <!-- end of title -->
</head>
<!-- end of head -->

<body oncontextmenu="return false;">



    <div class="banner d-flex" style="width: 100%; height: 100vh;">

        <div class="col-7 box-img bg-primary">
            <img src="./img/login2.jpg" alt="login.bg" class="bg">
        </div>

        <div class="col-5 forum d-flex flex-column align-items-center">
            <img src="./img/logo.png" alt="" class="bg_forum">
            <h3 class="mt-4 mb-0 text-center">Login</h3>

            <?php if (isset($error)) : ?>
                <span class="text-danger alert alert-danger mb-0">username atau password salah</span>
            <?php endif; ?>

            <form action="" method="POST" style="width: 100%;" class="mx-2 mt-5">

                <span>Username <span class="text-danger">*</span></span>
                <input type="text" class="form-control mb-4" autofocus required placeholder="Masukan username kamu" name="username">

                <span>Password <span class="text-danger">*</span></span>
                <input type="password" class="form-control" required placeholder="Masukan password kamu" name="password">

                <button class="btn btn-primary mt-4" style="width: 100%;" name="submit">Masuk</button>
                <p class="text-center">Belum mempunyai akun? <br> <a href="register.php">daftar sekarang!</a></p>
            </form>
        </div>
    </div>

    <!-- script cdn bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- end of script cdn bootstrap 5 -->

    <!-- script AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- end of script AOS -->

    <!-- function script AOS -->
    <script>
        AOS.init();
    </script>
    <!-- end of function script AOS -->
</body>

</html>