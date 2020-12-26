<?php
  include 'templates/header-guru.php';
  $mapelGuru = $rowUser['kode_mapel'];
  $tampilMapel = mysqli_query($link, "SELECT nama_mapel FROM mapel where kode_mapel = '$mapelGuru'");
  $kodeKelasGuru = mysqli_fetch_array($tampilMapel);
  $kelasGuru = $kodeKelasGuru['nama_mapel'];
  $listKelas = mysqli_query($link, "SELECT mapel.kode_kelas, mapel.nama_mapel, kelas.nama FROM mapel INNER JOIN kelas ON mapel.kode_kelas=kelas.kd_kelas WHERE mapel.nama_mapel = '$kelasGuru'");
?>

    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-4 text-center">
        <?php
          $no = 1;
          while ($dataMapel = mysqli_fetch_array($listKelas)) :
        ?>
        <div class="col mb-4 cardss">
          <div class="card">
            <a href="rekap-nilai.php?id=<?php echo $dataMapel['kode_kelas']; ?>" class="text-color-a">
              <img src="./asset/img/img<?php echo $no++; ?>.svg" class="card-img-top mx-auto d-block" alt="..." style="width:100%; height:100%;">
              <div class="card-body">
                <h5 class="card-title"><?php echo $dataMapel['nama'] ?></h5>
              </div>
            </a>
          </div>
        </div>
        <?php
        if ($no == 11) {
          $no = 1;
        }
          endwhile;
        ?>
      </div>
      <div class="mb-4 text-center cardss">
        <a href="akademik-guru.php" class="btn btn-danger" role="button"><i class="fa fa-sign-out"></i> Kembali</a>
      </div>
    </div>
    <!-- main end-->
    <script type="text/javascript" src="./asset/js/animatejs.js"></script>

<?php include 'templates/footer.php' ?>
