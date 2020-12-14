<?php
  require_once "config/init.php";
  global $link;
  if (isset($_POST['btnhapus'])) {
    $query = mysqli_query($link, "DELETE FROM materi_mapel WHERE id='$_POST[idform]'");
    $query2 = mysqli_query($link, "DELETE FROM tugas WHERE kode_aktivitas_tugas='$_POST[idaktiv2]'");
    $query3 = mysqli_query($link, "DELETE FROM tugas2 WHERE kode_aktivitas2='$_POST[idaktiv2]'");
    $query4 = mysqli_query($link, "DELETE FROM presensi WHERE kode_aktivitas='$_POST[idaktiv1]'");
    $query4 = mysqli_query($link, "DELETE FROM presensi2 WHERE kode_aktivitas='$_POST[idaktiv1]'");
    if ($query) {
      echo "<script>
              document.location='view-kelas.php?id=".$_POST['idkelasform']."';
            </script>";
    }
  }
?>
