<?php
  include 'templates/header.php';
  $kode_tugas = $_GET['id'];
  $kode_siswaview = $rowUser['nis'];
  $materi_mapel_query = mysqli_query($link, "SELECT kode_mapel, judul, kode_aktivitas, kode_aktivitas2 FROM materi_mapel WHERE kode_aktivitas2='$kode_tugas'");
  $tampil_materi_query = mysqli_fetch_array($materi_mapel_query);

  $tampil_tugas2 = mysqli_query($link, "SELECT * FROM tugas2 where kode_aktivitas2 = '$kode_tugas'");
  $tampilkan_tugas2 = mysqli_fetch_array($tampil_tugas2);

  $tampil_tugas = mysqli_query($link, "SELECT * FROM tugas where kode_aktivitas_tugas = '$kode_tugas' AND nis='$kode_siswaview'");
  $tampilkan_tugas = mysqli_fetch_array($tampil_tugas);

  $tgl = date('d', strtotime($tampilkan_tugas2['tanggal_akhir']));
  $bulan = date('m', strtotime($tampilkan_tugas2['tanggal_akhir']));
  $tahun = date('Y', strtotime($tampilkan_tugas2['tanggal_akhir']));
  $jam = date('H', strtotime($tampilkan_tugas2['jam_akhir']));
  $menit = date('i', strtotime($tampilkan_tugas2['jam_akhir']));
  $detik = date('s', strtotime($tampilkan_tugas2['jam_akhir']));
  $date_now = time();
  $deadline = mktime($jam,$menit,$detik,$bulan,$tgl,$tahun);
  $rentang = ($deadline-$date_now);
  $sisa_hari = floor($rentang / (60 * 60 * 24));
  $sisa_jam = floor(($rentang - ($sisa_hari*60*60*24)) / (60*60));
?>

    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-1">
        <div class="col mb-4">
          <div class="card-deck">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $tampil_materi_query['judul']; ?></h5>
                  <p class="card-text"><?php echo $tampilkan_tugas2['deskripsi']; ?></p>
                  <a href="download.php?file=<?php echo $tampilkan_tugas2['nama_file']; ?>"><?php echo $tampilkan_tugas2['nama_file']; ?></a>
                </div>
            </div>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card-deck">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Status Tugas</h5>
                  <div class="card bg-transparent border-0 table-responsive-md" style="width: 25rem;">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Status Pengumpulan</td>
                          <td><?php echo $tampilkan_tugas['status']; ?></td>
                        </tr>
                        <tr>
                          <td>Deadline</td>
                          <td><?php echo date('l, d-M-Y', strtotime($tampilkan_tugas2['tanggal_akhir'])) . date(' H:i', strtotime($tampilkan_tugas2['jam_akhir'])); ?></td>
                        </tr>
                        <tr>
                          <td>Sisa Waktu</td>
                          <td>
                            <?php
                              if ($deadline < $date_now) {
                                echo "Selesai";
                              }else {
                                echo $sisa_hari . " Hari " . $sisa_jam . " Jam";
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td>File Tugas</td>
                          <td> <a href="download.php?file=<?php echo $tampilkan_tugas['file']; ?>"><?php echo $tampilkan_tugas['file']; ?></a> </td>
                        </tr>
                        <tr>
                          <td>Nilai</td>
                          <td><?php echo  $tampilkan_tugas['nilai']?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <?php
                  if ($deadline < $date_now){
                  ?>
                  <div class="col text-center">
                    <p class="btn btn-success disabled" style="width: 10rem;" >Tambahkan Tugas</p>
                  </div>
                  <?php
                  }else{
                  ?>
                  <div class="col text-center">
                    <a href="edit-tugas.php?id=<?php echo $kode_tugas; ?>" class="btn btn-success" style="width: 10rem;" >Tambahkan Tugas</a>
                  </div>
                  <?php
                    }
                  ?>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- main end-->

<?php include 'templates/footer.php' ?>
