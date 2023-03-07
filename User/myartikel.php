<?php

    session_start();
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];
    $sql= "SELECT id_artikel, judul_artikel, isi_artikel, gambar_artikel, k.id_kategori, nama_kategori FROM artikel as a 
            INNER JOIN kategori as k ON a.id_kategori = k.id_kategori
            WHERE id_user = '$id_user'";
        
    $result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.css" integrity="sha512-FA9cIbtlP61W0PRtX36P6CGRy0vZs0C2Uw26Q1cMmj3xwhftftymr0sj8/YeezDnRwL9wtWw8ZwtCiTDXlXGjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #nav{
            box-shadow: 0 2px 4px 0 rgba(0,0,0,.2);
        }
        body{
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top" style="background: #161a1d;" id="nav">
    <div class="container">
        <a class="navbar-brand text-uppercase" href="#"><h4 style="color: red;">Indo<span style="color : white;">Article</span></h4></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active fs-5" style="color: white; font-weight: bold;" aria-current="page" href="../index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                Artikel
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="kategori_artikel.php">Baca Artikel</a></li>
                <li>
                    <?php
                        if(isset($_SESSION['user_name'])){
                    ?>
                    <a class="dropdown-item" href="tambahartikel.php">Buat Artikel</a>
                    <?php
                        }else{
                    ?>
                    <!-- <a class="dropdown-item" href="">Buat Artikel</a> -->
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdropB">
                        Buat Artikel
                    </button>
                    <?php
                        }
                    ?>
                </li>
                <li><a class="dropdown-item" href="">Artikel Saya</a></li>
            </ul>
            </li>
            <!-- <li class="nav-item">
                <button type="button" class="btn btn-sm btn-outline-secondary mt-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Logout
                </button>
            </li> -->
        </ul>
        <?php
            if(isset($_SESSION['user_name'])){
        ?>
        <div class="ms-auto">
            <ul clas="navbar-nav">
                <li class="nav-item mt-2" style="list-style: none;">
                    <button type="button" class="btn btn-sm btn-outline-secondary mt-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Logout
                    </button>
                </li>
            </ul> 
        </div>
        <?php
            }else{
        ?>
        <div class="ms-auto">
            <ul clas="navbar-nav">
                <li class="nav-item mt-2" style="list-style: none;">
                    <a href="../RegisLogin/RegAndLog.php" class="btn btn-sm btn-outline-secondary mt-1">Sign Up</a>
                </li>
            </ul> 
        </div>
        <?php
            }
        ?>

        </div>
    </div>
    </nav>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Log Out</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apa anda yakin ingin Log out?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <a class="btn btn-primary" aria-current="page" href="logout.php">Ya</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="staticBackdropB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Buat Artikel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Anda harus Login dulu...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <a class="btn btn-primary" aria-current="page" href="../RegisLogin/RegAndLog.php">Ya</a>
      </div>
    </div>
  </div>
</div>

            <?php
                if(isset($_SESSION['pesan_berhasil'])){       
            ?>
            <div class="d-flex justify-content-center mt-3">
                <div class="alert alert-success alert-dismissible" style="width: 1200px;">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong><?php echo $_SESSION['pesan']; ?></strong>
                </div>
            </div>
            <?php
                }
                unset($_SESSION['pesan_berhasil']);
            ?>

    <div class="container-fluid mt-3" style="width: 1200px;">
        <div class="row">
            <?php
                if(mysqli_num_rows($result) > 0){
                    $no = 0;
                    while($data = mysqli_fetch_array($result)):
                        $no++;
            ?>
            <div class="col-12 mb-4">
                <div class="card w-100">
                    <h1 class="card-title text-center mt-3"><?php echo $data['judul_artikel']; ?></h1>
                    <hr>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="../Gambar/Gambar_Artikel/<?php echo $data['gambar_artikel']; ?>" class="card-img-top w-75" alt="...">
                        </div>
                        <div class="p-4" style="text-align: justify;">
                            <p class="card-text mt-4"><?php echo $data['isi_artikel']; ?></p>
                        </div>
                        <div style="margin-left: 23px;">
                            <a href="editartikel.php?id_artikel=<?php echo $data['id_artikel']; ?>" class="btn btn-outline-primary">Edit</a>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdropH">
                                Hapus Artikel
                            </button>
                        </div>
                        
                    </div>    
                </div>
                <div class="modal fade" id="staticBackdropH" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">Hapus Artikel</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Artikel '<?php echo $data['judul_artikel']; ?>' akan terhapus. Apa anda yakin?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <a class="btn btn-primary" aria-current="page" href="hapusartikel.php?id_artikel=<?php echo $data['id_artikel'];?>&gambar_artikel=<?php echo $data['gambar_artikel']; ?>">Ya</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        <?php
                    endwhile;
                }else{
        ?>
        <div class="container-fluid d-flex align-items-center justify-content-center flex-column" style="height: 84vh;">
            <div class="d-flex">
                <img src="../Gambar/empty.png" alt="" style="width: 80px;">
                <h1 class="mt-3">Kosong!!!!</h1>
            </div>
            <a href="tambahartikel.php" class="btn btn-outline-secondary"><i class="fa-duotone fa-plus fa-xl"></i>Buat Artikel</a>
        </div>
        <?php
                }
        ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>
</html>