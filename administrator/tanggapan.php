<?php
include '../database/config.php';
SESSION_START();

if (isset($_POST['tanggapi'])) {
    $id_pengaduan = $_GET['id'];
    $tanggapan = $_POST['tanggapan'];
    $id_petugas = $_SESSION['id'];
    $queryTanggapi = "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES ('$id_pengaduan', now(), '$tanggapan', '$id_petugas')";
    $execQuery = mysqli_query($conn, $queryTanggapi);
    if ($execQuery) {
        header('Location:./verifikasi/valid.php');
    } else {
        echo "<script>alert('tanggapan ada yang salah')</script>";
    }
}

$id_pengaduan = $_GET['id'];
$queryAduan = "SELECT * from pengaduan WHERE id_pengaduan = $id_pengaduan";
$execQueryPengaduan = mysqli_query($conn, $queryAduan);
$getAduanData = mysqli_fetch_all($execQueryPengaduan, MYSQLI_ASSOC);
foreach ($getAduanData as $data) {
    if (($data['status'] != '0') AND ($data['status'] != 'proses')) {
        header('Location:./verifikasi/valid.php');
    }
}

$id_tanggapan = $_GET['id'];
$queryTanggapan = "SELECT t.id_tanggapan as id_tanggapan, t.id_pengaduan as id_pengaduan, t.tgl_tanggapan as tgl_tanggapan, t.tanggapan as tanggapan, t.id_petugas as id_petugas, p.nama_petugas as nama_petugas FROM tanggapan t JOIN petugas p WHERE t.id_petugas = p.id_petugas AND id_pengaduan = $id_tanggapan";
$execQueryTanggapan = mysqli_query($conn, $queryTanggapan);
$getDataTanggapan = mysqli_fetch_all($execQueryTanggapan, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Tanggapan</title>
</head>
<body>
    <div class="container">
        <div class="justify-content-center align-center">
            <div class="card col-lg-12">
                <div class="card-header">
                    <center>
                        <h2>Pengaduan</h2>
                    </center>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>Foto Penunjang</th>
                            <th>Tgl Aduan</th>
                            <th>Aduan</th>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($getAduanData as $data) {
                                    echo "
                                        <tr>
                                            <td>
                                                <img src = $data[foto] class='img img-thumbnail' width=100px>
                                            </td>
                                            <td>$data[tgl_pengaduan]</td>
                                            <td>$data[isi_laporan]</td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div class="card col-lg-12">
            <div class="card-header">
                <center>
                    <h2>Beri Tanggapan</h2>
                </center>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <textarea name="tanggapan" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="tanggapi" value="tanggapi" class="form-control btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <h2 style="padding-top: 10px;">
        <center>List Tanggapan</center>
    </h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal Tanggapan</th>
                <th>Tanggapan</th>
                <th>Nama Penanggap</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            foreach ($getDataTanggapan as $dataTanggapan) {
                $no+=1;
                echo "
                <tr>
                    <td>$no</td>
                    <td>$dataTanggapan[tgl_tanggapan]</td>
                    <td>$dataTanggapan[tanggapan]</td>
                    <td>$dataTanggapan[nama_petugas]</td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
</body>
</html>






























<!-- <?php
// include '../database/config.php';
// SESSION_START();

// if (($_SESSION['level'] != 'petugas') AND ($_SESSION['level']) != 'admin') {
//     header('Location:../logout.php');
// }

// if (empty($_GET['id'])) {
//     header('Location:./index.php');
// }

// if (isset($_POST['tanggapi'])) {
//     $id_pengaduan = $_GET['id'];
//     $tanggapan = $_POST['tanggapan'];
//     $id_petugas = $_SESSION['id'];
//     $queryTanggapi = "INSERT INTO tanggapan (id_pengaduan,  tgl_tanggapan, tanggapan, id_petugas) VALUES ('$id_pengaduan', now(), '$tanggapan', '$id_petugas')";
//     $execQuery = mysqli_query($conn, $queryTanggapi);
//     if ($execQuery) {
//         header('Location:./verifikasi/valid.php');
//     } else {
//         echo "<script>alert('tanggapan ada yang salah')</script>";
//     }
// }

// $id_pengaduan = $_GET['id'];
// $queryAduan = "SELECT * FROM pengaduan WHERE id_pengaduan = $id_pengaduan";
// $execQueryAduan = mysqli_query($conn, $queryAduan);
// $getAduanData = mysqli_fetch_all($execQueryAduan, MYSQLI_ASSOC);

// foreach ($getAduanData as $data) {
//     if (($data['status'] != '0') AND ($data['status'] != 'proses')) {
//         header('Location:./verifikasi/valid.php');
//     }
// }

// $id_pengaduan = $_GET['id'];
// $queryTanggapan = "SELECT t.id_pengaduan as id_pengaduan, t.id_tanggapan as id_tanggapan, t.tgl_tanggapan as tgl_tanggapan, t.tanggapan as tanggapan, p.nama_petugas as nama_petugas FROM tanggapan t JOIN petugas p WHERE t.id_petugas = p.id_petugas AND id_pengaduan = $id_pengaduan";
// $execQueryTanggapan = mysqli_query($conn, $queryTanggapan);
// $getDataTanggapan = mysqli_fetch_all($execQueryTanggapan, MYSQLI_ASSOC);

// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Form Tanggapan</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-middle">
            <div class="card-header">
                <h2>Aduan</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Foto Penunjang</th>
                            <th>Tgl Aduan</th>
                            <th>Aduan</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            // $no = 0;
                            //     foreach ($getAduanData as $data) {
                            //         $no+=1;
                            //         echo "
                            //         <tr>
                            //         <td>
                            //             <img src = $data[foto] class='img img-thumbnail' width=100px>
                            //         </td>
                            //         <td>$data[tgl_pengaduan]</td>
                            //         <td>$data[isi_laporan]</td>
                            //         </tr>
                            //     ";
                            //     }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card col-lg-6">
            <div class="card-header">
                <center>Beri Tanggapan</center>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <textarea class="form-control" name="tanggapan"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="tanggapi" value="tanggapi" class="form-control btn btn-danger" >
                    </div>
                </form>
            </div>
        </div>
    </div>
    <h2 style="padding-top: 10px;">
        <center>List Tanggapan</center>
    </h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal Tanggapan</th>
                <th>Tanggapan</th>
                <th>Nama Penanggap</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $no = 0;
            //     foreach ($getDataTanggapan as $dataTanggapan) {
            //         $no+=1;
            //         echo "
            //             <tr>
            //                 <td>$no</td>
            //                 <td>$dataTanggapan[tgl_tanggapan]</td>
            //                 <td>$dataTanggapan[tanggapan]</td>
            //                 <td>$dataTanggapan[nama_petugas]</td>
            //             </tr>
            //         ";
            //     }
            ?>
        </tbody>
    </table>
</body>
</html> -->