<?php

// koneksi
$conn = mysqli_connect('localhost', 'root', '', 'bersihin');

if (!$conn) {
    echo die('connection error');
}
