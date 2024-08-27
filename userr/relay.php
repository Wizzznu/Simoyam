<?php
$koneksi = mysqli_connect("localhost", "root", "", "project23");

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Cek apakah parameter 'stat' ada
if (isset($_GET['stat'])) {
    $stat = $_GET['stat'];

    // Validasi nilai parameter 'stat'
    if ($stat === "ON" || $stat === "OFF") {
        // Menggunakan prepared statements
        $relayStatus = ($stat === "ON") ? 1 : 0;
        
        $stmt = mysqli_prepare($koneksi, "UPDATE tb_kontrol SET relay = ?");
        mysqli_stmt_bind_param($stmt, 'i', $relayStatus);

        if (mysqli_stmt_execute($stmt)) {
            echo $stat;
        } else {
            echo "Error updating record: " . mysqli_error($koneksi);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Parameter 'stat' tidak valid. Harus 'ON' atau 'OFF'.";
    }
} else {
    echo "Parameter 'stat' tidak ditemukan.";
}

mysqli_close($koneksi);
?>
