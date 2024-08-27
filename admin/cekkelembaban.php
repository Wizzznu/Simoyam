<?php
include '../koneksi.php';
    //$koneksi= mysqli_connect("localhost","root","","tas2");

    $sql = mysqli_query($koneksi, "select * from tb_sensor order by id desc"); 

    $data = mysqli_fetch_array($sql);
    $kelembaban = $data['kelembaban'];

    if ($kelembaban == " "){
        $kelembaban = 0;
    };
    echo $kelembaban;
?>