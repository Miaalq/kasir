<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            echo "Login berhasil!";
            $_SESSION['user'] = $row;
            if ($row['level']=='admin') {
                header("Location:admin/index.php");
            }else{
                header("Location:petugas/index.php");
            }

        } else {
            echo "Kata Sandi Salah.";
        }
    } else {
        echo "Pengguna tidak ditemukan.";
    }

    $conn->close();
}
?>
