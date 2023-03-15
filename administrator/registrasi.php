<?php
include '../database/config.php';

if (isset($_POST['registrasi'])) {
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];
    $level = $_POST['level'];

    $query = "INSERT INTO petugas (nama_petugas, username, password, telp, level) VALUES ('$nama_petugas', '$username', '$password', '$telp', '$level')";
    $execQuery = mysqli_query($conn, $query);
    
    if ($execQuery) {
        echo "<script>alert('Data anda berhasil ditambahkan')</script>";
        header('Location:./index.php');
    } else {
        echo "<script>alert('Data anda gagal ditambahkan')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Form Registrasi</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-center">
        <div class="card col-lg-6">
            <div class="card-header">
                <center>Registrasi Admin</center>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="nama_petugas" class="form-control" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Buat Username" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Buat Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="telp" class="form-control" placeholder="Masukkan No. Telpon" required>
                    </div>
                    <div class="mb-3">
                        <select name="level" class="form-control">
                            <option value="">-- Pilih Role --</option>
                            <option value="petugas">Petugas</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success form-control" name="registrasi" value="registrasi" >
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</body>
</html>