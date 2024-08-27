<?php
$koneksi = new mysqli("localhost", "root", "", "tas2");

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>
