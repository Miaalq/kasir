<?php
require_once '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namalengkap = $_POST["namalengkap"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmpassword"];

    if ($password == $confirmPassword) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username, password) VALUES ('$username', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Kata Sandi tidak cocok.";
    }

    $conn->close();
}
?>
