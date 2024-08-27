<?php
include '../koneksi.php';
session_start();
session_destroy();

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



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IoT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="coba.css">
    <style>
        .container {
            width: 100%;
            margin: 0 auto;
            text-align: center;
        }
    </style>
    <script type="text/javascript" src="../jquery/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="../jquery/jquery.min.js"></script> -->
    <script type="text/javascript">
        $(document).ready(function () {
            setInterval(function () {
                $("#ceksuhu").load('ceksuhu.php');
                $("#cekkelembaban").load('cekkelembaban.php');
            }, 1000);
        });

        function ubahstatus(value) {
            var lampStatus = document.getElementById("lampStatus");
            if (value) {
                lampStatus.textContent = "ON";
            } else {
                lampStatus.textContent = "OFF";
            }

            console.log("Mengirim permintaan AJAX dengan nilai: " + value);

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    console.log("Respons dari server: " + xmlhttp.responseText);
                    document.getElementById('status').innerHTML = xmlhttp.responseText;
                } else if (xmlhttp.readyState == 4) {
                    console.error("Error: " + xmlhttp.status);
                }
            };
            xmlhttp.open("GET", "relay.php?stat=" + (value ? "ON" : "OFF"), true);
            xmlhttp.send();
        }
    </script>
</head>
<body>    

    <nav class="navbar" style="background-color: #ffd700;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="m-0">
                <span class="navbar-brand mb-0" style="font-size: 40px; font-weight: bold; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">SIMOYAM</span>
            </h1>
            <div class="row mb-0 text-center">
                <div class="col">
                    <a class="btn btn-danger mx-3" onclick="return confirm('Ingin Kembali ke Halaman Utama?');" href="index.php" role="button">Kembali</a>
                </div>
            </div>
        </div>
    </nav>
    
    <br>
    <div class="container">
        <h2>Daftar Pengguna</h2>    
        <?php session_start(); 
            if(isset($_GET['pesan'])){
                if($_GET['pesan'] == "berhasil_dihapus"){
                    echo "<div class='alert alert-danger'>Pengguna Berhasil di Hapus !</div>";
                }else if($_GET['pesan'] == "edit_berhasil"){
                    echo "<div class='alert alert-info'>Anda telah berhasil logout</div>";
                }else if($_GET['pesan'] == "belum_login"){
                    echo "<div class='alert alert-danger'>Anda harus login untuk mengakses halaman admin</div>";
                }else if($_GET['pesan'] == "registrasi_berhasil"){
                    echo "<div class='alert alert-info'>Anda telah berhasil logout, silahkan login lagi dengan akun yang baru dibuat</div>";
                }
            }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Username</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../koneksi.php';
                $sql = "SELECT * FROM user";
                $hasil = mysqli_query($koneksi,$sql);
                $nomer = 1;
                while($data = mysqli_fetch_array($hasil,MYSQLI_ASSOC)){
                ?>
                <tr>
                    <th scope="row"><?php echo $nomer++; ?></th>
                    <td><?php echo $data['nama_user']; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td>
                        <a class="btn btn-danger mx-3" onclick="return confirm('Ingin Menghapus data pengguna ?');" href="hapus.php?id=<?php echo $data['id']; ?>" role="button">Hapus</a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>