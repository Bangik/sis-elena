<?php
  require_once "config/init.php";
  $kode_aktivitas = $_GET['id'];
  $idm = $_GET['idm'];
  $idg = $_GET['idg'];

  $kodeMapelGuruQuery = mysqli_query($link, "SELECT * FROM tb_mengajar where kode_guru='$idg' and kode_kelas='$idm'");
  $kodeMapelGuru = mysqli_fetch_array($kodeMapelGuruQuery);
  $kodeMapelGuru2 = $kodeMapelGuru['kode_mapel'];

  $tampil_tugas_query = mysqli_query($link, "SELECT tugas.jam, tugas.tanggal, tugas.status, tugas.file, tugas.nilai, mapel.nama_mapel, siswa.nis, siswa.nama FROM tugas LEFT JOIN mapel ON tugas.kode_mapel = mapel.kode_mapel LEFT JOIN siswa ON tugas.nis=siswa.nis WHERE tugas.kode_mapel='$kodeMapelGuru2' AND tugas.kode_aktivitas_tugas='$kode_aktivitas' ORDER BY siswa.nis  ASC ");

  $query2 = mysqli_query($link, "SELECT nama FROM kelas WHERE kd_kelas='$idm' ");
  $nama_kelas = mysqli_fetch_array($query2);

  header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Nilai Kelas " .$nama_kelas['nama'] .".xls");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title></title>
  </head>
  <body>
    <div class="text-center">
      <h2>DATA NILAI DAN TUGAS KELAS <?php echo $nama_kelas['nama']; ?></h2>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Jam</th>
          <th scope="col">Tanggal</th>
          <th scope="col">File</th>
          <th scope="col">Nilai</th>
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
          <td><?php echo $tampil_tugas['file']; ?></td>
          <td><?php echo $tampil_tugas['nilai'];?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </body>
</html>
