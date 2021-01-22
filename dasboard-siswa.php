<?php
  include 'templates/header.php';

  $kelasUser = $rowUser['kode_kelas'];
  $nis = $rowUser['nis'];
  $tampilMapel = mysqli_query($link, "SELECT nama_mapel, kode_mapel FROM mapel where kode_kelas = '$kelasUser'");

?>
    <div class="mt-0">
      <marquee scrollamount="7" class="font-weight-bold"> Klik 5x Dimana Saja untuk Melihat Aktivitas Terkini </marquee>
    </div>
    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-4 text-center">
        <?php
          $no = 1;
          while ($dataMapel = mysqli_fetch_array($tampilMapel)) :
            $queryhitung = mysqli_query($link, "SELECT COUNT(checkbox) AS total FROM presensi WHERE kode_mapel='$dataMapel[kode_mapel]' AND nis='$nis'");
            $data_hitung = mysqli_fetch_array($queryhitung);

            $queryhitung1 = mysqli_query($link, "SELECT COUNT(checkbox) AS total2 FROM tugas WHERE kode_mapel='$dataMapel[kode_mapel]' AND nis='$nis'");
            $data_hitung1 = mysqli_fetch_array($queryhitung1);

            $queryhitung2 = mysqli_query($link, "SELECT COUNT(checkbox) AS y FROM presensi WHERE kode_mapel='$dataMapel[kode_mapel]' and checkbox='completion-manual-y' AND nis='$nis'");
            $data_hitung2 = mysqli_fetch_array($queryhitung2);

            $queryhitung3 = mysqli_query($link, "SELECT COUNT(checkbox) AS y2 FROM tugas WHERE kode_mapel='$dataMapel[kode_mapel]' and checkbox='completion-manual-y' AND nis='$nis'");
            $data_hitung3 = mysqli_fetch_array($queryhitung3);

            if ($data_hitung['total'] == 0 and $data_hitung1['total2'] == 0) {
              $present = 0;
            }
            else {
              $present = ($data_hitung2['y'] + $data_hitung3['y2']) / ($data_hitung['total'] + $data_hitung1['total2']) * 100;
            }


        ?>
        <div class="col mb-4 cardss">
          <div class="card">
            <a href="view-mapel.php?id=<?php echo $dataMapel['kode_mapel'];?>" class="text-color-a">
              <img src="./asset/img/img<?php echo $no++; ?>.svg" class="card-img-top mx-auto d-block" alt="..." style="width:100%; height:100%;">
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
        if ($no == 11) {
          $no = 1;
        }
          endwhile;

        ?>
      </div>
    </div>
    <!-- main end-->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Informasi</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <?php
              $last_week = date("Y-m-d", time() - 604800);
              $future = date("Y-m-d", time()  + 31557600);

              $query_informasi = mysqli_query($link, "SELECT presensi2.nama_presensi, presensi2.tanggal_akhir, presensi2.jam_akhir, tugas2.nama_tugas, tugas2.tanggal_akhir, tugas2.jam_akhir, materi_mapel.kode_aktivitas, materi_mapel.kode_aktivitas2, mapel.nama_mapel, mapel.kode_mapel FROM materi_mapel LEFT JOIN presensi2 ON presensi2.kode_aktivitas = materi_mapel.kode_aktivitas LEFT JOIN tugas2 on tugas2.kode_aktivitas2 = materi_mapel.kode_aktivitas2 LEFT JOIN mapel ON materi_mapel.kode_mapel = mapel.kode_mapel WHERE mapel.kode_kelas = '$kelasUser' AND presensi2.tanggal_akhir BETWEEN '$last_week' AND '$future' or tugas2.tanggal_akhir BETWEEN '$last_week' AND '$future' ORDER BY presensi2.tanggal_akhir DESC, tugas2.tanggal_akhir DESC");

              while ($row_informasi = mysqli_fetch_row($query_informasi)) {
                $querychek = mysqli_query($link, "SELECT checkbox FROM presensi WHERE nis ='$nis' AND kode_aktivitas='$row_informasi[6]'");
                $hasil = mysqli_fetch_array($querychek);

                $querychek2 = mysqli_query($link, "SELECT checkbox FROM tugas WHERE nis ='$nis' AND kode_aktivitas_tugas='$row_informasi[7]'");
                $hasil2 = mysqli_fetch_array($querychek2);
            ?>
            <div class="col mb-3">
              <div class="card">
                <?php echo "<h5 class='ml-2 mt-2'> <a href='view-mapel.php?id=".$row_informasi[9]."'>".$row_informasi[8]."</a </h5>";
                ?>
                <div class="card-body">
                  <?php
                  if ($row_informasi[1] != "") { ?>

                  <h6> <a href="view-presensi.php?id=<?php echo $row_informasi[6]; ?>"><?php echo $row_informasi[0]; ?></a> </h6>
                  <h6> Deadline <?php echo date('d M y', strtotime($row_informasi[1])) . ",". date(' H:i', strtotime($row_informasi[2])) . "<img class='float-right' src='./asset/img/".$hasil['checkbox'].".svg'>"; ?></h6>
                  <?php }if ($row_informasi[3]) { ?>

                  <h6> <a href="view-assign.php?id=<?php echo $row_informasi[7]; ?>"><?php echo $row_informasi[3]; ?></a> </h6>
                  <h6> Deadline <?php echo date('d M y', strtotime($row_informasi[4])) . ",". date(' H:i', strtotime($row_informasi[5])). "<img class='float-right' src='./asset/img/".$hasil2['checkbox'].".svg'>"; ?></h6>
                  <?php } ?>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="./asset/js/animatejs.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      let klik = 0;
      $('html').click(function(){
        klik ++;
        if (klik == 5) {
          $('#myModal').modal('show');
          klik = 0;
        };
      });
    })
    </script>

<?php include 'templates/footer.php' ?>
