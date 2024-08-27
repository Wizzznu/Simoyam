<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IoT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            width: 100%;
            margin: 0 auto;
            text-align: center;
        }
    </style>
    <script type="text/javascript" src="jquery/jquery.min.js"></script>
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
    <div class="container">
        <div class="row justify-content-center">
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand col text-center" href="#">
                        <h2>PROJECT WEB</h2>
                        <h3>Sistem Monitoring Suhu dan Penghangat Kandang Anak Ayam</h3>
                    </a>
                </div>
            </nav>

            <div class="card col-md-5" style="margin-right: 15px;">
                <div class="card-header bg-info" style="font-size: 30px; font-weight: bold">
                    SUHU
                </div>
                <div class="card-body">
                    <h2><span id="ceksuhu">0</span></h2>
                </div>
            </div>

            <div class="card col-md-5" style="margin-left: 15px;">
                <div class="card-header bg-info" style="font-size: 30px; font-weight: bold">
                    KELEMBABAN
                </div>
                <div class="card-body">
                    <h2><span id="cekkelembaban">0</span></h2>
                </div>
            </div>
            <div>
                <br>
                <br>
            </div>

            <div class="card text-black mb-3" style="width: 20rem;">
                <div class="card-header" style="font-size: 30px; text-align: center; background-color: red; color: white;">LAMPU</div>
                <div class="card-body" style="font-size: 50px; text-align: center;">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onchange="ubahstatus(this.checked)">
                        <label class="form-check-label" for="flexSwitchCheckDefault"> <span id="lampStatus">OFF</span></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
