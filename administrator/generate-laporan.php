<?php
include '../database/config.php';

SESSION_START();
if ($_SESSION['level'] != 'admin') {
    header('Location:../logout.php');
}
$query = "SELECT m.nama as nama, p.tgl_pengaduan as tgl_pengaduan, p.foto as foto, p.isi_laporan as isi_laporan, p.status as status FROM pengaduan p JOIN masyarakat m WHERE p.nik = m.nik";
$execQuery = mysqli_query($conn, $query);
$getData = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Generate Laporan Pengaduan</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-middle">
            <center>
                <h2>Seluruh Laporan yang Masuk</h2>
            </center>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Pengadu</th>
                        <th>Tanggal Aduan</th>
                        <th>Foto Aduan</th>
                        <th>Isi Aduan</th>
                        <th>Status Aduan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($getData as $data) {
                        $no+=1;
                        if ($data['status'] == NULL) {
                            $status = 'Belum Valid';
                        } elseif ($data['status'] == '0') {
                            $status = 'Valid';
                        } else {
                            $status = $data['status'];
                        }
                        echo "
                            <tr>
                                <td>$no</td>
                                <td>$data[nama]</td>
                                <td>$data[tgl_pengaduan]</td>
                                <td>
                                    <img src=$data[foto] class'image image-thumbnail' width=100px>
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
</body>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
    window.print();
</script>
</html>