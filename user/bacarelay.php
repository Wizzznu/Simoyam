<?php
include '../koneksi.php';

    $sql= mysqli_query($koneksi, "SELECT * FROM tb_kontrol");
    $data = mysqli_fetch_array($sql);
    $relay = $data['relay'];
        //kirim data ke NODEMCU
    echo $relay;

?>