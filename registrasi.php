<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>SMARTCHICK - Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: url('bg/ayam1.jpg') no-repeat center center fixed;
            background-size: cover;
            animation: slide 10s infinite alternate;
        }

        @keyframes slide {
            0% {
                background: url('bg/ayam1.jpg') no-repeat center center fixed;
                background-size: cover;
            }
            50% {
                background: url('bg/ayam2.jpg') no-repeat center center fixed;
                background-size: cover;
            }
            100% {
                background: url('bg/ayam3.jpg') no-repeat center center fixed;
                background-size: cover;
            }
        }

        .content {
            padding: 20px;
            text-align: center;
            font-size: 24px;
            color: white;
        }

        .container {
            position: relative;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            max-width: 500px;
            width: 90%;
            backdrop-filter: blur(10px);
        }

        .form_input {
            text-align: center;
            margin: auto;
        }

        h2 {
            font-size: 30px;
            font-weight: bold;
            color: #2575fc;
            margin-bottom: 30px;
        }

        label {
            font-size: 18px;
            color: #2c3e50;
        }

        .btn-custom {
            font-weight: bold;
            background-color: #2575fc;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #1b5bbf;
        }

        .alert {
            margin-top: 10px;
        }

        .form-control {
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .container {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="bg"></div>
    <div class="content"></div>
    <div class="container rounded border border-white" id="formRegistrasi" style="text-align: center;">
        <div style="text-align: center;">
            <h2 >REGISTRASI SIMOYAM</h2>
        </div>
        <div class="row">
            <div class="col-12 text-dark">
                <?php 
                if(isset($_GET['pesan'])){
                    if($_GET['pesan'] == "registrasi_gagal"){
                        echo "<div class='alert alert-danger'>Registrasi gagal! Silakan coba lagi.</div>";
                    }
                }
                ?>
                <form action="registrasi_handler.php" method="post" class="form_input">
                    <div class="panel-body">
                        <div class="form-group text-center p-2">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_user" required>
                        </div>
                        <div class="form-group text-center p-2">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group text-center p-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>  
                        <div class="text-center p-1">
                            <input type="submit" name="registrasi" class="btn btn-custom" value="Daftar">
                        </div>
                    </div>
                    <br/>
                </form>
                <div class="text-center">
                    <a href="index1.php" style="color:#2575fc; font-size: 14px;">Sudah punya akun? Login sekarang</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>