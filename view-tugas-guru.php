<?php
  include 'templates/header-guru.php';
  $kode_aktivitas = $_GET['id'];
  $idm = $_GET['idm'];
  $kodeGuru = $rowUser['nip'];

  $date_now = date("Y-m-d");
  $time_now = date("H:i:s");

  if (isset($_POST['simpan'])) {
    $nilai = $_POST['input_nilai'];
    $kode_siswa2 = $_POST['kode_aktivitas_siswa'];
    $querynya = mysqli_query($link, "UPDATE tugas SET nilai='$nilai' WHERE kode_aktivitas_tugas='$kode_aktivitas' AND nis='$kode_siswa2'");
  }

  $kodeMapelGuruQuery = mysqli_query($link, "SELECT * FROM tb_mengajar where kode_guru='$kodeGuru' and kode_kelas='$idm'");
  $kodeMapelGuru = mysqli_fetch_array($kodeMapelGuruQuery);
  $kodeMapelGuru2 = $kodeMapelGuru['kode_mapel'];

  $tampil_tugas_query = mysqli_query($link, "SELECT tugas.jam, tugas.tanggal, tugas.status, tugas.file, tugas.nilai, mapel.nama_mapel, siswa.nis, siswa.nama FROM tugas LEFT JOIN mapel ON tugas.kode_mapel = mapel.kode_mapel LEFT JOIN siswa ON tugas.nis=siswa.nis WHERE tugas.kode_mapel='$kodeMapelGuru2' AND tugas.kode_aktivitas_tugas='$kode_aktivitas' ORDER BY siswa.nis  ASC ");

  $query_tugas2 = mysqli_query($link, "SELECT nama_tugas FROM tugas2 WHERE kode_aktivitas2='$kode_aktivitas'");
  $nama_tugas = mysqli_fetch_array($query_tugas2);
?>
<!-- main start-->
<div class="container">
  <div class="row row-cols-1 row-cols-md-1">
    <div class="col mb-4">
      <div class="text-center h2" style="display:none;">
        <h2>DAFTAR NILAI TUGAS : <?php echo $nama_tugas['nama_tugas']; ?></h2>
      </div>
      <form action="" method="post">
        <div class="form-row">
          <a href="export-tugas.php?id=<?php echo $kode_aktivitas;?>&idm=<?php echo $idm; ?>&idg=<?php echo $kodeGuru; ?>" type="button" name="btn_export" class="btn btn-success mr-4 btn-print2">Export Excel</a>
          <a href="export-zip.php?id=<?php echo $kode_aktivitas;?>&idm=<?php echo $idm; ?>&idg=<?php echo $kodeGuru; ?>" type="button" name="btn_export" class="btn btn-success mr-4 btn-print2">Download Semua File Siswa</a>
          <a href="#" type="button" class="btn btn-success mr-4 btn-print btn-print2">Print</a>
        </div>
      </form>
    </div>
    <div class="col mb-4">
      <div class="card">
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jam</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">File</th>
                  <th scope="col">Nilai</th>
                  <th scope="col" class="btn-print2">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1;
                  while ($tampil_tugas = mysqli_fetch_array($tampil_tugas_query)):
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $tampil_tugas['nama']; ?></td>
                  <td><?php echo $tampil_tugas['jam']; ?></td>
                  <td><?php echo date('d M y', strtotime($tampil_tugas['tanggal'])); ?></td>
                  <td><a href="download.php?file=<?php echo $tampil_tugas['file']; ?>"><?php echo $tampil_tugas['file']; ?></a></td>
                  <td><?php echo $tampil_tugas['nilai'];?></td>
                  <td class="btn-print2"><a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php
                  $nis = $tampil_tugas['nis'];
                  echo $nis; ?>">Nilai</a></td>
                </tr>
                <!-- The Modal -->
                <div class="modal fade" id="myModal<?php echo $tampil_tugas['nis']; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Beri Nilai</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                        <form action="" method="post">
                          <div class="form-group">
                            <label>Input Nilai</label>
                            <input type="text" name="input_nilai" class="form-control" placeholder="Input Nilai" required>
                          </div>
                          <input type="hidden" class="inputan" name="kode_aktivitas_siswa" value="<?php echo $tampil_tugas['nis']; ?>">
                      </div>
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan Perubahan</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
              </tbody>
            </table>
        </div>
      </div>
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

<?php
include 'templates/footer.php'
?>
