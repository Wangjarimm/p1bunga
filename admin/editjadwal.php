<?php

session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: ../");
    exit;
}

require '../function.php';

$id = $_GET["id"];

$dokter = query("SELECT d.nama,j.* 
                 FROM dokter d LEFT JOIN jadwal_dokter j 
                 ON d.id = j.id_dokter WHERE j.id = $id")[0];

if (isset($_POST["submit"])) {

    if (editJadwal($_POST) > 0) {
        echo
        "<script>
                alert('Jadwal Dokter berhasil diubah');
                window.location.href = 'datadokter.php';
        </script>";
    } else {
        echo
        "<script>
                alert('Jadwal Dokter gagal diubah :( ');
        </script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Edit Jadwal Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../assets/css/admin.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboard.php">Dashboard Admin</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Dokter & Pasien</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Data Dokter
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="datadokter.php">Daftar Dokter</a>
                                <a class="nav-link" href="tambahdokter.php">Tambah Dokter</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pasien
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="datapasien.php">Data Pasien</a>
                                    <a class="nav-link" href="datareservasi.php">Data Reservasi</a>
                                </nav>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in Admin</div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Jadwal Dokter</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Edit Jadwal Dokter</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="container p-4">
                            <form method="post">
                                <input type="hidden" name="id" value="<?= $dokter["id"] ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Dokter</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $dokter['nama']; ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Hari</label>
                                    <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="hari" value="<?= $dokter['hari']; ?>"> -->
                                    <select name="hari" id="hari" class="form-select">
                                        <option disabled <?php echo ($dokter['hari'] == 'Pilih Hari') ? 'selected' : ''; ?>>Pilih Hari</option>
                                        <option value="Senin" <?php echo ($dokter['hari'] == 'Senin') ? 'selected' : ''; ?>>Senin</option>
                                        <option value="Selasa" <?php echo ($dokter['hari'] == 'Selasa') ? 'selected' : ''; ?>>Selasa</option>
                                        <option value="Rabu" <?php echo ($dokter['hari'] == 'Rabu') ? 'selected' : ''; ?>>Rabu</option>
                                        <option value="Kamis" <?php echo ($dokter['hari'] == 'Kamis') ? 'selected' : ''; ?>>Kamis</option>
                                        <option value="Jumat" <?php echo ($dokter['hari'] == 'Jumat') ? 'selected' : ''; ?>>Jum'at</option>
                                        <option value="Sabtu" <?php echo ($dokter['hari'] == 'Sabtu') ? 'selected' : ''; ?>>Sabtu</option>
                                        <option value="Minggu" <?php echo ($dokter['hari'] == 'Minggu') ? 'selected' : ''; ?>>Minggu</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Jam</label>
                                    <input type="time" class="form-control" id="exampleInputPassword1" name="jam" value="<?= $dokter['jam']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword2" class="form-label">Jam tutup</label>
                                    <input type="time" class="form-control" id="exampleInputPassword2" name="jam_tutup" value="<?= $dokter['jam_tutup']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword3" class="form-label">Ruangan</label>
                                    <input type="text" class="form-control" id="exampleInputPassword3" name="ruangan" value="<?= $dokter['ruangan']; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/chart-area-demo.js"></script>
    <script src="../assets/js/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/datatables-simple-demo.js"></script>
</body>

</html>