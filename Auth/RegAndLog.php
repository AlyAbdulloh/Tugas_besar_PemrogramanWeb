<?php
include '../koneksi.php';
session_start();

if (isset($_POST['register'])) {
    $firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connect, $_POST['lastname']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $pass = $_POST['psw'];
    $status = '2';

    $select = "SELECT * FROM user WHERE username = '$username'";

    $result = mysqli_query($connect, $select);

    if (mysqli_num_rows($result) > 0) {
        // $error[] = 'Username sudah ada!';
        echo "
                    <script>
                        alert('Username sudah ada');
                    </script>
                ";
    } else {
        $insert = "INSERT INTO user(firstname, lastname, email, username, password, status) VALUES('$firstname', '$lastname', '$email', '$username', '$pass', '$status')";
        mysqli_query($connect, $insert);
        echo "
                    <script>
                        alert('Register berhasil..');
                    </script>
                ";
    }
};

if (isset($_POST['login'])) {
    $usernamelog = $_POST['username'];
    $pw = $_POST['pswl'];

    $sql = "SELECT * FROM user WHERE username = '$usernamelog' && password = '$pw'";
    $hasil = mysqli_query($connect, $sql);

    if (mysqli_num_rows($hasil) > 0) {
        $row = mysqli_fetch_array($hasil);

        if ($row['status'] == 1) {
            $_SESSION['admin_name'] = $row['firstname'];
            $_SESSION['id_admin'] = $row['id_user'];
            header('location:../Admin/Home.php');
        } else if ($row['status'] == 2) {
            $_SESSION['user_name'] = $row['firstname'];
            $_SESSION['id_user'] = $row['id_user'];
            header('location:../index.php');
        }
    } else {
        echo "
                <script>
                    alert('Email atau Password salah!');
                </script>
            ";
    }
}
?>




<!DOCTYPE html>
<html lang="en" id="particles-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styleRegister.css">
    <style>
        body {
            background: #f5f5f5;
        }

        .container {
            background: white;
        }
    </style>
</head>

<body>
    <div class="form">
        <div class="container" id="sig">
            <form action="" method="post">
                <div class="regis">
                    <div class="sign" style="background: #2ec4b6;">Sign Up</div>
                    <div class="login">Log in</div>
                </div>
                <div class="name">
                    <input type="text" name="firstname" placeholder="First Name*" required>
                    <input type="text" name="lastname" placeholder="Last Name*" required>
                </div>
                <div class="email">
                    <input type="email" name="email" placeholder="Email Address*" required>
                </div>
                <div class="username">
                    <input type="text" name="username" placeholder="Username*" required>
                </div>
                <div class="pw">
                    <input type="password" placeholder="Set a Password*" name="psw" required id="pswrd" onkeyup="checkPassword(this.value)">
                </div>
                <div class="validation" id="val">
                    <ul>
                        <li id="lower">At least one lowercase characther</li>
                        <li id="upper">At least one uppercase characther</li>
                        <li id="number">At least one number</li>
                        <li id="special">At least one special characther</li>
                        <li id="length">At least 8 characther</li>
                    </ul>
                </div>
                <div class="confirmpw">
                    <p id="ket">Not Confirmed*</p>
                    <input type="password" placeholder="Confirm Password*" name="cpsw" required id="cpswrd" onkeyup="check(this.value)">
                </div>
                <div class="button">
                    <input id="btn" type="submit" name="register" value="REGISTER" disabled>
                </div>
            </form>
        </div>
        <div class="container hide" id="log">
            <form action="" method="post">
                <div class="regis">
                    <div class="signn sign">Sign Up</div>
                    <div class="login">Log in</div>
                </div>
                <div class="username">
                    <input type="text" name="username" placeholder=" Your Username*" required>
                </div>
                <div class="pw pwl">
                    <input type="password" placeholder="Your Password*" name="pswl" required id="pswrd" class="pwll">
                    <div id="icon"></div>
                </div>
                <div class="button">
                    <input type="submit" name="login" value="LOGIN" id="btnl">
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="particles.js"></script>
    <script src="app.js"></script>
</body>

</html>