<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>SIMOYAM IoT System</title>
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
            background-image: url('bg/ayam1.jpg'); /* Ganti dengan path gambar latar belakang Anda */
            background-size: cover;
            background-position: center;
            animation: slide 10s infinite alternate;
        }

        @keyframes slide {
            from { background-position: 0 0; }
            to { background-position: -100% 0; }
        }

        .content {
            padding: 20px;
            text-align: center;
            font-size: 24px;
            color: #333;
        }

        .container {
            position: relative;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.85); /* Warna latar belakang tembus pandang */
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px; /* Menambah margin atas */
        }

        #deskripsi {
            margin-top: 20px;
            padding: 20px;
        }

        .carousel-item img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        h3 {
            font-size: 28px;
            font-weight: bold;
            color: #2575fc;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
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

        /* CSS for portrait mode warning */
        #orientation-warning {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            color: white;
            text-align: center;
            z-index: 1000;
            font-size: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #orientation-warning img {
            max-width: 50%;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="bg"></div>
    <div id="orientation-warning">
        <img src="bg/T.png" alt="Logo Horizontal">
        Please rotate your device to landscape mode to continue.
    </div>
    <div class="content">
        <div class="container rounded" id="deskripsiAyam">
            <div class="row">
                <div class="col-md-6">
                    <h1 style="color: black; font-size: 50px; font-weight: bold;">SIMOYAM</h1>
                    <hr>
                    <h3>Deskripsi Project</h3>
                    <p>Si Monitoring Kandang Ayam (SIMOYAM) adalah sebuah inovasi dalam peternakan modern yang bertujuan untuk meningkatkan efisiensi dan kesejahteraan anak ayam. Dengan menggunakan teknologi canggih, kandang ini dilengkapi dengan berbagai sistem pemantauan lingkungan dan kontrol pencahayaan. Sistem ini memungkinkan peternak untuk memantau kondisi lingkungan di dalam kandang secara real-time, seperti suhu dan kelembaban, serta mengontrol pencahayaan sesuai kebutuhan ayam.</p>
                    <div class="text-center">
                        <a href="index1.php" class="btn btn-custom">Klik untuk login</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="bg/ayam2.jpg" class="d-block w-100" alt="Ayam 1">
                            </div>
                            <div class="carousel-item">
                                <img src="bg/ayam3.jpg" class="d-block w-100" alt="Ayam 2">
                            </div>
                            <div class="carousel-item">
                                <img src="bg/ayam4.jpg" class="d-block w-100" alt="Ayam 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function checkOrientation() {
            if (window.innerHeight > window.innerWidth) {
                document.getElementById('orientation-warning').style.display = 'flex';
            } else {
                document.getElementById('orientation-warning').style.display = 'none';
            }
        }

        window.addEventListener('resize', checkOrientation);
        window.addEventListener('load', checkOrientation);
    </script>
</body>
</html>
