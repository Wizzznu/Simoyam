<?php
session_start();


$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "tas2"; 

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Handle form submission
if (isset($_POST['registrasi'])) {
    // Periksa apakah semua input sudah diterima
    if (isset($_POST['nama_user'], $_POST['username'], $_POST['password'])) {
        $nama_user = $_POST['nama_user'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Menggunakan MD5 untuk hashing password
        $level = 'user'; // Level default untuk pengguna baru

        // Cek apakah username sudah terdaftar
        $check_query = "SELECT * FROM user WHERE username = ?";
        $stmt = $koneksi->prepare($check_query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Notifikasi username sudah terdaftar
            echo '<script>
                alert("Username sudah terdaftar. Silakan gunakan username lain.");
                window.location.href = "registrasi.php"; // Redirect ke halaman registrasi
            </script>';
            exit();
        }

        
        $stmt = $koneksi->prepare("INSERT INTO user (nama_user, username, password, level) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama_user, $username, $password, $level);

        if ($stmt->execute()) {
            
            echo '<script>
                alert("Anda berhasil registrasi");
            </script>';
            header("refresh:0;url=index1.php?pesan=registrasi_berhasil"); 
            exit();
        } else {
            
            header("Location: registrasi.php?pesan=registrasi_gagal");
            exit();
        }

        $stmt->close();
    } else {
        
        echo '<script>
            alert("Mohon lengkapi semua field.");
            window.location.href = "registrasi.php"; // Redirect ke halaman registrasi
        </script>';
        exit();
    }
}

mysqli_close($koneksi);
?>