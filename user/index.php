<?php

include '../koneksi.php';

session_start();


// cek apakah user sudah login sesuai role apa blom
if ($_SESSION["role"] != "user") {
    // alihkan ke halaman login
    header('Location:../index.php');
}

// sql select all data
$sql = "SELECT * FROM menu";
// query all data users with connection database
$query = mysqli_query($conn, $sql);

// sql select rekap
$sql_menu = "SELECT * FROM rekap";
// query all data users with connection database
$query_menu = mysqli_query($conn, $sql_menu);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dashboard | Bersihin</title>
</head>
<style>
    nav {
        background: red;
        width: 100%;
        bottom: 0;
        background: #fff;
        box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.7);
        position: fixed;
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding: 5px 20px 5px 20px;
        z-index: 1;
    }

    nav a {
        text-decoration: none;
        color: navy;
    }

    nav a .aktif {
        color: red;
    }

    ::-webkit-scrollbar {
        display: none;
    }
</style>

<body class="bg-light">

    <nav>
        <div class="d-flex flex-column align-items-center" title="Home">
            <a href="./index.php">
                <i data-feather="home" class="aktif"></i>
            </a>
            <span style="font-size: 10px;">Home</span>
        </div>

        <div class="d-flex flex-column align-items-center" title="Home">
            <a href="./index.php">
                <i data-feather="file-text"></i>
            </a>
            <span style="font-size: 10px;">Transaksi</span>
        </div>

        <div class="d-flex flex-column align-items-center" title="Home">
            <a href="../logout.php">
                <i data-feather="log-out"></i>
            </a>
            <span style="font-size: 10px;">Keluar</span>
        </div>

    </nav>


    <div class="container-fluid">
        <div class="row d-flex flex-column align-items-center justify-content-center text-light" style="background: navy; height: 20vh;">
            <div class="col-12">
                <h4 class="mb-0">Hai, <?= $_SESSION['username'] ?></h4>
                <p>Selamat datang di Bersihin</p>
            </div>
        </div>

        <div class="row p-3">
            <div class="col-12">
                <h4>Dashboard</h4>
                <div class="card mb-4">
                    <div class="card-body d-flex justify-content-evenly">
                        <?php
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <div class="d-flex flex-column align-items-center">
                                <a href="menu.php?nama_menu=<?= $data['nama_menu'] ?>">
                                    <img src="../img/logo.png" style="width: 80px; height: 80px;">
                                </a>
                                <?php
                                if ($data['nama_menu'] == 'Bersihin Aja') {
                                    echo "<span class='px-3 mx-2 bg-primary text-light text-center' style='border-radius:12px'>" . $data['nama_menu'] . "</span>";
                                } else if ($data['nama_menu'] == 'Bersihin Kilat') {
                                    echo "<span class='px-3 mx-2 bg-danger text-light text-center' style='border-radius:12px'>" . $data['nama_menu'] . "</span>";
                                }
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex p-3 justify-content-between alert-info">
                        <h6 class="mb-0">History Transaksi</h6>
                        <a href="" style="text-decoration: none;">View All</a>
                    </div>
                    <div class="card-body mb-3">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center" style="white-space: nowrap;">
                                        <th>No.</th>
                                        <th>Layanan</th>
                                        <th>Berat</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php
                                    while ($data = mysqli_fetch_array($query_menu)) {
                                    ?>
                                        <tr class="text-center">
                                            <td><?= $no++; ?></td>
                                            <td><?= $data['layanan'] ?></td>
                                            <td><?= $data['berat'] ?></td>
                                            <td><?= $data['harga'] ?></td>
                                            <td><?= $data['status'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
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