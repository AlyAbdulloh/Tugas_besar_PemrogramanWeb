<?php
    include '../koneksi.php';
    session_start();
    $id_user = $_SESSION['id_user'];

    if(isset($_POST['simpan'])){

        $firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($connect, $_POST['lastname']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $username = mysqli_real_escape_string($connect, $_POST['username']);

        $sql = "UPDATE user set firstname='$firstname', lastname='$lastname', email='$email', username='$username' WHERE id_user='$id_user'";
        $hasil = mysqli_query($connect, $sql);
        if($hasil){
            $_SESSION['user_name'] = $firstname;
            header('location:../index.php');
        }else{
            echo "gagal";
        }

    }
?>