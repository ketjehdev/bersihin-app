<?php
session_start();

// cek apakah user sudah login sesuai role apa blom
if ($_SESSION["role"] != "user") {
    // alihkan ke halaman login
    header('Location:../index.php');
}
