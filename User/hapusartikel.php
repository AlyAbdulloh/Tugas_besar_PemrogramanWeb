<?php
    include '../koneksi.php';

    $id_artikel = $_GET['id_artikel'];
    $gambar_artikel = $_GET['gambar_artikel'];

    $sql = "DELETE FROM artikel WHERE id_artikel = '$id_artikel'";
    $hasil = mysqli_query($connect, $sql);
    if($hasil){
        unlink("../Gambar/Gambar_Artikel/".$gambar_artikel);
        header('location:myartikel.php');
    }else{
        echo "gagl";
    }
?>