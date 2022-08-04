<?php

$server     = 'localhost';
$username   = 'root';
$password   = '';
$db         = '01-perpus-fiqri';

$koneksi = mysqli_connect($server,$username,$password,$db);

if (!$koneksi) {
    die('Koneksi Gagal');
}

?>