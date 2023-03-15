<?php
include '../../database/config.php';
SESSION_START();

if (($_SESSION['level'] != 'admin') AND ($_SESSION['level'] != 'petugas')) {
    header('Location:../../logout.php');
}

$query = "SELECT p.id_pengaduan as id_pengaduan, m.nama as nama, p.tgl_pengaduan as tgl_pengaduan, p.isi_laporan as isi_laporan, p.foto as foto, p.status as status FROM pengaduan p JOIN masyarakat m WHERE p.nik = m.nik AND status = '0';";
$execQuery = mysqli_query($conn, $query);
$getData = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $queryValid = "UPDATE pengaduan SET status = 'proses' WHERE id_pengaduan = $id";
    $execQueryValid = mysqli_query($conn, $queryValid);

    if ($execQueryValid) {
        header('Location:./nonvalid.php');
    } else {
        echo "<script>alert('ada proses yang salah')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="../verifikasi/nonvalid.php" class="nav-link">Pengaduan Non Valid</a>
                </li>
                <li class="nav-item">
                    <a href="../verifikasi/valid.php" class="nav-link">Pengaduan Valid</a>
                </li>
                <li class="nav-item">
                    <a href="../verifikasi/proses.php" class="nav-link">Pengaduan Proses</a>
                </li>
                <li class="nav-item">
                    <a href="../verifikasi/selesai.php" class="nav-link">Pengaduan Selesai</a>
                </li>
                <li class="nav-item">
                    <a href="../generate-laporan.php" class="nav-link">Generate Laporan</a>
                </li>
                <li class="nav-item">
                    <a href="../registrasi.php" class="nav-link">Registrasi</a>
                </li>
            </ul>
            <div>
                <?php
                    echo $_SESSION['nama'].' '.'<a href="../../logout.php">Logout</a>'
                ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <center>
            <h2>List Pengaduan Non Valid</h2>
        </center>
        <div class="row justify-content-center align-middle">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pengadu</th>
                        <th>Tanggal Pengaduan</th>
                        <th>Foto Penunjang</th>
                        <th>Isi Aduan</th>
                        <th>Status</th>
                        <th>Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $no = 0;
                         foreach ($getData as $data ) {
                            $no+=1;
                            if ($data['status'] == 'proses') {
                                $status = "Proses";
                            } elseif ($data['status'] == '0') {
                                $status = "Valid";
                            } else {
                                $status = "Status tidak  diketahui";
                            }
                            echo "
                                <tr>
                                    <td>$no</td>
                                    <td>$data[nama]</td>
                                    <td>$data[tgl_pengaduan]</td>
                                    <td>
                                        <img src = $data[foto] class='img img-thumbnail' width=100px>
                                    </td>
                                    <td>$data[isi_laporan]</td>
                                    <td>$status</td>
                                    <td>
                                        <a href=../tanggapan.php?id=$data[id_pengaduan]>
                                        <button class='btn btn-success'>Tanggapi</button>
                                    </td>
                                    <td>
                                        <a href=?id=$data[id_pengaduan]>
                                        <button class='btn btn-warning'>
                                        Telah di proses
                                        </button>
                                    </td>
                                </tr>
                            ";
                         }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>