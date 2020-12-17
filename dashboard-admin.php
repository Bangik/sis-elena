<?php
  include 'templates/header-admin.php';

  $query = mysqli_query($link, "SELECT COUNT(nip) AS jumlah FROM guru");
  $hasil = mysqli_fetch_array($query);

  $query2 = mysqli_query($link, "SELECT COUNT(siswa.nis) AS jumlah FROM kelas LEFT JOIN siswa ON siswa.kode_kelas = kelas.kd_kelas WHERE kelas.tingkatan='1'");
  $hasil2 = mysqli_fetch_array($query2);

  $query3 = mysqli_query($link, "SELECT COUNT(siswa.nis) AS jumlah FROM kelas LEFT JOIN siswa ON siswa.kode_kelas = kelas.kd_kelas WHERE kelas.tingkatan='2'");
  $hasil3 = mysqli_fetch_array($query3);

  $query4 = mysqli_query($link, "SELECT COUNT(siswa.nis) AS jumlah FROM kelas LEFT JOIN siswa ON siswa.kode_kelas = kelas.kd_kelas WHERE kelas.tingkatan='3'");
  $hasil4 = mysqli_fetch_array($query4);
 ?>
 <!-- main start-->
 <div class="container">
   <div class="row row-cols-1 row-cols-md-4 text-center">
     <div class="col mb-4">
       <div class="card">
         <a href="admin-guru.php" class="text-color-a">
           <img src="./asset/img/icon-teach.png" class="card-img-top mx-auto d-block" alt="..." style="width:70%">
           <div class="card-body">
             <h5 class="card-title"><?php echo $hasil['jumlah']; ?></h5>
             <h5 class="card-title">DATA GURU</h5>
           </div>
         </a>
       </div>
     </div>
     <div class="col mb-4">
       <div class="card">
         <a href="admin-pilih-kelas.php?id=1" class="text-color-a">
           <img src="./asset/img/icon-class.png" class="card-img-top mx-auto d-block" alt="..." style="width:70%">
           <div class="card-body">
             <h5 class="card-title"><?php echo $hasil2['jumlah']; ?></h5>
             <h5 class="card-title">DATA KELAS X</h5>
           </div>
         </a>
       </div>
     </div>
     <div class="col mb-4">
       <div class="card">
         <a href="admin-pilih-kelas.php?id=2" class="text-color-a">
           <img src="./asset/img/icon-class.png" class="card-img-top mx-auto d-block" alt="..." style="width:70%">
           <div class="card-body">
             <h5 class="card-title"><?php echo $hasil3['jumlah']; ?></h5>
             <h5 class="card-title">DATA KELAS XI</h5>
           </div>
         </a>
       </div>
     </div>
     <div class="col mb-4">
       <div class="card">
         <a href="admin-pilih-kelas.php?id=3" class="text-color-a">
           <img src="./asset/img/icon-class.png" class="card-img-top mx-auto d-block" alt="..." style="width:70%">
           <div class="card-body">
             <h5 class="card-title"><?php echo $hasil4['jumlah']; ?></h5>
             <h5 class="card-title">DATA KELAS XII</h5>
           </div>
         </a>
       </div>
     </div>
   </div>
 </div>
 <!-- main end-->
<?php
 include 'templates/footer.php' ?>
