<?php
include '../lib/config.php';
SESSION_START();

if ($_SESSION['level'] != 'masyarakat') {
    header('Location:/logout.php');
}

$id_user = $_SESSION['id'];
$queryShowData = "SELECT * FROM pengaduan WHERE nik = '$id_user'";
$execQueryShowData = mysqli_query($conn, $queryShowData);
$getAllData = mysqli_fetch_all($execQueryShowData, MYSQLI_ASSOC);




if (isset($_POST['adukan'])) {

    // var_dump($_POST['laoran']);
    // var_dump($_FILES['foto']);
    $laporan = $_POST['laporan'];

    $locationTemp = $_FILES['foto']['tmp_name'];
    $destinationFile = '../assets/img/';
    $serverName = 'http://localhost/pengaduan-masyarakat/assets/img/';

    $fileName = str_replace(' ', '', $_FILES['foto']['name']);
    $locationUpload = $destinationFile . $fileName;
    move_uploaded_file($locationTemp, $locationUpload);

    $query = "INSERT INTO pengaduan(tgl_pengaduan, nik, isi_laporan, foto, status) VALUE (now(), '$id_user', '$laporan', '$serverName$fileName', NULL)";
    $execQuery = mysqli_query($conn, $query);
    var_dump($execQuery);
    if ($execQuery) {
        header('Location:/pengaduan-masyarakat/masyarakat/menulis-pengaduan.php');
    } else {
        echo '<script>alert("Data aduan ada yang salah")</script>';
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
    <title>Form Pengaduan</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-lg-6">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="laporan" placeholder="Masukkan Laporan Anda" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="adukan" value="Adukan" class="btn btn-success form-control">
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Aduan</th>
                            <th>Foto</th>
                            <th>Isi Laporan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($getAllData as $data) {
                            if ($data['status'] == NULL) {
                                $status = 'Belum Valid';
                            } else {
                                $status = $data['status'];
                            }
                            $no += 1; 
                            echo "
                                <tr>
                                    <td>$no</td>
                                    <td>$data[tgl_pengaduan]</td>
                                    <td>
                                        <img src=$data[foto] width=100px height=100px/>
                                    </td>
                                    <td>$data[isi_laporan]</td>
                                    <td>$status</td>
                                </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>