<?php
require_once "config/init.php";
  if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];
    $kode_guru = $_GET['idm'];
  }

  $query_kode_mapel = mysqli_query($link, "SELECT tb_mengajar.kode_guru, tb_mengajar.kode_mapel, tb_mengajar.kode_kelas FROM tb_mengajar LEFT JOIN kelas ON tb_mengajar.kode_kelas = kelas.kd_kelas WHERE tb_mengajar.kode_guru='$kode_guru' AND tb_mengajar.kode_kelas='$id_kelas'");
  $hasil_query_kode_mapel = mysqli_fetch_array($query_kode_mapel);
  $hasil = $hasil_query_kode_mapel['kode_mapel'];

  $query = mysqli_query($link, "SELECT presensi.nis, presensi.kode_mapel, presensi.status AS masuk, COUNT(presensi.status) AS jumlah, siswa.nama, COUNT(presensi.catatan) AS rata FROM presensi LEFT JOIN siswa ON presensi.nis = siswa.nis WHERE kode_mapel='$hasil' GROUP BY presensi.nis");

  $query2 = mysqli_query($link, "SELECT nama FROM kelas WHERE kd_kelas='$id_kelas' ");
  $nama_kelas = mysqli_fetch_array($query2);

  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Rekap Presensi Kelas " .$nama_kelas['nama'] .".xls");
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
    <div class="container">
      <div class="row row-cols-1 row-cols-md-1 text-center">
        <div class="col mb-4">
          <div class="text-center">
            <h2>REKAP PRESENSI KELAS <?php echo $nama_kelas['nama']; ?></h2>
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
      </div>
    </div>
  </body>
</html>
