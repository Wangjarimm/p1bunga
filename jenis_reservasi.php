<?php
session_start();
if (!isset($_SESSION["pasien"])) {
    header("Location: index.php");
    exit;
}



require 'function.php';


$id_user = $_SESSION["id"];
$queryUser = mysqli_query($connect, "SELECT id_user,nama_lengkap FROM users WHERE id_user = '$id_user'");
$profile = mysqli_fetch_assoc($queryUser);

$id = $_GET["id"];

$dokter = query("SELECT d.*,j.* 
                 FROM dokter d LEFT JOIN jadwal_dokter j 
                 ON d.id = j.id_dokter WHERE d.id = $id")[0];


if (isset($_POST["submit"])) {

    $jenis = $_POST['jenis'];
    header("Location: form.php?id=$id&jenis=$jenis");

}

$old_tgl_reservasi = isset($_POST['tgl_reservasi']) ? htmlspecialchars($_POST['tgl_reservasi']) : '';
$old_tujuan = isset($_POST['tujuan']) ? htmlspecialchars($_POST['tujuan']) : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Data Diri</title>
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
                            <h3 class="card-title">Jenis Reservasi</h3>
                        </div>

                        <div class="card-body">
                            <form method="post">
                                <input type="hidden" value="<?= $profile['id_user']; ?>" name="id_user">
                                <input type="hidden" value="<?= $dokter['id_dokter']; ?>" name="id_dokter">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Jenis Reservasi</label>
                                        <select name="jenis" class="form-control" id="">
                                            <option value="BPJS">BPJS</option>
                                            <option value="UMUM">UMUM</option>
                                        </select>
                                    </div>
                                    
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>


<hr>
<div class="card-body">

</div>