<?php
  include 'templates/header.php';

  $kelasUser = $rowUser['kode_kelas'];
  $tampilMapel = mysqli_query($link, "SELECT nama_mapel, kode_mapel FROM mapel where kode_kelas = '$kelasUser'");

?>

    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-4 text-center">
        <?php
          while ($dataMapel = mysqli_fetch_array($tampilMapel)) :
            $queryhitung = mysqli_query($link, "SELECT COUNT(checkbox) AS total FROM materi_mapel WHERE kode_mapel='$dataMapel[kode_mapel]'");
            $data_hitung = mysqli_fetch_array($queryhitung);

            $queryhitung2 = mysqli_query($link, "SELECT COUNT(checkbox) AS y FROM materi_mapel WHERE kode_mapel='$dataMapel[kode_mapel]' and checkbox='completion-manual-y'");
            $data_hitung2 = mysqli_fetch_array($queryhitung2);
            if ($data_hitung['total'] == 0) {
              $present = 0;
            }else {
              $present = $data_hitung2['y'] / $data_hitung['total'] * 100;
            }


        ?>
        <div class="col mb-4">
          <div class="card">
            <a href="view-mapel.php?id=<?php echo $dataMapel['kode_mapel'];?>" class="text-color-a">
              <img src="./asset/img/matematika-logo.jpg" class="card-img-top mx-auto d-block" alt="..." style="width:70%">
              <div class="card-body">
                <h5 class="card-title"><?php echo $dataMapel['nama_mapel'];?></h5>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: <?php echo round($present) . '%'; ?>;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo round($present); ?>%</div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <?php
          endwhile;
        ?>
      </div>
    </div>
    <!-- main end-->

<?php include 'templates/footer.php' ?>
