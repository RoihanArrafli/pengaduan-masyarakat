<?php
SESSION_START();

include "lib/config.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM masyarakat WHERE username = '$username' AND password = '$password';";

var_dump($query);
$execQuery = mysqli_query($conn, $query);

$getData = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);
$numRows = mysqli_num_rows($execQuery);

if ($numRows == 1) {
    foreach ($getData as $data) {
        $_SESSION['id'] = $data['nik'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['level'] = 'masyarakat';
    }
    header('Location:masyarakat/menulis-pengaduan.php');
    echo "<script>alert('data yang anda masukkan benar')</script>";
} else {
    echo "<script>alert('data yang anda masukkan salah')</script>";
}
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-center">
            <div class="card col-lg-6">
                <div class="card-header">
                    <center>Login Masyarakat</center>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="login" value="login" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>