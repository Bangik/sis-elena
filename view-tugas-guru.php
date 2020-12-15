<?php
  include 'templates/header-guru.php';
  $kode_aktivitas = $_GET['id'];
  $idm = $_GET['idm'];
  $kodeGuru = $rowUser['nip'];

  $date_now = date("Y-m-d");
  $time_now = date("H:i:s");

  $kodeMapelGuruQuery = mysqli_query($link, "SELECT * FROM tb_mengajar where kode_guru='$kodeGuru' and kode_kelas='$idm'");
  $kodeMapelGuru = mysqli_fetch_array($kodeMapelGuruQuery);
  $kodeMapelGuru2 = $kodeMapelGuru['kode_mapel'];

  $tampil_tugas_query = mysqli_query($link, "SELECT tugas.jam, tugas.tanggal, tugas.status, tugas.file, mapel.nama_mapel, siswa.nis, siswa.nama FROM tugas LEFT JOIN mapel ON tugas.kode_mapel = mapel.kode_mapel LEFT JOIN siswa ON tugas.nis=siswa.nis WHERE tugas.kode_mapel='$kodeMapelGuru2' AND tugas.kode_aktivitas_tugas='$kode_aktivitas' ORDER BY siswa.nis  ASC ");
?>
<!-- main start-->
<div class="container">
  <div class="row row-cols-1 row-cols-md-1">
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
                  <td></td>
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

<?php
include 'templates/footer.php'
?>
