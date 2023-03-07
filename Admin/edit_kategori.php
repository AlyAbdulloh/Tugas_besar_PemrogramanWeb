<?php
    include '../koneksi.php';

    if(isset($_POST['edit_kategori'])){

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id_kategori = $_POST['id_kategori'];
        $nama_kategori = input($_POST['nama_kategori']);
        $gambar_lama = $_POST['gambar_lama'];
        $gambar_baru = $_FILES['gambar_baru']['name'];
        $ekstensi_diperbolehkan	= array('png','jpg','gif','jpeg');
        $x = explode('.', $gambar_baru);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['gambar_baru']['size'];
        $file_tmp = $_FILES['gambar_baru']['tmp_name'];

        if(!empty($gambar_baru)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                unlink("../Gambar/Gambar_Kategori/".$gambar_lama);
                move_uploaded_file($file_tmp, '../Gambar/Gambar_Kategori/'.$gambar_baru);


                $tambah = "UPDATE kategori set
                           nama_kategori='$nama_kategori',
                           gambar_kategori = '$gambar_baru'
                           where id_kategori='$id_kategori'";
            }
        }else{
            $tambah = "UPDATE kategori set
            nama_kategori='$nama_kategori'
            where id_kategori='$id_kategori'";
        }

        $edit_kategori = mysqli_query($connect, $tambah);
        if($edit_kategori){
            header('location:kategori.php');
        }else{
            echo "gagal".msqli_error($connect);
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
        include '../koneksi.php';

        $id_kategori = $_GET['id_kategori'];
        $query = "SELECT * FROM kategori WHERE id_kategori = '$id_kategori'";
        $result = mysqli_query($connect, $query);
        $data = mysqli_fetch_array($result);
    ?>
    <div class="container mt-5">
        <form action="edit_kategori.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $data['id_kategori'];?>" name="id_artikel">
            <div class="mb-3 w-100">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nama_kategori" value="<?php echo $data['nama_kategori']; ?>">
                    <label for="floatingInput">Nama Kategori</label>
                </div>
            </div>
            <div class="mb-3 w-100">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" name="gambar_lama" value="<?php echo $data['gambar_kategori']; ?>">
                    <label for="floatingInput">Gambar Saat Ini</label>
                </div>
            </div>
            <div class="mb-3">
                <input class="form-control" type="file" id="formFileMultiple" multiple name="gambar_baru">
            </div>
            <!-- <button class="btn btn-primary" type="submit" name="tambah">Tambahkan</button> -->
            <input type="submit" name="edit_kategori" value="simpan" id="btnl">
            <a href="kategori.php" class="btn btn-primary" style="margin-left: 10px;">Batal</a>

        </form>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>
</html>