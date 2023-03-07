<?php
    include '../koneksi.php';
    session_start();

    if(isset($_POST['simpan'])){

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id_artikel = $_POST['id_artikel'];
        $judul_artikel = input($_POST['judul_artikel']);
        $isi_artikel = input($_POST['isi_artikel']);
        $id_kategori = $_POST['kategori'];
        $gambar_lama = $_POST['gambar_lama'];
        $gambar_baru = $_FILES['gambar_baru']['name'];
        $ekstensi_diperbolehkan	= array('png','jpg','gif','jpeg');
        $x = explode('.', $gambar_baru);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['gambar_baru']['size'];
        $file_tmp = $_FILES['gambar_baru']['tmp_name'];

        if(!empty($gambar_baru)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                unlink("../Gambar/Gambar_Artikel/".$gambar_lama);
                move_uploaded_file($file_tmp, '../Gambar/Gambar_Artikel/'.$gambar_baru);


                $tambah = "UPDATE artikel set
                           judul_artikel='$judul_artikel',
                           isi_artikel='$isi_artikel',
                           gambar_artikel = '$gambar_baru',
                           id_kategori='$id_kategori'
                           where id_artikel='$id_artikel'";
            }
        }else{
            $tambah = "UPDATE artikel set
            judul_artikel='$judul_artikel',
            isi_artikel='$isi_artikel',
            id_kategori='$id_kategori'
            where id_artikel='$id_artikel'";
        }

        $edit_artikel = mysqli_query($connect, $tambah);
        if($edit_artikel){
            $_SESSION['pesan_berhasil'] = "Data berhasil diedit";
            header('location:myartikel.php');
        }else{
            $_SESSION['pesan'] = "";
            echo "gagal";
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

        $id_artikel = $_GET['id_artikel'];
        $query = "SELECT * FROM artikel WHERE id_artikel = '$id_artikel'";
        $result = mysqli_query($connect, $query);
        $data = mysqli_fetch_array($result);
    ?>
    <div class="container mt-5">
        <form action="editartikel.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $data['id_artikel'];?>" name="id_artikel">
            <div class="mb-3 w-100">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="judul_artikel" value="<?php echo $data['judul_artikel']; ?>">
                    <label for="floatingInput">Judul Artikel</label>
                </div>
            </div>
            <div class="mb-3 w-100">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 300px;" name="isi_artikel"><?php echo $data['isi_artikel']; ?></textarea>
                    <label for="floatingTextarea">Isi Artikel</label>
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                <select class="form-select" id="inputGroupSelect01" name="kategori">
                <?php
                        
                        $sql="SELECT * FROM kategori order by id_kategori asc";
                        $hasil=mysqli_query($connect,$sql);
                        $no=0;
                        while ($kt = mysqli_fetch_array($hasil)):
                        $no++;
                ?>
                        <option  <?php if ($data['id_kategori']==$kt['id_kategori']) echo "selected"; ?> value="<?php echo $kt['id_kategori']; ?>"><?php echo $kt['nama_kategori']; ?></option>
                <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3 w-100">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" name="gambar_lama" value="<?php echo $data['gambar_artikel']; ?>">
                    <label for="floatingInput">Gambar Saat Ini</label>
                </div>
            </div>
            <div class="mb-3">
                <input class="form-control" type="file" id="formFileMultiple" multiple name="gambar_baru">
            </div>
            <!-- <button class="btn btn-primary" type="submit" name="tambah">Tambahkan</button> -->
            <input type="submit" name="simpan" value="simpan" id="btnl">
            <a href="artikel.php" class="btn btn-primary" style="margin-left: 10px;">Batal</a>

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