<?php
    include('koneksi.php');
    $nm = '';
    $lv = '';
    $un = '';
    $pw = '';
    // PROSES INSERT DATA DAN UPDATE DATA
    if (isset($_POST['simpan_form'])) 
    {
        $nama       = $_POST['nama_form'];
        $level      = $_POST['level_form'];
        $username   = $_POST['username_form'];
        $password   = $_POST['password_form'];
        
        //proses enskripsi password
        $enkrip_pwd = password_hash($password, PASSWORD_BCRYPT);
        
        if (isset($_GET['proses'])) {
            $id = $_GET['id'];
            $sql = "UPDATE user SET nama = '$nama',
            level = '$level',
            username = '$username',
            password = '$password' WHERE id = '$id'
            ";
            $update = mysqli_query($koneksi,$sql);
            if (!$update) 
            {
                echo "
                    <div class='alert alert-danger' role='alert'>
                    Data Gagal Di Simpan !
                    </div>
                ";
            }
            else
            {
                echo "
                    <div class='alert alert-success' role='alert'>
                        Data Berhasil Di Simpan !
                    </div>
                ";
            }
            ?>
            <script>
                setTimeout(function()
                {
                    window.location.href= "http://localhost/01-perpus-fiqri/?page=user";
                },1250);
            </script>
            <?php
        }
        else
        {
            $sql = "INSERT INTO user (nama,level,username,password) 
            values ('$nama','$level','$username','$enkrip_pwd')";
            $insert = mysqli_query($koneksi, $sql);
            if (!$insert) 
            {
                echo "
                    <div class='alert alert-danger' role='alert'>
                    Data Gagal Di Simpan !
                    </div>
                ";
            }
            else
            {
                echo "
                    <div class='alert alert-success' role='alert'>
                        Data Berhasil Di Simpan !
                    </div>
                ";
            }
            ?>
            <script>
                setTimeout(function()
                {
                    window.location.href= "http://localhost/01-perpus-fiqri/?page=user";
                },1250);
            </script>
            <?php
        }
        
    }
    // END OF INSERT DATA DAN UPDATE DATA
    if (isset($_GET['proses'])) 
    {
        if ($_GET['proses']=='delete') 
        {
            $id = $_GET['id'];
            $sql = "DELETE FROM user WHERE id = '$id'";
            $delete = mysqli_query($koneksi,$sql);
            if (!$delete)
            {
                echo "
                <div class='alert alert-danger' role='alert'>
                    Data Gagal Di DELETE !
                </div>
                ";
            }
            else
            {
                echo "
                <div class='alert alert-success' role='alert'>
                    Data Berhasil Di DELETE !
                </div>
                ";
            }
            ?> 
            <script>
                setTimeout(function()
                {
                    window.location.href= "http://localhost/01-perpus-fiqri/?page=user";
                },1500);
            </script>
            <?php
            
        }
        if ($_GET['proses']=='edit') {
            $id = $_GET['id'];
            $sql = "SELECT * FROM user WHERE id = '$id'";
            $edit = mysqli_query($koneksi,$sql);
            $data = mysqli_fetch_assoc($edit);
            $nm = $data['nama'];
            $lv = $data['level'];
            $un = $data['username'];
            $pw = $data['password'];
        }
    }
?>

        <div class="row mb-2"> <!-- baris 1 -->
            
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Form Data User
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="input-group mb-3">
                                <input placeholder="Nama User" value="<?php echo $nm ?>" type="text" class="form-control" name="nama_form" required>
                            </div>
                            <div class="input-group mb-3">
                                <!-- <span class="input-group-text w-25">Penulis</span> -->
                                <input placeholder="Level User" value="<?php echo $lv ?>" type="text" class="form-control" name="level_form" required>
                            </div>
                            <div class="input-group mb-3">
                                <!-- <span class="input-group-text w-25">Penerbit</span> -->
                                <input placeholder="Username" value="<?php echo $un ?>" type="text" class="form-control" name="username_form" required>
                            </div>
                            <div class="input-group mb-3">
                                <!-- <span class="input-group-text w-25">Tahun Terbit</span> -->
                                <input placeholder="Password" value="<?php echo $pw ?>" type="password" class="form-control" name="password_form" required>
                            </div>
                            <div class="input-group mb-1">
                                <button class="btn btn-success" type="submit" name="simpan_form">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <?php
                $sql = "SELECT * FROM user";
                $select = mysqli_query($koneksi,$sql);
                $urut = 1;
                ?>
                <div class="card">
                    <div class="card-header">
                        Data User
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" style="font-size: 13px;">
                            <tr>
                                <th>NO</th>
                                <th>Nama User</th>
                                <th>Level User</th>
                                <th>username</th>
                                <th>Password</th>
                                <th>--Action--</th>
                            </tr>
                            <?php
                            while($data = mysqli_fetch_assoc($select)){
                            ?>
                            <tr>
                                <td valign="middle" align="center"><?php echo $urut ?></td>
                                <td valign="middle"><?php echo $data['nama'] ?></td>
                                <td valign="middle"><?php echo $data['level'] ?></td>
                                <td valign="middle"><?php echo $data['username'] ?></td>
                                <td valign="middle">***************</td>
                                <td valign="middle">
                                    <a class="text-decoration-none" href="?page=user&proses=edit&id=<?php echo $data['id'] ?>">
                                        <button class="btn btn-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </button>
                                    </a>
                                    <a class="text-decoration-none" href="?page=user&proses=delete&id=<?php echo $data['id'] ?>">
                                        <button class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                            </svg>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $urut++;
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- tutup baris 1 -->