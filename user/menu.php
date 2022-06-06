<?php

include '../koneksi.php';

session_start();

// cek apakah user sudah login sesuai role apa blom
if ($_SESSION["role"] != "user") {
    // alihkan ke halaman login
    header('Location:../index.php');
}

$nama_menu = $_GET['nama_menu'];
$result = mysqli_query($conn, "SELECT * FROM menu WHERE nama_menu='$nama_menu'");

while ($data = mysqli_fetch_assoc($result)) {
    $nama_menu = $data['nama_menu'];
    $harga = $data['harga'];
}

if (isset($_POST['submit'])) {
    $pemesan = $_POST['pemesan'];
    $no_telepon = $_POST['no_telepon'];
    $layanan = $_POST['layanan'];
    $berat = $_POST['berat'];
    $address = $_POST['address'];
    $harga = $_POST['harga'];
    $status = 'on progress';

    $sql = "INSERT INTO rekap(pemesan, no_telepon, layanan, berat, address, harga, status) 
            VALUES('$pemesan', '$no_telepon', '$layanan', '$berat', '$address', $harga, '$status')";

    $result = mysqli_query($conn, $sql);

    header('Location: ./index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?= $nama_menu; ?> | Bersihin</title>
</head>
<style>
    ::-webkit-scrollbar {
        display: none;
    }
</style>

<body class="bg-light">

    <div class="container-fluid">
        <div class="row d-flex flex-column align-items-center justify-content-center text-light" style="background: navy; height: 20vh;">
            <div class="col-12">
                <h4 class="mb-0"><?= $nama_menu; ?></h4>
                <p>Layanan</p>
            </div>
        </div>

        <div class="row p-3">
            <div class="col-12">
                <h4></h4>
                <div class="card">
                    <div class="card-header d-flex p-3 align-items-center justify-content-between alert-info">
                        <h6 class="mb-0">Order Service</h6>
                        <button class="btn btn-success">
                            Rp. <?= number_format($harga, 0, ',', '.'); ?>
                        </button>
                    </div>

                    <div class="card-body mb-3">
                        <form action="" method="POST">
                            <input type="hidden" name="harga" value="<?= $harga; ?>">
                            <label for="Pemesan">Pemesan :</label>
                            <input type="text" name="pemesan" class="form-control mb-2" id="pemesan" readonly value="<?= $_SESSION['username'] ?>">

                            <label for="no_telepon">No. Telepon :</label>
                            <input type="text" name="no_telepon" class="form-control mb-2" id="no_telepon" readonly value="<?= $_SESSION['no_telepon'] ?>">

                            <label for="layanan">Layanan :</label>
                            <input type="text" name="layanan" class="form-control mb-2" id="layanan" readonly value="<?= $nama_menu; ?>">

                            <label for="berat">Berat :</label>
                            <?php
                            if ($nama_menu == 'Bersihin Aja') {
                                echo '<input type="text" name="berat" class="form-control mb-2" id="berat" readonly value="< 5 KG">';
                            } else {
                                echo '<input type="text" name="berat" class="form-control mb-2" id="berat" readonly value="< 10 KG">';
                            }
                            ?>

                            <label for="address">Address :</label>
                            <input type="text" name="address" class="form-control mb-2" id="address" value="<?= $_SESSION['address'] ?>">

                            <button type="submit" name="submit" class="btn btn-success mt-3" style="width: 100%;">Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/feather-icons"></script>

    <script>
        feather.replace()
    </script>
</body>

</html>