<?php
  require_once "config/init.php";
  global $link;
  if (isset($_POST['btnchek'])) {
    if ($_POST['statusform'] == "completion-manual-y") {
      $query = mysqli_query($link, "UPDATE materi_mapel SET checkbox='completion-manual-n' WHERE id='$_POST[idform]'");
      if ($query) {
        echo "<script>
                document.location='view-mapel.php?id=".$_POST['kode_mapel_form']."';
              </script>";
      }
    }elseif ($_POST['statusform'] == "completion-manual-n") {
      $query2 = mysqli_query($link, "UPDATE materi_mapel SET checkbox='completion-manual-y' WHERE id='$_POST[idform]'");
      if ($query2) {
        echo "<script>
                document.location='view-mapel.php?id=".$_POST['kode_mapel_form']."';
              </script>";
      }
    }
  }



?>
