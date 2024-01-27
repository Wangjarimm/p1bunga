<?php
session_start();
if (!isset($_SESSION["pasien"])) {
    header("Location: index.php");
    exit;
}


require 'function.php';

$id_user = $_SESSION["id"];


$query = mysqli_query($connect, "SELECT p.*,p.id AS id_pasien, u.*,a.*,d.nama,d.spesialis,j.* FROM pasien p INNER JOIN users u ON p.id_user = u.id_user INNER JOIN antrian a ON a.id_pasien = p.id INNER JOIN dokter d ON p.id_dokter = d.id INNER JOIN jadwal_dokter j ON j.id_dokter = d.id WHERE p.id_user = '$id_user'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dokter</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css?v=3.2.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="daftar_dokter.php">Klinik Sukajadi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="daftar_dokter.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="riwayat.php">Riwayat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="row container ps-5 ms-5">
                <div class="card ">
                    <div class="card-header" style="font-size: 24px;">
                        <h3 class="card-title">Daftar Dokter</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama Pasien</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Dokter</th>
                                    <th>Spesialis</th>
                                    <th>No Antrian</th>
                                    <th>Tujuan</th>
                                    <th>Jenis</th>
                                    <th>Tanggal Reservasi</th>
                                    <th>Jam Reservasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php while ($pasien = mysqli_fetch_assoc($query)) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $pasien['nama_lengkap']; ?></td>
                                        <td><?= $pasien['nik']; ?></td>
                                        <td><?= $pasien['jenis_kelamin']; ?></td>
                                        <td><?= $pasien['tempat_lahir']; ?></td>
                                        <td><?= $pasien['tanggal_lahir']; ?></td>
                                        <td><?= $pasien['alamat']; ?></td>
                                        <td><?= $pasien['nama']; ?></td>
                                        <td><?= $pasien['spesialis']; ?></td>
                                        <td><?= $pasien['nomor']; ?></td>
                                        <td><?= $pasien['tujuan']; ?></td>
                                        <td><?= $pasien['jenis']; ?></td>
                                        <td><?= $pasien['tanggal_reservasi']; ?></td>
                                        <td><?= $pasien['jam_reservasi']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $pasien['id_pasien']; ?>">
                                                Detail
                                            </button>
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $pasien['id_pasien']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-header" style="font-size: 24px;">
                                                                <h3 class="card-title">Struk Reservasi</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <div>
                                                                    <div class="card-body" id="pdfContent">
                                                                        <div class="row">
                                                                            <div class="col-md-6" id="bagianPertama">
                                                                                <div class="form-group">
                                                                                    <label>Nama Lengkap:</label>
                                                                                    <div class="value"> <?= $pasien['nama_lengkap']; ?> </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>NIK:</label>
                                                                                    <div class="value"> <?= $pasien['nik']; ?> </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Jenis Kelamin:</label>
                                                                                    <div class="value"> <?= $pasien['jenis_kelamin']; ?> </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Tempat Lahir:</label>
                                                                                    <div class="value"> <?= $pasien['tempat_lahir']; ?> </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Tanggal Lahir:</label>
                                                                                    <div class="value"> <?= $pasien['tanggal_lahir']; ?> </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Tujuan:</label>
                                                                                    <div class="value"> <?= $pasien['tujuan']; ?> </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Alamat:</label>
                                                                                    <div class="value"> <?= $pasien['alamat']; ?></div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-6" id="bagianKedua">
                                                                                <div class="form-group">
                                                                                    <label>Nama Dokter:</label>
                                                                                    <div class="value"> <?= $pasien['nama']; ?> </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Spesialis:</label>
                                                                                    <div class="value"> <?= $pasien['spesialis']; ?></div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Hari:</label>
                                                                                    <div class="value"> <?= $pasien['hari']; ?> </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Ruangan:</label>
                                                                                    <div class="value"> <?= $pasien['ruangan']; ?></div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Tanggal Reservasi:</label>
                                                                                    <div class="value"> <?= $pasien['tanggal_reservasi']; ?> </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Antrian:</label>
                                                                                    <div class="value"> <?= $pasien['nomor']; ?></div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Jenis:</label>
                                                                                    <div class="value"> <?= $pasien['jenis']; ?></div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Jam Reservasi:</label>
                                                                                    <div class="value"> <?= $pasien['jam_reservasi']; ?></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <a href="create_pdf.php?id_pasien=<?= $pasien['id_pasien']; ?>" type="button" class="btn btn-primary" target="_blank">Unduh sebagai PDF</a>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="card-footer clearfix">
                                                                <ul class="pagination pagination-sm m-0 float-right">
                                                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    <?php $i++ ?>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>