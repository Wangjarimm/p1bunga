<?php
require 'function.php';

if (isset($_POST["regis"])) {
    if (register($_POST) > 0) {
        echo
        "<script>
            alert('Akun berhasil terbuat');
            window.location.href = 'daftar_dokter.php'
        </script>";
    } else {
        echo "
            <script>
                alert('Akun gagal terbuat');
            </script>;
        ";
        echo mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/log.css">
</head>

<body>
    <div class="wrapper">
        <div class="card-switch">
            <label class="switch">
                <div class="flip-card__inner">
                    <div class="title-regis title">
                        <a>Klinik Pratama Muhammadiyah Sukajadi</a>
                    </div>
                    <div class="flip-card__front">
                        <div class="title">Sign up</div>
                        <p> Isi Data Diri Sesuai KTP </p>
                        <form class="flip-card__form" action="" method="POST">
                            <input class="flip-card__input" placeholder="Nomor Induk Keluarga" type="text" name="nik" required>
                            <input class="flip-card__input" placeholder="Full Name" type="name" name="name" required>
                            <select class="flip-card__input" placeholder="Jenis Kelamin" name="jenis_kelamin" required>
                                <option disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <input class="flip-card__input" name="tempat_lahir" placeholder="Tempat Lahir" type="text" required>
                            <input class="flip-card__input" name="tanggal_lahir" placeholder="Tanggal Lahir" type="date" required>
                            <input class="flip-card__input" name="alamat" placeholder="Alamat" type="text" required>
                            <input class="flip-card__input" name="username" placeholder="Username" type="text" required>
                            <input class="flip-card__input" name="password" placeholder="Password" type="password" required>
                            <input class="flip-card__input" name="confirm" placeholder="Confirm Password" type="password" required>
                            <div class="">
                                <button class="flip-card__btn" name="regis">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="flip-card__back">

                    </div>
                </div>
            </label>
        </div>
    </div>
</body>

</html>