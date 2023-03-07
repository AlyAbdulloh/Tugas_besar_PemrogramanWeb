<?php
    include '../koneksi.php';

    $id_kategori = $_GET['id_kategori'];
    $gambar = $_GET['gambar'];

    $cekartikel = "SELECT * FROM artikel WHERE id_kategori = '$id_kategori'";
    $hasil = mysqli_query($connect, $cekartikel);
    if(mysqli_num_rows($hasil) > 0){

        $i = 0; 
        while($data = mysqli_fetch_array($hasil)){ //peoses penghapusan gambar
            unlink("../Gambar/Gambar_Artikel/".$data['gambar_artikel']);
            $i++;
        }

        $delteartikel = "DELETE FROM artikel where id_kategori = '$id_kategori'";
        $hapus = mysqli_query($connect, $delteartikel);
        if($hapus){
            $sql = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
            $result = mysqli_query($connect, $sql);
            if($result){
                unlink("../Gambar/Gambar_Kategori/".$gambar);
                header('location:kategori.php');
            }

        }
    }else{
        $sql = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
        $result = mysqli_query($connect, $sql);
        if($result){
            unlink("../Gambar/Gambar_Kategori/".$gambar);
            header('location:kategori.php');
        }
    }
    
?>