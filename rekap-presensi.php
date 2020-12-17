<?php
  include 'templates/header-guru.php';

  if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];
  }
  $kode_guru = $rowUser['nip'];

  $query_kode_mapel = mysqli_query($link, "SELECT tb_mengajar.kode_guru, tb_mengajar.kode_mapel, tb_mengajar.kode_kelas FROM tb_mengajar LEFT JOIN kelas ON tb_mengajar.kode_kelas = kelas.kd_kelas WHERE tb_mengajar.kode_guru='$kode_guru' AND tb_mengajar.kode_kelas='$id_kelas'");
  $hasil_query_kode_mapel = mysqli_fetch_array($query_kode_mapel);
  $hasil = $hasil_query_kode_mapel['kode_mapel'];

  $query = mysqli_query($link, "SELECT presensi.nis, presensi.kode_mapel, presensi.status AS masuk, COUNT(presensi.status) AS jumlah, siswa.nama, COUNT(presensi.catatan) AS rata FROM presensi LEFT JOIN siswa ON presensi.nis = siswa.nis WHERE kode_mapel='$hasil' GROUP BY presensi.nis");

?>

    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-1 text-center">
        <div class="col mb-4">
          <div class="text-center h2" style="display:none;">
            <h2>REKAP PRESENSI</h2>
          </div>
          <div class="card">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
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
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $hasil['nama']; ?></td>
                  <td><?php echo $hasil['jumlah'];?></td>
                  <td><?php echo $hasil['rata'] ?></td>
                </tr>
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col mb-4">
          <form action="" method="post">
            <div class="form-row">
              <a href="export-rekap-presensi.php?id=<?php echo $id_kelas;?>&idm=<?php echo $kode_guru; ?>" type="button" name="btn_export" class="btn btn-success mr-4 btn-print2">Export Excel</a>
              <button href="#" type="button" class="btn btn-success mr-4 btn-print btn-print2">Print</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- main end-->
    <script type="text/javascript">
      $(document).ready(function(){
        $(".btn-print").click(function(){
          $(".btn-print2").hide();
          $(".h2").show();
          window.print();
          $(".btn-print2").show();
          $(".h2").hide();
        })
      });
    </script>

<?php include 'templates/footer.php' ?>
