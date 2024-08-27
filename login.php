<?php 
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){

    $user = $_POST['username'];
    $pass = md5($_POST['password']); // Menggunakan MD5 untuk hashing password

    $data_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$user' AND password = '$pass'");

    if(mysqli_num_rows($data_user) === 1){
        
        $r = mysqli_fetch_assoc($data_user);

        $_SESSION['status'] = "login";
        $_SESSION['username'] = $user;

        if($r['level'] === 'admin'){
            header('location:admin/index.php');
        } elseif($r['level'] === 'user'){
            header('location:user/index.php');
        } elseif($r['level'] === 'owner'){
            header('location:owner/index.php');
        } else {
            echo "Level tidak dikenal.";
        }
    } else {
        header("Location: index1.php?pesan=gagal"); // Username atau password salah
    }
}
?>