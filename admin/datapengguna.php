<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMOYAM IoT System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="coba.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            width: 100vw;
            background-color: #f2f2f2;
            color: #333;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
            padding-top: 150px;
        }

        .navbar-brand {
            font-size: 40px;
            font-weight: bold;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .card-header {
            font-size: 28px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-header img {
            margin-right: 10px;
            width: 60px;
            height: 60px;
        }

        .card-body h2 {
            font-size: 48px;
            margin: 0;
        }

        .form-check-label {
            font-size: 28px;
        }

        .card {
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .container {
            position: relative; /* Menambahkan posisi relatif */
            transition: transform 0.3s ease-in-out; /* Menambahkan transisi untuk transform */
        }

        .sidebar.active + .container {
            transform: translateX(250px); /* Menggeser konten ketika sidebar aktif */
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #fff;
            overflow-x: hidden;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            /* transition: 0.3s; */
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar .profile-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar .profile-info img {
            border-radius: 50%;
            width: 60px;
            height: 60px;
        }

        .sidebar .profile-info h3 {
            margin: 10px 0 0;
            font-size: 20px;
        }

        .sidebar a {
            text-decoration: none;
            font-size: 18px;
            color: #333;
            display: block;
            width: 100%;
            padding: 10px 20px;
            box-sizing: border-box;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #f2f2f2;
        }

        .sidebar .logout {
            margin-top: auto;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .sidebar .logout img {
            margin-right: 10px;
        }

        .menu-toggle {
            position: fixed;
            top: 15px;
            left: 15px;
            font-size: 30px;
            cursor: pointer;
            z-index: 1000;
        }

        .menu-toggle .bar {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 5px 0;
            transition: 0.4s;
        }

        .menu-toggle.active .bar:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active .bar:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .menu-toggle.active .bar:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        .welcome-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: #ffc107;
            transition: transform 0.5s, opacity 0.5s;
            width: 100vw;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 500;
        }

        .welcome-container img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-right: 20px;
        }

        .welcome-text {
            text-align: center;
        }

        .welcome-text h3 {
            margin: 0;
            font-size: 32px;
        }

        .welcome-text p {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .welcome-container.hidden {
            transform: translateY(-100%);
            opacity: 0;
        }

        .card img {
            width: 60px;
            height: 60px;
        }
    </style>
    <script src="../jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            setInterval(function () {
                $("#ceksuhu").load('ceksuhu.php');
                $("#cekkelembaban").load('cekkelembaban.php');
            }, 1000);
        });

        function ubahstatus(value) {
            var lampStatus = document.getElementById("lampStatus");
            lampStatus.textContent = value ? "ON" : "OFF";

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

        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
            document.querySelector(".welcome-container").classList.toggle("hidden");
            document.querySelector(".menu-toggle").classList.toggle("active");
        }
    </script>
</head>
<body>
    <div class="menu-toggle" onclick="toggleSidebar()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="profile-info">
            <?php 
            function getUsername() {
                if (isset($_SESSION['username'])) {
                    return htmlspecialchars($_SESSION['username']);
                } else {
                    return "Guest";
                }
            }
            ?>
            <img src="bg/a.jpg?= <?= getUsername() ?>" alt="Profile Picture">
            <h3><?= getUsername() ?></h3>
        </div>

        <a href="index.php">DASHBOARD</a>
        <!-- <a href="datapengguna.php">DATA PENGGUNA</a> -->
        <a class="logout" href="logout.php" onclick="return confirm('Ingin Logout ?');">
            <img src="https://img.icons8.com/ios-filled/50/000000/exit.png" alt="Logout Icon" width="20" height="20"> Logout
        </a>
    </div>

    <div class="container">
            <div class="welcome-container">
                <div class="welcome-text">
                    <h3>DATA PENGGUNA</h3>
                </div>
            </div>
        <?php 
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