<?php
include '../koneksi.php';
    //$koneksi= mysqli_connect("localhost","root","","tas2");

    $sql = mysqli_query($koneksi, "select * from tb_sensor order by id desc"); 

    $data = mysqli_fetch_array($sql);
    $suhu = $data['suhu'];

    if ($suhu == " "){
        $suhu = 0;
    };
    echo $suhu;
?>