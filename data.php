<?php
session_start();
include 'koneksi.php';

// Fungsi untuk mendapatkan data barang berdasarkan ID
function getBarangById($id) {
    global $conn;
    $query = "SELECT * FROM t_barang WHERE idbarang = '$id'";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

// Mendapatkan semua data barang
$query = "SELECT * FROM t_barang";
$result = $conn->query($query);
$dataBarang = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dataBarang[] = $row;
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
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Data Barang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff
            
        }

        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            
        }
        table td a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #337ab7;
            border-radius: 3px;
        }
        .container{
    width: 100%;
    height: 100vh;
    background-position: center;
    background-size: cover;
    padding-left: 8%;
    padding-right: 8%;
    box-sizing: border-box;
}
h3{
    color: #fff;
    font-size: 50px;
}
    </style>
</head>
<body style="background-color: #2f4f4f;">
    <div class="container">
        <h3>Data Barang</h3>
        <table>
            <tr>
                <th>Nama</th>
                <th>ID Barang</th>
                <th>Tanggal Barang Masuk</th>
                <th>Tipe Barang</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($dataBarang as $barang) : ?>
            <tr>
                <td><?= $barang['nama']; ?></td>
                <td><?= $barang['idbarang']; ?></td>
                <td><?= $barang['tanggal']; ?></td>
                <td><?= $barang['tipeBarang']; ?></td>
                <td><?= $barang['keterangan']; ?></td>
                <td>
                    <a href="edit.php?edit=<?= $barang['idbarang']; ?>">Edit</a>
                    <a href="hapus.php?hapus=<?= $barang['idbarang']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
