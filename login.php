<?php
session_start();
require 'function.php';

if (isset($_SESSION["pasien"])) {
  header("Location: jadwal.php");
} elseif (isset($_SESSION["admin"])) {
  header("Location: admin/dashboard.php");
}


if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];


  $result = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username'");

  //cek username
  if (mysqli_num_rows($result) === 1) {

    $row = mysqli_fetch_assoc($result);
    //cek password
    $verif = password_verify($password, $row["password"]);
    if ($verif) {
      if ($row['role'] === 'pasien') {
        $_SESSION["pasien"] = true;
        $_SESSION["id"] = $row["id_user"];
        $_SESSION["nama"] = $username;
        echo "<script>
                alert('Berhasil Login');
                window.location.href = 'daftar_dokter.php'
              </script>";
        exit;
      } else {
        $_SESSION["admin"] = true;
        echo "<script>
                alert('Berhasil Login');
                window.location.href = 'admin/dashboard.php'
              </script>";
        exit;
      }
    }
  }
  $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="assets/img/hospital.png" rel="icon">
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
            <div class="title">Sign In</div>
            <?php if (isset($error)) : ?>
              <p class="text-danger">Username atau password salah</p>
            <?php endif; ?>
            <form class="flip-card__form" action="" method="POST">
              <input class="flip-card__input" name="username" placeholder="Username" type="text">
              <input class="flip-card__input" name="password" placeholder="Password" type="password">
              <div class="s">
                <button class="flip-card__btn" name="login">Login</button>
              </div>
              <p class="message">Not registered? <a href="register.php">Create an account</a></p>
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