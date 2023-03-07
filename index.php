<?php
    session_start();
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
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
</head>
<style>
    body{
        background-color: #f5f5f5;
    }
    #cont{
        height: 590px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #nav{
        box-shadow: 0 2px 4px 0 rgba(0,0,0,.2);
    }

    .modal-body{
        padding: 2px 16px;
    }
</style>
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
            <a class="nav-link active fs-5" style="color: white; font-weight: bold;" aria-current="page" href="">Home</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                Artikel
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="User/kategori_artikel.php">Baca Artikel</a></li>
                <li>
                    <?php
                        if(isset($_SESSION['user_name'])){
                    ?>
                    <a class="dropdown-item" href="User/tambahartikel.php">Buat Artikel</a>
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
                    <a class="dropdown-item" href="User/myartikel.php">Artikel Saya</a>
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
        <div class="ms-auto d-flex">
            <ul clas="navbar-nav">
                <li class="nav-item mt-2" style="list-style: none;">
                    <button type="button" class="btn btn-sm btn-outline-secondary mt-1" data-bs-toggle="modal" data-bs-target="#staticBackdropp">
                        Edit Profil
                    </button>
                </li>
            </ul>
        
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
                    <a href="RegisLogin/RegAndLog.php" class="btn btn-sm btn-outline-secondary mt-1">Sign Up</a>
                </li>
            </ul> 
        </div>
        <?php
            }
        ?>
        </div>
    </div>
    </nav>
    <?php
        if(isset($_SESSION['user_name'])){
    ?>
    <div class="container text-center d-flex flex-column" id="cont">
        <h1 class="animate__animated animate__backInDown">Helloo <?php echo $_SESSION['user_name']; ?></h1>
        <h1 class="animate__animated animate__lightSpeedInLeft animate__delay-1s">Selamat Datang di INDOARTICLE</h1>
    </div>
    <?php
        }else{
    ?>
    <div class="container text-center d-flex flex-column" id="cont">
        <h1 class="animate__animated animate__backInDown">Selamat Datang di INDOARTICLE</h1>
        <h1 class="animate__animated animate__lightSpeedInLeft animate__delay-1s">Buruan daftar, dan buat Artikel yang kamu mau..</h1>
    </div>
    <?php
        }
    ?>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">LogOut</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mb-4 mt-4">
        Apa anda yakin ingin Logout?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <a class="btn btn-primary" aria-current="page" href="User/logout.php">Ya</a>
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
      <div class="modal-body mt-3 mb-3">
        Anda harus Login dulu...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <a class="btn btn-primary" aria-current="page" href="RegisLogin/RegAndLog.php">Ya</a>
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

<?php
    include 'koneksi.php';
    if(isset($_SESSION['user_name'])){
        $id_user = $_SESSION['id_user'];
        $sql= "SELECT * FROM user WHERE id_user = '$id_user'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($result);
    }
?>

</div>
    <div class="modal fade" id="staticBackdropp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="User/editprofile.php" method="post">
                    <div class="modal-body">
                        <div class="">
                            <label for="nama_kategori" class="col-form-label">First Name:</label>
                            <input type="text" class="form-control" name="firstname" value="<?php echo $data['firstname']; ?>">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <label for="nama_kategori" class="col-form-label">Last Name:</label>
                            <input type="text" class="form-control" name="lastname" value="<?php echo $data['lastname']; ?>">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <label for="nama_kategori" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="nama_kategori" class="col-form-label">Username:</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                    </div>
                </form>      
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