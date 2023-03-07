<?php
    include '../koneksi.php';

    $id_user = $_GET['id_user'];
    $sql = "DELETE FROM user WHERE id_user = '$id_user'";
    $result = mysqli_query($connect, $sql);
    if($result){
        header('location:usermenu.php');
    }else{
        echo"
                <script>alert('gagal');</script>
            ";
    }
?>