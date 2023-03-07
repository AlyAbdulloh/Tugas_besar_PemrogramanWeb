<?php

    session_start();
    include '../koneksi.php';

    if(isset($_POST['tambah_kategori']) && isset($_FILES['gambar_kategori'])){
        $nama_kategori = $_POST['nama_kategori'];
        $ekstensi_diperbolehkan	= array('png','jpg','gif','jpeg');
        $gambar_kategori = $_FILES['gambar_kategori']['name'];
        $x = explode('.', $gambar_kategori);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['gambar_kategori']['size'];
        $file_tmp = $_FILES['gambar_kategori']['tmp_name'];

        if(!empty($gambar_kategori)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                move_uploaded_file($file_tmp, '../Gambar/Gambar_Kategori/'.$gambar_kategori);

                $sql="INSERT into kategori (nama_kategori,gambar_kategori) values
                    ('$nama_kategori','$gambar_kategori')";
                
                $simpan_kategori = mysqli_query($connect, $sql);
                if($simpan_kategori){
                    $_SESSION['alert'] = "Kategori '".$nama_kategori."' berhasil ditambahkan";
                    header('location:kategori.php'); 
                }else{
                    mysqli_error($connect); 
                }
            }
        }
    }
?>