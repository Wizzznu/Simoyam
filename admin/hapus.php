<?php
include '../koneksi.php';
session_start();

$id = $_GET['id'];
$sql = "DELETE FROM user WHERE id='$id'";

if (mysqli_query($koneksi, $sql)) {
    header("Location: datapengguna.php?pesan=berhasil_dihapus");
    exit(); 
} else {
    echo "<script type='text/javascript'>
            alert('Data Gagal Dihapus!');
            location.replace('datapengguna.php');
          </script>";
}

mysqli_close($koneksi);
?>
