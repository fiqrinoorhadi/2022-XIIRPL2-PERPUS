<?php
    include('koneksi.php');
    $nb = '';
    $pnls = '';
    $pnbt = '';
    $tb = '';
    if (isset($_POST['simpan'])) 
    {
        $namabuku       = $_POST['namabuku'];
        $penulis        = $_POST['penulis'];
        $penerbit       = $_POST['penerbit'];
        $tahun          = $_POST['tahun'];

        $sql = "INSERT INTO buku (namabuku,penulis,penerbit,tahun) 
            values ('$namabuku','$penulis','$penerbit','$tahun')";
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
                    window.location.href= "http://localhost/01-perpus-fiqri/buku.php";
                },2000);
            </script>
            <?php
    }

    if (isset($_GET['proses'])) 
    {
        if ($_GET['proses']=='delete') 
        {
            $identitas = $_GET['id'];
            $sql = "DELETE FROM buku WHERE id = '$identitas'";
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
                    window.location.href= "http://localhost/01-perpus-fiqri/buku.php";
                },2000);
            </script>
            <?php
            
        }
        if ($_GET['proses']=='edit') {
            $id = $_GET['id'];
            $sql = "SELECT * FROM buku WHERE id = '$id'";
            $edit = mysqli_query($koneksi,$sql);
            $data = mysqli_fetch_assoc($edit);
            $nb = $data['namabuku'];
            $pnls = $data['penulis'];
            $pnbt = $data['penerbit'];
            $tb = $data['tahun'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>

    <!-- Link to bootstrap framework CSS -->
    <link rel="stylesheet" href="bootstrap-5.2.0-dist/css/bootstrap.css">
</head>
<body>
    <div class="container-fluid mt-2">
        <div class="row mb-2"> <!-- baris 1 -->
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Form Data Buku
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="input-group mb-3">
                                <span class="input-group-text w-25">Nama Buku</span>
                                <input value="<?php echo $nb ?>" type="text" class="form-control" name="namabuku" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text w-25">Penulis Buku</span>
                                <input value="<?php echo $pnls ?>" type="text" class="form-control" name="penulis" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text w-25">Penerbit Buku</span>
                                <input value="<?php echo $pnbt ?>" type="text" class="form-control" name="penerbit" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text w-25">Tahun Terbit Buku</span>
                                <input value="<?php echo $tb ?>" type="text" class="form-control" name="tahun" required>
                            </div>
                            <div class="input-group mb-1">
                                <button class="btn btn-success" type="submit" name="simpan">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div><!-- tutup baris 1 -->
        <div class="row"> <!-- baris 2 -->
            <div class="col-2"></div>
            <div class="col-8">
                <?php
                $sql = "SELECT * FROM buku";
                $select = mysqli_query($koneksi,$sql);
                $urut = 1;
                ?>
                <div class="card">
                    <div class="card-header">
                        Data Buku
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>NO</th>
                                <th>NAMA BUKU</th>
                                <th>PENULIS BUKU</th>
                                <th>PENERBIT BUKU</th>
                                <th>TAHUN TERBIT</th>
                                <th>--Action--</th>
                            </tr>
                            <?php
                            while($data = mysqli_fetch_assoc($select)){
                            ?>
                            <tr>
                                <td><?php echo $urut ?></td>
                                <td><?php echo $data['namabuku'] ?></td>
                                <td><?php echo $data['penulis'] ?></td>
                                <td><?php echo $data['penerbit'] ?></td>
                                <td><?php echo $data['tahun'] ?></td>
                                <td>
                                    <a href="?proses=edit&id=<?php echo $data['id'] ?>">edit</a>||
                                    <a href="?proses=delete&id=<?php echo $data['id'] ?>">delete</a>
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
            <div class="col-2"></div>
        </div><!-- tutup baris 2 -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>