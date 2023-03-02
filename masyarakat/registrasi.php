<?php
if (isset($_POST['registrasi'])) {
include '../lib/config.php';

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$telp = $_POST['telp'];

$query = "INSERT INTO masyarakat(nik, nama, username, password, telp) VALUE ('$nik', '$nama', '$username', '$password', '$telp');";
$execQuery = mysqli_query($conn, $query);
if ($execQuery) {
    echo "<script>alert('data anda berhasil disimpan')</script>";
    header('Location:../index.php');
} else {
    echo "<script>alert('data anda ada yang salah')</script>";
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
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="row justify-content-center align-center">
            <div class="card col-lg-6">
                <div class="card-header">
                    <center>Login Admin</center>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="nik" placeholder="Nomor Induk Kependudukan" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="nama" placeholder="Nama Asli" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="username" placeholder="Username" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="telp" placeholder="Nomor Telepon" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="registrasi" value="registrasi" class="btn btn-primary"> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>