<?php
include 'templates/header-admin.php';
if (isset($_GET['id'])) {
  $id=$_GET['id'];
  $idm = $_GET['idm'];
  $idk = $_GET['idk'];
}
$query=mysqli_query($link, "delete from siswa where nis='$id'");
if ($query) {
    echo "<script>document.location='admin-siswa-kelas.php?id=".$idm."&idk=".$idk."'</script>";
}
 ?>
