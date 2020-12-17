<?php
include 'templates/header-admin.php';
if (isset($_GET['id'])) {
  $id=$_GET['id'];
}
$query=mysqli_query($link, "delete from guru where nip='$id'");
if ($query) {
    echo "<script>document.location='admin-guru.php'</script>";
}
 ?>
