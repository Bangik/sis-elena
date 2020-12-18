<?php
  include 'templates/header-guru.php';

  if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];
  }
  $kode_guru = $rowUser['nip'];

  $query_kode_mapel = mysqli_query($link, "SELECT tb_mengajar.kode_guru, tb_mengajar.kode_mapel, tb_mengajar.kode_kelas FROM tb_mengajar LEFT JOIN kelas ON tb_mengajar.kode_kelas = kelas.kd_kelas WHERE tb_mengajar.kode_guru='$kode_guru' AND tb_mengajar.kode_kelas='$id_kelas'");
  $hasil_query_kode_mapel = mysqli_fetch_array($query_kode_mapel);
  $hasil = $hasil_query_kode_mapel['kode_mapel'];

  $query = mysqli_query($link, "SELECT tugas.nis, tugas.kode_mapel, tugas.nilai, siswa.nama, AVG(tugas.nilai) AS rata FROM tugas LEFT JOIN siswa ON tugas.nis = siswa.nis WHERE kode_mapel='$hasil' GROUP BY tugas.nis");

?>

    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-1 text-center">
        <div class="col mb-4">
          <div class="text-center h2" style="display:none;">
            <h2>REKAP NILAI TUGAS</h2>
          </div>
          <div class="card table-responsive-lg">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Rata - Rata Nilai</th>
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
                  <td><?php
                    if (is_null($hasil['rata'])) {
                      echo 0;
                    }else {
                      echo round($hasil['rata'],1);
                    }

                  ?></td>
                </tr>
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col mb-4">
          <form action="" method="post">
            <div class="form-row">
              <a href="export-rekap-nilai.php?id=<?php echo $id_kelas;?>&idm=<?php echo $kode_guru; ?>" type="button" name="btn_export" class="btn btn-success mr-4 btn-print2">Export Excel</a>
              <a href="#" type="button" class="btn btn-success mr-4 btn-print btn-print2">Print</a>
              <a href="rekap-nilai-kelas.php" class="btn btn-success" role="button">Kembali</a>
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
