<?php
  require_once "config/init.php";
  global $link;
  if (isset($_POST['btnhapus'])) {
    $query = mysqli_query($link, "DELETE FROM materi_mapel WHERE id='$_POST[idform]'");
    if ($query) {
      echo "<script>
              document.location='view-kelas.php?id=".$_POST['idkelasform']."';
            </script>";
    }
  }
?>
