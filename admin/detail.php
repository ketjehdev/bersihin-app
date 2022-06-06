<?php

include '../koneksi.php';

session_start();

// cek apakah user sudah login sesuai role apa blom
if ($_SESSION["role"] != "admin") {
    // alihkan ke halaman login
    header('Location:../index.php');
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM rekap WHERE id='$id'");

while ($data = mysqli_fetch_assoc($result)) {
    $id = $data['id'];
    $pemesan = $data['pemesan'];
    $no_telepon = $data['no_telepon'];
    $layanan = $data['layanan'];
    $harga = $data['harga'];
    $berat = $data['berat'];
    $address = $data['address'];
    $status = $data['status'];
    $created_at = $data['created_at'];
}

if (isset($_POST['done'])) {
    $id = $_POST['id'];

    $result = mysqli_query($conn, "UPDATE rekap SET status='done' WHERE id=$id");

    header('Location:./report.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?= $pemesan; ?> | <?= $layanan; ?></title>
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
                <h4 class="mb-0"><?= $pemesan; ?></h4>
                <p><?= $layanan; ?></p>
            </div>
        </div>

        <div class="row p-3">
            <div class="col-12">
                <h4></h4>
                <div class="card">
                    <div class="card-header d-flex p-3 align-items-center justify-content-between alert-info">
                        <h6 class="mb-0">Billing Information</h6>
                        <div class="d-flex">
                            <?php
                            if ($status == 'on progress') {
                                echo '<button class="mx-2 btn btn-warning">' . $status . '</button>';
                            } else {
                                echo '<button class="mx-2 btn btn-success text-light">' . $status . '</button>';
                            }
                            ?>
                            <button class="btn btn-success">
                                Rp. <?= number_format($harga, 0, ',', '.'); ?>
                            </button>
                        </div>
                    </div>

                    <div class="card-body mb-3">
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <input type="hidden" name="harga" value="<?= $harga; ?>">
                            <label for="Pemesan">Pemesan :</label>
                            <input type="text" name="pemesan" class="form-control mb-2" id="pemesan" readonly value="<?= $pemesan; ?>">

                            <label for="no_telepon">No. Telepon :</label>
                            <input type="text" name="no_telepon" class="form-control mb-2" id="no_telepon" readonly value="<?= $no_telepon; ?>">

                            <label for="layanan">Layanan :</label>
                            <input type="text" name="layanan" class="form-control mb-2" id="layanan" readonly value="<?= $layanan; ?>">

                            <label for="berat">Berat :</label>
                            <input type="text" name="berat" class="form-control mb-2" id="berat" readonly value="<?= $berat; ?>">

                            <label for="address">Address :</label>
                            <input type="text" name="address" class="form-control mb-2" readonly q q id="address" value="<?= $address; ?>">

                            <label for="address">Di Pesan Pada :</label>
                            <input type="text" name="address" class="form-control mb-2" id="address" readonly value="<?= $created_at; ?>">

                            <?php
                            if ($status == 'on progress') {
                                echo '<button type="submit" name="done" class="btn btn-success mt-3" style="width: 100%;">Done</button>';
                            }
                            ?>
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