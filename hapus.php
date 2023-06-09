<?php 
session_start();
include 'koneksi.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $query = "DELETE FROM t_barang WHERE idbarang = '$id'";
    $result = $conn->query($query);

    if ($result) {
        header("Location: data.php");
    } else {
        echo "Terjadi kesalahan saat menghapus data.";
    }
}
?>
