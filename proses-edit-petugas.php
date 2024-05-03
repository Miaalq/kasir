<?php
require_once '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];
    $id_user = $_POST['id_user'];

    $sql = "SELECT * FROM user WHERE id_user = '$id_user'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    $query_update = "UPDATE user SET username='$username'";
    if ($user['username'] != $username) {
        // Cek Username apakah sudah ada atau belum
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '<script>
            alert("Username ' . $username . ' sudah ada.");
            window.location.href = "data-petugas-edit.php?id=' . $id_user . '";
          </script>';
            die;
        }
    }

    if ($password != '') {
        if ($password == $konfirmasi_password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query_update .= ", password='$hashedPassword'";
        }
    }

    $query_update .= " WHERE id_user=$id_user";
    if ($conn->query($query_update) === TRUE) {
        echo '<script>
        alert("Berhasil melakukan edit data petugas");
        window.location.href = "data-petugas.php";
      </script>';
        die;
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
