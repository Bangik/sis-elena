<?php
  include 'templates/header.php';

  $kode_siswa = $rowUser['nis'];

  $query = mysqli_query($link, "SELECT mapel.nama_mapel, COUNT(presensi.status) AS jumlah, COUNT(presensi.catatan) AS total FROM mapel LEFT JOIN presensi ON presensi.kode_mapel = mapel.kode_mapel WHERE nis='$kode_siswa' GROUP BY mapel.nama_mapel");

?>
    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-1 text-center">
        <div class="col mb-4">
          <div class="card table-responsive-lg">
            <div class="card-body">
              <div class="card-title">
                <h5>Rekap Presensi <?php echo $rowUser['nama']; ?></h5>
              </div>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Mata Pelajaran</th>
                    <th scope="col">Jumlah Presensi</th>
                    <th scope="col">Total Aktivitas Presensi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    while ($hasil = mysqli_fetch_array($query)):
                  ?>
                  <tr>
                    <td><?php echo $hasil['nama_mapel']; ?></td>
                    <td><?php echo $hasil['jumlah'];?></td>
                    <td><?php echo $hasil['total'] ?></td>
                  </tr>
                <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- main end-->

<?php include 'templates/footer.php' ?>
