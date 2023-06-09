<?php 
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM t_user WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama'] = $row['nama'];
        #echo "Login berhasil";
        header("Location: masuk.php");
        exit();
    } else {
        echo "Login gagal. Periksa kembali username dan Password Anda.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" a href="css/bootstrap.css">
    <title>Document</title>
</head>
<body style="background-color: #2f4f4f;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
            <div class="card mt-5">
                <div class="card-title">
                    <h3 class="bg-dark text-white text-center py-3">Login username</h3>
                </div>
                <div class="card-body">
                    <form action="login.php" method="post">
                    <fieldset style="width: min-content;">
                        <label for="username"> Username :</label>
                        <input type="text" name="username" id="username" placeholder="username"><br>
                        <label for="password"> Password :</label>
                        <input type="text" name="password" id="password" placeholder="Password"><br>
                    </fieldset>
                    <input style="margin-left: 85%; margin-top: 3%;" class="bg-dark text-white text-center py-0" type="submit" name="submit" id="submit" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>