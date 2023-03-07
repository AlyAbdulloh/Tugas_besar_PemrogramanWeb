<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="" id="sidebar-wrapper" style="background: #161a1d;">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-uppercase border-bottom"><h4 style="color: red;">Indo<span style="color : white;">Article</span></h4></div>
            <div class="list-group list-group-flush my-3">
                <a href="Home.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" style="color: white;"><i class="fa-sharp fa-solid fa-house me-2"></i>Home</a>
                <a href="usermenu.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" style="color: white;"><i class="fa-solid fa-user me-2"></i>User</a>
                <a href="" class="list-group-item list-group-item-action second-text" style="width: 200px; margin-left: 17px; border-radius: 8px;"><i class="fa-sharp fa-solid fa-arrow-right me-2"></i>Kategori</a>
                <a href="artikel.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" style="color: white;"><i class="fa-solid fa-file-pen me-2"></i>Artikel</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background: white;">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <div id="men"></div>
                    <!-- <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i> -->
                    <h2 class="fs-2 m-0">Kategori</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown" style="width: 40px;">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="width: 40px;">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <?php
                session_start();
                if(isset($_SESSION['alert'])){       
            ?>
            <div class="d-flex justify-content-center">
                <div class="alert alert-success alert-dismissible" style="width: 960px;">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong><?php echo $_SESSION['alert']; ?></strong>
                </div>
            </div>
            <?php
                }
                unset($_SESSION['alert']);
            ?>
            <div class="container d-flex justify-content-center">
                <div class="card mb-5" style="width: 60rem;">
                    <div class="card-header p-3">
                        <!-- <a href="tambahkategori.php" class="btn btn-primary">Tambah Kategori</a> -->
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Tambah Kategori</button>

                    </div>
                    <div class="container px-4 pb-4">
                        <div class="row">
                        <?php
                            include '../koneksi.php';
                            $sql = "SELECT * FROM kategori";
                            $hasil = mysqli_query($connect, $sql);
                            $no = 0;
                            while($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                            <div class="col-3 mt-4">
                                <div class="card">
                                    <img src="../Gambar/Gambar_Kategori/<?php echo $data['gambar_kategori']; ?>" class="card-img-top p-3" alt="...">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?php echo $data['nama_kategori']; ?></h5>
                                        <a href="edit_kategori.php?id_kategori=<?php echo $data['id_kategori']; ?>" class="text-decoration-none"><h6 class="text-primary">Edit Kategori</h6></a>
                                        <a href="hapuskategori.php?id_kategori=<?php echo $data['id_kategori']; ?>&gambar=<?php echo $data['gambar_kategori']; ?>" class="text-decoration-none"><h6 class="text-danger">Hapus Kategori</h6></a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /#page-content-wrapper -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="tambahkategori.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="mb-2">
            <label for="nama_kategori" class="col-form-label">Nama Kategori:</label>
            <input type="text" class="form-control" name="nama_kategori">
          </div>
          <div class="mb-2">
            <label for="gambar_kategori" class="col-form-label">Gambar Kategori:</label>
            <input type="file" name="gambar_kategori" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" name="tambah_kategori" value="Tambahkan" class="btn btn-primary">
      </div>
      </form>      
    </div>
  </div>
</div>

    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>

    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("men");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
            toggleButton.classList.toggle("hidee");
        };

        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
    </script>
</body>

</html>