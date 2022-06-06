<?php

include '../koneksi.php';

session_start();

// cek apakah user sudah login sesuai role apa blom
if ($_SESSION["role"] != "admin") {
    // alihkan ke halaman login
    header('Location:../index.php');
}

$result = mysqli_query($conn, 'SELECT * FROM rekap');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
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
                <i data-feather="home"></i>
            </a>
            <span style="font-size: 10px;">Home</span>
        </div>

        <div class="d-flex flex-column align-items-center" title="Home">
            <a href="./transaksi.php">
                <i class="aktif" data-feather="file-text"></i>
            </a>
            <span style="font-size: 10px;">Transaksi</span>
        </div>

        <div class="d-flex flex-column align-items-center" title="Home">
            <a href="./report.php">
                <i data-feather="database"></i>
            </a>
            <span style="font-size: 10px;">Report</span>
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
                <h4>Transaction(s)</h4>

                <?php
                while ($data = mysqli_fetch_array($result)) {
                ?>

                    <a href="" style="text-decoration: none;">
                        <div class="card mb-3">
                            <div class="card-body d-flex p-3 justify-content-between alert-info">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0"><?= $data['pemesan']; ?></h6>
                                    <h6 class="mb-0">
                                        <?php
                                        if ($data['layanan'] == 'Bersihin Aja') {
                                            echo "<span class='text-primary'>" . $data['layanan'] . "</span>";
                                        } else {
                                            echo "<span class='text-danger'>" . $data['layanan'] . "</span>";
                                        }
                                        ?>
                                    </h6>
                                </div>

                                <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-success">Rp. <?= number_format($data['harga'], 0, ',', '.') ?></h6>
                                    <h6 class="mb-0">
                                        <?php
                                        if ($data['status'] == 'on progress') {
                                            echo "<span class='bg-warning px-2 text-light' style='border-radius:12px'>" . $data['status'] . "</span>";
                                        } else {
                                            echo "<span class='bg-success text-light px-2' style='border-radius:12px'>" . $data['status'] . "</span>";
                                        }
                                        ?>
                                    </h6>
                                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                    <h6 class="mb-0"><?= date('d M Y', strtotime($data['created_at'])); ?></h6>
                                </div>
                            </div>
                        </div>

                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/feather-icons"></script>

    <script>
        feather.replace()
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#report').DataTable();
        });
    </script>
</body>

</html>