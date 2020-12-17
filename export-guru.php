<?php
require_once "config/init.php";

  header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Daftar-guru.xls");
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
      <div class="row row-cols-1 row-cols-md-1">
        <div class="col mb-4">
          <div class="text-center">
            <h2>DAFTAR GURU</h2>
          </div>
          <div class="card">
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nip</th>
                  <th>Nama</th>
                  <th>Password</th>
                  <th>Alamat</th>
                  <th>Email</th>
                  <th>Mapel</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $hasil=mysqli_query($link, "SELECT guru.nip, guru.nama, guru.password_guru, guru.alamat, guru.email, mapel.nama_mapel FROM guru LEFT JOIN mapel ON guru.kode_mapel = mapel.kode_mapel order by nip desc");
                  $no=1;
                  while ($data = mysqli_fetch_array($hasil)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $data["nip"]; ?></td>
                    <td><?php echo $data["nama"];   ?></td>
                    <td><?php echo $data["password_guru"];   ?></td>
                    <td><?php echo $data["alamat"];   ?></td>
                    <td><?php echo $data["email"];   ?></td>
                    <td><?php echo $data["nama_mapel"];   ?></td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
