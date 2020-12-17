<?php
require_once "config/init.php";
if (isset($_GET['id'])) {
  $id_kelas = $_GET['id'];
  $kode_guru = $_GET['idm'];
}

$query_kode_mapel = mysqli_query($link, "SELECT tb_mengajar.kode_guru, tb_mengajar.kode_mapel, tb_mengajar.kode_kelas FROM tb_mengajar LEFT JOIN kelas ON tb_mengajar.kode_kelas = kelas.kd_kelas WHERE tb_mengajar.kode_guru='$kode_guru' AND tb_mengajar.kode_kelas='$id_kelas'");
$hasil_query_kode_mapel = mysqli_fetch_array($query_kode_mapel);
$hasil = $hasil_query_kode_mapel['kode_mapel'];

$query = mysqli_query($link, "SELECT tugas.nis, tugas.kode_mapel, tugas.nilai, siswa.nama, AVG(tugas.nilai) AS rata FROM tugas LEFT JOIN siswa ON tugas.nis = siswa.nis WHERE kode_mapel='$hasil' GROUP BY tugas.nis");
  header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Nilai Kelas " .$id_kelas .".xls");
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
          <div class="card">
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
                  while ($hasil2 = mysqli_fetch_array($query)):
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $hasil2['nama']; ?></td>
                  <td><?php
                    if (is_null($hasil2['rata'])) {
                      echo 0;
                    }else {
                      echo $hasil2['rata'];
                    }

                  ?></td>
                </tr>
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
  </body>
</html>
