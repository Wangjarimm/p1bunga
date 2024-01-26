<?php
session_start();
if (!isset($_SESSION["pasien"])) {
    header("Location: index.php");
    exit;
}

require 'function.php';

$query = mysqli_query($connect, "SELECT d.*,j.hari,j.jam, j.jam_tutup, j.ruangan,j.id AS id_jadwal 
                                 FROM dokter d LEFT JOIN jadwal_dokter j 
                                 ON d.id = j.id_dokter");


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
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header" style="font-size: 24px;">
                            <h3 class="card-title">Daftar Dokter</h3>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Nama Dokter</th>
                                        <th>Spesialis</th>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Ruangan</th>
                                        <!-- <th>Jumlah Pasien yang Dapat Dilayani</th> -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php while ($dokter = mysqli_fetch_assoc($query)) : ?>
                                        <?php 
                                        //  $result = dataDiri($dokter, 'BPJS');

                                        // Ambil informasi sisa pasien yang dapat dilayani
                                        //  $sisa_pasien = $batas_maksimal_pasien - $jumlah_pasien;
                                 
                                        ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $dokter['nama']; ?></td>
                                            <td><?= $dokter['spesialis']; ?></td>
                                            <?php if ($dokter['hari'] !== null) : ?>
                                                <td><?= $dokter['hari']; ?></td>
                                            <?php else : ?>
                                                <td>Belum Ada</td>
                                            <?php endif; ?>
                                            <?php if ($dokter['jam'] !== null) : ?>
                                                <td><?= $dokter['jam']; ?>-<?= $dokter['jam_tutup']; ?></td>
                                            <?php else : ?>
                                                <td>Belum Ada</td>
                                            <?php endif; ?>
                                            <?php if ($dokter['ruangan'] !== null) : ?>
                                                <td><?= $dokter['ruangan']; ?></td>
                                            <?php else : ?>
                                                <td>Belum Ada</td>
                                            <?php endif; ?>
                                            <!-- <td><?= $sisa_pasien ?></td> -->
                                            <td>
                                                <?php if ($dokter['ruangan'] !== null) : ?>
                                                    <a href="jenis_reservasi.php?id=<?= $dokter['id']; ?>" class="btn btn-primary">Reservasi</a>
                                                <?php else : ?>
                                                    <button class="btn btn-secondary disabled">Reservasi</button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
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