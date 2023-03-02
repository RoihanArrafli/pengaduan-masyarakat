
<?php
SESSION_START();
include '../lib/config.php';



if (isset($_POST['login'])) {

    $username  = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM petugas WHERE username = '$username' AND password = '$password';";
    // var_dump($query);

    $execQuery = mysqli_query($conn, $query);
    $getData = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);

    $numRows = mysqli_num_rows($execQuery);

    if ($numRows == 1) {
        foreach ($getData as $data) {
            $_SESSION['id'] = $data['id_petugas'];
            $_SESSION['nama'] = $data['nama_petugas'];
            $_SESSION['level'] = $data['level'];
        }
        // var_dump($_SESSION);
        header('Location:./verifikasi/nonvalid.php');
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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Login Admin</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-center">
            <div class="card log-lg-6">
                <div class="card-header">
                    <center>Login Admin</center>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="username" placeholder="Username"  class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password"  class="form-control">
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