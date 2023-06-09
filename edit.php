<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $idBarang = $_GET['edit'];
    $nama = $_POST['nama'];
    $tglBarangMasuk = $_POST['tanggal'];
    $tipeBarang = $_POST['tipeBarang'];
    $keterangan = $_POST['keterangan'];

    $tglBarangMasuk = date('Y-m-d', strtotime($tglBarangMasuk));

    $query = "UPDATE t_barang SET nama='$nama', tanggal='$tglBarangMasuk', tipeBarang='$tipeBarang', keterangan='$keterangan' WHERE idbarang='$idBarang'";
    $result = $conn->query($query);

    if ($result) {
        $_SESSION['success_message'] = "Data barang berhasil diperbarui.";
        header("Location: data.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Terjadi kesalahan saat memperbarui data barang.";
        exit();
    }
}

// Mendapatkan ID barang dari URL
$idBarang = $_GET['edit'];

// Mendapatkan data barang berdasarkan ID
$barang = getBarangById($idBarang);

// Fungsi untuk mendapatkan data barang berdasarkan ID
function getBarangById($idBarang) {
    global $conn;
    $query = "SELECT * FROM t_barang WHERE idbarang = '$idBarang'";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Document</title>
</head>
<body style="background-color: #2f4f4f;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
            <div class="card mt-5">
                <div class="card-title">
                    <h3 class="bg-dark text-white text-center py-3">Pendataan Barang Masuk</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                    <fieldset style="width: min-content;">
                        <label for="nama">Nama Barang: </label>
                        <input class="center" type="text" name="nama" id="nama" placeholder="Nama Barang" value="<?= $barang['nama']; ?>"><br>
                        <label for="tgl">Tanggal Barang Masuk </label>
                        <input type="date" name="tanggal" id="tgl" min="1987-01-01" max="2030-01-01" value="<?= $barang['tanggal']; ?>"><br>
                    </fieldset>
                    <fieldset style="width: max-content;">
                        <tr>
                            <td>Tipe Barang</td>
                            <td>:</td>
                            <td>
                                <input type="radio" name="tipeBarang" value="keras" id="keras" <?= $barang['tipeBarang'] == 'keras' ? 'checked' : ''; ?>/> Keras 
                                <input type="radio" name="tipeBarang" value="lunak" id="lunak" <?= $barang['tipeBarang'] == 'lunak' ? 'checked' : ''; ?>/> Lunak 
                            </td>
                        </tr><br>
                    </fieldset>
                    <script>
                        function disableRadio(radio) {
                            if (radio.checked) {
                                radio.onclick = function() {
                                    return false;
                                };
                            }
                        }
                    </script>
                    <fieldset style="width: min-content;">
                        <label for="nama"> Keterangan Barang : </label>
                        <input class="center" type="text" name="keterangan" id="keterangan" placeholder="Keterangan Barang" value="<?= $barang['keterangan']; ?>"><br>
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
