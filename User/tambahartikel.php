<?php
    include '../koneksi.php';
    session_start();

    if(isset($_POST['tambah']) && isset($_FILES['gambar_artikel'])){

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        date_default_timezone_set('Asia/Jakarta');
        $judul_artikel = input($_POST['judul_artikel']);
        $isi_artikel = input($_POST['isi_artikel']);
        $tanggal_upload = date("Y-m-d H:i:s");
        $id_kategori = $_POST['kategori'];
        $id_user = $_SESSION['id_user'];
        $ekstensi_diperbolehkan	= array('png','jpg','gif','jpeg');
        $gambar_artikel = $_FILES['gambar_artikel']['name'];
        $x = explode('.', $gambar_artikel);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['gambar_artikel']['size'];
        $file_tmp = $_FILES['gambar_artikel']['tmp_name'];

        if(!empty($gambar_artikel)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                move_uploaded_file($file_tmp, '../Gambar/Gambar_Artikel/'.$gambar_artikel);

                $sql = "INSERT INTO artikel (judul_artikel, isi_artikel, gambar_artikel, tanggal_upload, id_kategori, id_user)
                        VALUES('$judul_artikel', '$isi_artikel', '$gambar_artikel', '$tanggal_upload', '$id_kategori', '$id_user')";
                
                $simpan_artikel = mysqli_query($connect, $sql);
                if($simpan_artikel){
                    header('location:../index.php');
                }else{
                    echo "
                        <script>
                            alert(' gagal..');
                        </script>
                    ";
                }
            }
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
    <div class="container mt-5">
        <form action="tambahartikel.php" method="post" enctype="multipart/form-data">
            <div class="mb-3 w-100">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="judul_artikel">
                    <label for="floatingInput">Judul Artikel</label>
                </div>
            </div>
            <div class="mb-3 w-100">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 300px;" name="isi_artikel"></textarea>
                    <label for="floatingTextarea">Isi Artikel</label>
                </div>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                <select class="form-select" id="inputGroupSelect01" name="kategori">
                <?php
                    include '../koneksi.php';

                    $sql = "SELECT * FROM kategori";
                    $result = mysqli_query($connect, $sql);

                    while($data = mysqli_fetch_array($result)):
                ?>
                    <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <input class="form-control" type="file" id="formFileMultiple" multiple name="gambar_artikel">
            </div>
            <!-- <button class="btn btn-primary" type="submit" name="tambah">Tambahkan</button> -->
            <input type="submit" name="tambah" value="tambah" id="btnl">
            <a href="../index.php" class="btn btn-primary" style="margin-left: 10px;">Batal</a>

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