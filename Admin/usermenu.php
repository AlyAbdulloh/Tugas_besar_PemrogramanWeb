<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width =device-width , initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #edit{
            color: green;
            font-size: 18px;
        }

        #delete{
            color: red;
            font-size: 18px;
        }
    </style>
</head>

<body>
<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="" id="sidebar-wrapper" style="background: #161a1d;">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-uppercase border-bottom"><h4 style="color: red;">Indo<span style="color : white;">Article</span></h4></div>
            <div class="list-group list-group-flush my-3">
                <a href="Home.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" style="color: white;"><i class="fa-sharp fa-solid fa-house me-2"></i>Home</a>
                <a href="" class="list-group-item list-group-item-action second-text" style="width: 200px; margin-left: 17px; border-radius: 8px;"><i class="fa-sharp fa-solid fa-arrow-right me-2"></i>User</a>
                <a href="kategori.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" style="color: white;"><i
                        class="fa-solid fa-list me-2"></i>Kategori</a>
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
                    <h2 class="fs-2 m-0">Data User</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container" style="width: 60rem;">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">ID</th >
                            <th scope="col">Nama</th >
                            <th scope="col">Email</th >
                            <th scope="col">Action</th >
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            include '../koneksi.php';

                            $sql= "SELECT * FROM user WHERE status = 2";
                            $result = mysqli_query($connect, $sql);
                            while($data = mysqli_fetch_array($result)):
                        ?>
                        <tr>
                            <th scope="row"><?php echo $data['id_user']; ?></td>
                            <td><?php echo $data['firstname']." ".$data['lastname']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td class="text-center">
                                <!-- <a href="edituser.php?id_user=<?php echo $data['id_user']; ?>"><i class="fa-solid fa-user-pen me-1" id="edit"></i></a>| -->
                                <a href="hapus_user.php?id_user=<?php echo $data['id_user']; ?>"><i class="fa-solid fa-user-minus" id="delete"></i></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
    <!-- /#page-content-wrapper -->
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
    </script>
</body>

</html>