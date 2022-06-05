<?php

include 'koneksi.php';
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $no_telepon = $_POST['no_telepon'];
    $address = $_POST['address'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
        $sql = "INSERT INTO users (username, password, no_telepon, address, role)
					VALUES ('$username', '$password', '$no_telepon', '$address', 'user')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header('Location: login.php');
        } else {
            echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }
    } else {
        echo "<script>alert('Woops! Username Already Exists.')</script>";
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
    <title>Register | Bersihin</title>
    <!-- end of title -->
</head>
<!-- end of head -->

<body oncontextmenu="return false;">
    <div class="banner d-flex" style="width: 100%; height: 100vh;">
        <div class="col-7 box-img bg-success" style="height: 120vh;">
            <img src="./img/register.jpg" class="bg">
        </div>
        <div class="col-5 forum d-flex flex-column align-items-center">
            <img src="./img/logo.png" alt="" class="bg_forum">
            <h3 class="mt-4 mb-0 text-center">Register</h3>

            <form data-aos="fade" data-aos-duration="1500" action="" method="POST" style="width: 100%;" class="mx-2 mt-5">
                <span>Username <span class="text-danger">*</span></span>
                <input type="text" autofocus class="form-control mb-4" required placeholder="Masukkan username kamu" name="username">

                <span>No. Telepon <span class="text-danger">*</span></span>
                <input type="text" class="form-control mb-4" required placeholder="Masukkan no telepon kamu" name="no_telepon">

                <span>Adress <span class="text-danger">*</span></span>
                <input type="text" class="form-control mb-4" required placeholder="Masukkan alamat kamu" name="address">

                <span>Password <span class="text-danger">*</span></span>
                <input type="password" class="form-control" required placeholder="Masukkan Password" name="password">

                <button class="btn btn-success mt-4" style="width: 100%;" name="submit">Free Register</button>
                <p class="text-center">Sudah mempunyai akun member? <br> <a href="login.php">Login sekarang</a></p>
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