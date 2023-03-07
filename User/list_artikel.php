<?php

    session_start();
    include '../koneksi.php';
    $id_kategori = $_GET['id_kategori'];

    $sql="SELECT * FROM kategori WHERE id_kategori = '$id_kategori'";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_array($result);
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
    <style>
        body{
            background-color: #f5f5f5;
        }
        
        #con{
            background: #e9ecef;
        }
        .kat{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            background: #e9ecef;
        }
        #nav{
            box-shadow: 0 2px 4px 0 rgba(0,0,0,.2);
        }

        @media screen and (max-width: 1400px){
            .c{
                height: 400px;
            }
        }

        @media screen and (max-width: 768px){
            .c{
                height: 300px;
            }
            .t{
                font-size: 15px;
            }

            .i{
                font-size: 10px;
            }
        }

        @media screen and (max-width: 576px){
            .c{
                height: 100%;
            }
            .t{
                font-size: 30px;
            }

            .i{
                font-size: 15px;
            }

            .k,a{
                font-size: 15px;
            }
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
                <li>
                    <?php
                        if(isset($_SESSION['user_name'])){
                    ?>
                    <a class="dropdown-item" href="myartikel.php">Artikel Saya</a>
                    <?php
                        }else{
                    ?>
                    <!-- <a class="dropdown-item" href="">Buat Artikel</a> -->
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdropMyartikel">
                        Artikel Saya
                    </button>
                    <?php
                        }
                    ?>
                </li>
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

    <div class="container mt-4" style="width: ;" id="con">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item p-2"><a href="kategori_artikel.php" class="text-decoration-none k">Kategori Artikel</a></li>
                <li class="breadcrumb-item active p-2 a" aria-current="page"><?php echo $data['nama_kategori']; ?></li>
            </ol>
        </nav>
    </div>

    <div class="container" style="width: ;">
        <div class="row">
            <?php
                $tampil = "SELECT * FROM artikel WHERE id_kategori = '$id_kategori'";
                $hasil = mysqli_query($connect, $tampil);
                if(mysqli_num_rows($hasil) > 0){
                    $no = 0;
                    while($row = mysqli_fetch_array($hasil)):
                    $no++;
            ?>
            <div class="col-sm-3 col-md-3 mb-4">
                <div class="card c" style="height:;">
                    <img src="../Gambar/Gambar_Artikel/<?php echo $row['gambar_artikel']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title t">
                            <?php 
                                $ambil = $row['judul_artikel'];
                                $panjang = strip_tags(html_entity_decode($ambil,ENT_QUOTES,"ISO-8859-1"));
                                $test = strlen($panjang);
                                if($test > 30){
                                    echo substr($panjang, 0, 30)."...";
                                }else{
                                    echo $panjang;
                                } 
                            ?>
                        </h5>
                        <p class="card-text i">
                            <?php
                                $ambil=$row["isi_artikel"];
                                $panjang = strip_tags(html_entity_decode($ambil,ENT_QUOTES,"ISO-8859-1"));
                                echo substr($panjang, 0, 50); 
                            ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="baca_artikel.php?id_artikel=<?php echo $row['id_artikel']; ?>&id_kategori=<?php echo $row['id_kategori']; ?>" class="text-decoration-none">Baca</a>
                    </div>
                </div>
            </div>
            <?php 
                    endwhile; 
                }else{
                    ?>
            <div class="kat">
                <h1>Belum Terdapat Artikel </h1>
            </div>
                    <?php
                }
            ?>
        </div>
    </div>
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

<div class="modal fade" id="staticBackdropMyartikel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body mt-3 mb-3 d-flex justify-content-between">
        Anda belum login!
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
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