<?php
include 'templates/header-admin.php';
if (isset($_GET['id'])) {
  $id=$_GET['id'];
}
$query=mysqli_query($link, "DELETE from informasi where id='$id'");
if ($query) {
    echo "<script>document.location='informasi-admin.php'</script>";
}
 ?>
