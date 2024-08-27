<?php
include ('../koneksi.php');

//baca data
    $suhu = $_GET['suhu'];
    $kelembaban = $_GET['kelembaban'];

//simpan ke tb sensor
    mysqli_query($koneksi, "ALTER TABLE tb_sensor AUTO_INCREMENT=1 ");
    
    $simpan = mysqli_query($koneksi, "insert into tb_sensor (suhu,kelembaban) values ('$suhu','$kelembaban')");

//uji simpann
    if($simpan){
        echo "berhasil dikirim";
    }else{
        echo "gagal terkirim";
    }

?>