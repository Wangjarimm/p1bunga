<?php
require 'function.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;

extract($_POST);

$id_pasien = $_GET['id'];
$struk = query("SELECT p.*,u.*,a.*,d.nama,d.spesialis,j.* FROM pasien p INNER JOIN users u ON p.id_user = u.id_user INNER JOIN antrian a ON a.id_pasien = p.id INNER JOIN dokter d ON p.id_dokter = d.id INNER JOIN jadwal_dokter j ON j.id_dokter = d.id WHERE p.id = $id_pasien")[0];

$html = '';
$html .= '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Reservasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .card-body {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: inline-block;
            width: 150px; /* Sesuaikan lebar label sesuai kebutuhan */
        }
        .value {
            margin-top: 5px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .col-md-6 {
            flex: 0 0 48%;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="card-body" id="pdfContent">
<div class="row">
    <div class="col-md-6" id="bagianPertama">
        <div class="form-group">
            <label>Nama Lengkap:</label>
            <div class="value">' . $struk['nama_lengkap'] . '</div>
        </div>
        <div class="form-group">
            <label>NIK:</label>
            <div class="value">' . $struk['nik'] . '</div>
        </div>
        <div class="form-group">
            <label>Jenis Kelamin:</label>
            <div class="value">' . $struk['jenis_kelamin'] . '</div>
        </div>
        <div class="form-group">
            <label>Tempat Lahir:</label>
            <div class="value">' . $struk['tempat_lahir'] . '</div>
        </div>
        <div class="form-group">
            <label>Tanggal Lahir:</label>
            <div class="value">' . $struk['tanggal_lahir'] . '</div>
        </div>
        <div class="form-group">
            <label>Tujuan:</label>
            <div class="value">' . $struk['tujuan'] . '</div>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <div class="value">' . $struk['alamat'] . '</div>
        </div>
    </div>
    <div class="col-md-6" id="bagianKedua">
        <div class="form-group">
            <label>Nama Dokter:</label>
            <div class="value">' . $struk['nama'] . '</div>
        </div>
        <div class="form-group">
            <label>Spesialis:</label>
            <div class="value">' . $struk['spesialis'] . '</div>
        </div>
        <div class="form-group">
            <label>Hari:</label>
            <div class="value">' . $struk['hari'] . '</div>
        </div>
        <div class="form-group">
            <label>Ruangan:</label>
            <div class="value">' . $struk['ruangan'] . '</div>
        </div>
        <div class="form-group">
            <label>Tanggal Reservasi:</label>
            <div class="value">' . $struk['tanggal_reservasi'] . '</div>
        </div>
        <div class="form-group">
            <label>Antrian:</label>
            <div class="value">' . $struk['nomor'] . '</div>
        </div>
        <div class="form-group">
            <label>Jenis:</label>
            <div class="value">' . $struk['jenis'] . '</div>
        </div>
    </div>
    <div class="col-md-6 w-100">
        
    </div>
</div>
</div>
<footer>
    <hr>
    <p>Klinik Sukajadi Pratama Muhammadiyah</p>
</footer>
</body>
</html>
';

$dompdf = new DOMPDF();
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$dompdf->stream("Struk.pdf");
?>
