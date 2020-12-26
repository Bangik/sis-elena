<?php
echo "<div class='d-flex justify-content-between'>
  <a href='view-presensi.php?id= " . $tampilMateri['kode_aktivitas'] . "' class='card-text text-color-a' ><p> ". $tampilMateri['nama_presensi'] ."</p></a>
  <form action='completes.php' method='post' class='float-right' id='forms'>
    <input type='text' name='idform' value=' ". $tampilMateri['kode_aktivitas'] ."'>
    <input type='text' name='nis' value='".$nis."'>
    <input type='text' name='statusform' value='".$hasil['checkbox']."'>
    <input type='text' name='kode_mapel_form' value='".$tampilMateri['kode_mapel']."'>
    <button type='submit' name='btnchek_presensi' class= 'btn btn-link'>
      <img src='./asset/img/".$hasil['checkbox'].".svg'>
    </button>
  </form>
</div>"


; ?>



<div class="d-flex justify-content-between" >
  <a href="view-presensi.php?id=<?php echo $tampilMateri['kode_aktivitas']; ?>" class="card-text text-color-a "><p><?php echo $tampilMateri['nama_presensi']; ?></p></a>
  <form action="completes.php" method="post" class=" float-right " id="forms">
    <input type="text" name="idform" value="<?php echo $tampilMateri['kode_aktivitas'];?>">
    <input type="text" name="nis" value="<?php echo $nis?>">
    <input type="text" name="statusform" value="<?php echo $hasil['checkbox'];?>">
    <input type="text" name="kode_mapel_form" value="<?php echo $tampilMateri['kode_mapel'];?>">
    <button type="submit" name="btnchek_presensi" class="btn btn-link" id="1">
      <img src="./asset/img/<?php echo $hasil['checkbox']; ?>.svg">
    </button>
  </form>
</div>
