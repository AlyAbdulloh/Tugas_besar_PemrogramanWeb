<?php
    include '../koneksi.php';

    $id_user = $_GET['id_user'];

    $sql = "SELECT * FROM artikel WHERE id_user = '$id_user'";
    $hasil = mysqli_query($connect, $sql);
    if(mysqli_num_rows($hasil) > 0){
        $i = 0; 
        while($data = mysqli_fetch_array($hasil)){ 
            $sqlu = "UPDATE artikel set id_user = 2 WHERE id_user = '$id_user'";
            mysqli_query($connect, $sqlu);
            $i++;
        }

        $que = "DELETE FROM user WHERE id_user = '$id_user'";
        $result = mysqli_query($connect, $que);
        if($result){
            header('location:usermenu.php');

        }else{
            echo "gagal";
        }
    }else{
        $que = "DELETE FROM user WHERE id_user = '$id_user'";
        $result = mysqli_query($connect, $que);
        if($result){
            header('location:usermenu.php');

        }else{
            echo "gagal";
        }
    }
?>