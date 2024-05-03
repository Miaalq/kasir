<?php
require_once '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if ($password == $konfirmasi_password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (username, password, level) VALUES ('$username', '$hashedPassword', 'petugas')";

    if ($conn->query($query) === TRUE) {
        header("Location:data-petugas.php");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
}
