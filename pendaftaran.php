<?php 
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];

    $checkQuery = "SELECT * FROM t_user WHERE username='$username'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "Username sudah terdaftar. Silakan gunakan username lain.";
    } else {
        $insertQuery = "INSERT INTO t_user (username, password, nama) VALUES ('$username', '$password', '$nama')";

        if ($conn->query($insertQuery) === TRUE) {
            $_SESSION['registration_success'] = true; 
            header("Location: login.php");
            exit();
        } else {
            echo "Terjadi kesalahan saat registrasi: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta nama$nama="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" a href="css/bootstrap.css">
    <title>Document</title>
</head>
<body style="background-color: #2f4f4f;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
            <div class="card mt-5">
                <div class="card-title">
                    <h3 class="bg-dark text-white text-center py-3">Pendaftaran User Data Barang</h3>
                </div>
                <div class="card-body">
                    <form action="pendaftaran.php" method="post">
                    <fieldset style="width: min-content;">
                        <label for="nama"> Nama : </label>
                        <input class="center" type="text" name="nama" id="nama" placeholder="Nama Lengkap"><br>
                        <label for="Barang"> Username :</label>
                        <input type="text" name="username" id="username" placeholder="Username"><br>
                        <label for="Barang"> Password :</label>
                        <input type="text" name="password" id="password" placeholder="Password"><br>
                    </fieldset>
                    <input style="margin-left: 85%; margin-top: 3%;" class="bg-dark text-white text-center py-0" type="submit" name="submit" id="submit" value="Daftar">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>