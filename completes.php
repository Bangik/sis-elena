<?php
  require_once "config/init.php";
  global $link;
  if (isset($_POST['btnchek_presensi'])) {
    if ($_POST['statusform'] == "completion-manual-y") {
      $query = mysqli_query($link, "UPDATE presensi SET checkbox='completion-manual-n' WHERE kode_aktivitas='$_POST[idform]' AND nis='$_POST[nis]' AND kode_mapel='$_POST[kode_mapel_form]' ");
      if ($query) {
        echo "<script>
                document.location='view-mapel.php?id=".$_POST['kode_mapel_form']."';
              </script>";
      }
    }elseif ($_POST['statusform'] == "completion-manual-n") {
      $query2 = mysqli_query($link, "UPDATE presensi SET checkbox='completion-manual-y' WHERE kode_aktivitas='$_POST[idform]' AND nis='$_POST[nis]' AND kode_mapel='$_POST[kode_mapel_form]' ");
      //exit;
      if ($query2) {
        echo "<script>
                document.location='view-mapel.php?id=".$_POST['kode_mapel_form']."';
              </script>";
      }
    }
  }

  if (isset($_POST['btnchek_tugas'])) {
    if ($_POST['statusform2'] == "completion-manual-y") {
      $query = mysqli_query($link, "UPDATE tugas SET checkbox='completion-manual-n' WHERE kode_aktivitas_tugas='$_POST[idform2]' AND nis='$_POST[nis_tugas]' AND kode_mapel='$_POST[kode_mapel_form2]' ");
      if ($query) {
        echo "<script>
                document.location='view-mapel.php?id=".$_POST['kode_mapel_form2']."';
              </script>";
      }
    }elseif ($_POST['statusform2'] == "completion-manual-n") {
      $query2 = mysqli_query($link, "UPDATE tugas SET checkbox='completion-manual-y' WHERE kode_aktivitas_tugas='$_POST[idform2]' AND nis='$_POST[nis_tugas]' AND kode_mapel='$_POST[kode_mapel_form2]' ");
      //exit;
      if ($query2) {
        echo "<script>
                document.location='view-mapel.php?id=".$_POST['kode_mapel_form2']."';
              </script>";
      }
    }
  }



?>
