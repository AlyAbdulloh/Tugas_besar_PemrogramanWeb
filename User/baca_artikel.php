<?php
    session_start();
    include '../koneksi.php';
    $id_artikel = $_GET['id_artikel'];
    $id_kategori = $_GET['id_kategori'];
    $sql= "SELECT id_artikel, judul_artikel, isi_artikel, gambar_artikel, k.id_kategori, nama_kategori FROM artikel as a 
           INNER JOIN kategori as k ON a.id_kategori = k.id_kategori
           WHERE id_artikel = '$id_artikel'";
    
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);

    $sqll = "SELECT * FROM artikel WHERE id_artikel != '$id_artikel' && id_kategori='$id_kategori' ORDER BY id_artikel DESC";
    $hasil = mysqli_query($connect, $sqll);
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
        #con{
            background: #e9ecef;
        }
        #nav{
          box-shadow: 0 2px 4px 0 rgba(0,0,0,.2);
        }

        

        @media screen and (max-width: 1400px){
            .j{
              padding: 8px;
            }

            .cn{
              width: 80rem;
            }

            #con{
              margin-bottom: 20px;
            }

            .cs{
              /* height: 70px; */
            }

            .ca{
              width: 82rem;
            }

            .jj{
              font-size: 30px;
            }


        }

        @media screen and (max-width: 576px){

            .k{
                font-size: 12px;
            }

            a.{
              font-size: 12px;
            }
            .j{
              font-size: 10px;
            }

            .cn{
              width: 100%;
              padding: 5px;
            }

            .ca{
              width: 100%; 
            }

            #con{
              margin-bottom: 20px;
            }

            .jj{
              font-size: 20px;
            }

            .ii{
              font-size: 11px;
            }

            .cs{
              /* height: 70px; */
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

    <div class="container-fluid mt-4 cn" style="width:;" id="con">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item p-2"><a href="kategori_artikel.php" class="text-decoration-none k">Kategori Artikel</a></li>
                <li class="breadcrumb-item p-2"><a href="list_artikel.php?id_kategori=<?php echo $row['id_kategori'] ?>" class="text-decoration-none k"><?php echo $row['nama_kategori']; ?></a></li>
                <li class="breadcrumb-item active j" aria-current="page"><?php echo $row['judul_artikel']; ?></li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid mb-5 ca" style="width:;">
      <div class="row">
        <div class="col-sm-9">
            <div class="card" style="width: 100%;">
              <h1 class="card-title text-center mt-3 jj"><?php echo $row['judul_artikel']; ?></h1>
              <hr>
              <div class="card-body">
                <div class="text-center">
                  <img src="../Gambar/Gambar_Artikel/<?php echo $row['gambar_artikel']; ?>" class="card-img-top w-75" alt="...">
                </div>
                <div class="p-4" style="text-align: justify;">
                  <p class="card-text mt-4 ii"><?php echo $row['isi_artikel']; ?></p>
                </div>

              </div>
            </div>
        </div>
        <div class="col-sm-3 shadow">
          <h1 class="text-center mt-3 mb-4">Artikel Terkait</h1>
          <?php
            if(mysqli_num_rows($hasil) > 0){
                $no = 0;
                while($data = mysqli_fetch_array($hasil)):
                $no++;
            
          ?>
          
          <div class="row">
          <hr>
            <div class="card mb-3 cs" style="width: ; height: ; border: none;"> <!-- 500 100-->
              <div class="row g-0">
                <div class="col-md-4">
                    <a href="baca_artikel.php?id_artikel=<?php echo $data['id_artikel']; ?>&id_kategori=<?php echo $data['id_kategori']; ?>">
                        <img src="../Gambar/Gambar_Artikel/<?php echo $data['gambar_artikel']; ?>" class="img-fluid rounded-start mt-3 h-75 w-100" alt="...">
                    </a>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">
                      <?php 
                        $ambil = $data['judul_artikel'];
                        $panjang = strip_tags(html_entity_decode($ambil,ENT_QUOTES,"ISO-8859-1"));
                        $test = strlen($panjang);
                        if($test > 25){
                          echo substr($panjang, 0, 25)."...";
                        }else{
                          echo $panjang;
                        } 
                      ?>
                    </h5>
                    <p class="card-text"><small class="text-muted"><?php echo $data['tanggal_upload']; ?></small></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
                endwhile;
            }else{
              echo"<hr>";
            }
          ?>
        </div>
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

    <footer>
        <div class="container-fluid text-center p-2" style="color: white; background: #333;">
            <p class="fs-5 mt-2">Tugas Besar Web &#169; 2022, INDOARTICLE</p>
        </div>
    </footer>


    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>
</html>