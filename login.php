<?php
// $pwd = "admin123";
// $enkrip_pwd = password_hash($pwd, PASSWORD_BCRYPT);
// echo $enkrip_pwd;
// echo "<br>";

// $pwd_input = "admin123dd";
// $cek_pwd = password_verify($pwd_input, $enkrip_pwd);
// echo $cek_pwd;
include('koneksi.php');
if (isset($_POST['login_form'])) //'login_form' dari name tombol loginnya
{
    $username = $_POST['username_form'];
    $password = $_POST['password_form'];
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $select = mysqli_query($koneksi,$sql);
    $row = mysqli_fetch_assoc($select);
    $data = mysqli_num_rows($select);
    if ($data > 0) 
    {
        if (password_verify($password,$row['password'])) 
        {
            ?>
            <script>
                alert('Anda Berhasil Login');
                location.href='http://localhost/01-perpus-fiqri/';
            </script>
            <?php
        }
        else
        {
            echo "password anda salah";
        }
    }
    else
    {
        ?>
            <script>
                alert('Username/Password anda salah!!');
                location.href='http://localhost/01-perpus-fiqri/login.php';
            </script>
        <?php
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="bootstrap-5.2.0-dist/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row mt-5 pt-5">
            <div class="col">
                <!-- kolom 1 -->
            </div>
            <div class="col border border-success rounded pt-4 pb-4 mt-5">
                <!-- kolom 2 buat naro form login -->
                <h2 class="text-center mb-3">Login Admin Perpus</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <input class="form-control mb-3" type="text" name="username_form" placeholder="username">
                    </div>
                    <div class="form-group">
                        <input class="form-control mb-3" type="password" name="password_form" placeholder="password">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-success w-100" type="submit" name="login_form">Login</button>
                    </div>
                </form>
            </div>
            <div class="col">
                <!-- kolom 3 -->
            </div>
        </div>
    </div>
</body>
</html>
