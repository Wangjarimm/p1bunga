<?php 

require '../function.php';
$id = $_GET["id"];

$query = mysqli_query($connect, "SELECT * FROM pasien WHERE id = $id");
$data = mysqli_fetch_array($query);

// $count = mysqli_num_rows($query);

function hapus($id) {
    global $connect;
    mysqli_query($connect, "DELETE FROM pasien WHERE id = $id");

    return mysqli_affected_rows($connect);
}


if ( hapus($id) > 0 ) {
    echo
    "<script>
        alert('Data berhasil dihapus');
        window.location.href = 'datareservasi.php';
    </script>";
} else {
     echo
    "<script>
        alert('Data gagal dihapus');
        window.location.href = 'datareservasi.php';
    </script>";
}



?>