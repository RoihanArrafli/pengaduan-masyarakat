<?php
include '../database/config.php';
SESSION_START();

if (isset($_SESSION['id'])) {
    // var_dump($_SESSION);
    if ($_SESSION['level'] == 'masyarakat') {
        header('Location:masyarakat/menulis-pengaduan.php');
    } elseif (($_SESSION['level'] == 'admin') or ($_SESSION['level'] == 'petugas')) {
        header('Location:verifikasi/nonvalid.php');
    } else {
        header('Location:../logout.php');
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM petugas WHERE username='$username' AND password='$password';";

    $execQuery = mysqli_query($conn, $query);

    $getData = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);

    $numRows = mysqli_num_rows($execQuery);

    if ($numRows == 1) {
        foreach ($getData as $data ) {
            $_SESSION['id'] = $data['id_petugas'];
            $_SESSION['nama'] = $data['nama_petugas'];
            $_SESSION['level'] = $data['level'];
        };
        header('Location:./verifikasi/nonvalid.php');
        echo "<script>alert('data anda benar')</script>";
    } else {
        echo "<script>alert('data anda salah')</script>";
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
    <title>Form Login Admin</title>
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
                            <input type="text" name="username" placeholder="Username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="login" value="login" class="btn btn-primary form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>