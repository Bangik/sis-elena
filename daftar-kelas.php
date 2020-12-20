<?php
  include 'templates/header-admin.php';

  $query = mysqli_query($link, "SELECT * FROM kelas ORDER BY kd_kelas");

  if (isset($_POST['simpan']) && isset($_POST['nama_kelas'])) {
    $query_update = mysqli_query($link, "UPDATE kelas SET kd_kelas='$_POST[kode_kelas_baru]', nama='$_POST[nama_kelas]' WHERE kd_kelas='$_POST[kode_kelas]'");
    if ($query_update) {
      echo "<script>
              document.location='daftar-kelas.php';
            </script>";
    }
  }
  if (isset($_POST['btn-tambah'])) {
    $query_tambah = mysqli_query($link, "INSERT INTO kelas(kd_kelas, nama, tingkatan) VALUES('$_POST[kd_kelas]', '$_POST[nama]', '$_POST[tingkatans]')");
    if ($query_tambah) {
      echo "<script>
              document.location='daftar-kelas.php';
            </script>";
    }
  }


?>
    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-1">
        <div class="col mb-4">
          <div class="card">
            <div class="card-body table-responsive-lg">
              <table class="table table-hover text-center">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Kelas</th>
                  <th>Nama</th>
                  <th>Tingkatan Kelas</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no=1;
                  while ($data = mysqli_fetch_array($query)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $data["kd_kelas"]; ?></td>
                    <td><?php echo $data["nama"];   ?></td>
                    <td><?php echo $data["tingkatan"];   ?></td>
                    <td>
                      <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $data['kd_kelas']; ?>">Ubah</a>
                    </td>
                  </tr>
                  <!-- The Modal -->
                  <div class="modal fade" id="myModal<?php echo $data['kd_kelas']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Ubah Data</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                          <form action="" method="post">
                            <div class="form-group">
                              <label>Kode Kelas</label>
                              <input type="hidden" name="kode_kelas" value="<?php echo $data['kd_kelas']; ?>">
                              <input type="text" name="kode_kelas_baru" class="form-control" placeholder="Input Kode Kelas">
                            </div>
                            <div class="form-group">
                              <label>Nama Kelas</label>
                              <input type="text" name="nama_kelas" class="form-control" placeholder="Input Nama Kelas">
                            </div>
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
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="mb-4">
        <a href="#" class="btn mr-4 btn-success" role="button" data-toggle="modal" data-target="#myModal">Tambah Informasi</a>
        <a href="akademik-admin.php" class="btn btn-success" role="button">Kembali</a>
      </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Tambah Kelas</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <form action="" method="post">
              <div class="form-group">
                <label>Kode Kelas</label>
                <input type="text" name="kd_kelas" class="form-control" placeholder="Input Kode Kelas">
              </div>
              <div class="form-group">
                <label>Nama Kelas</label>
                <input type="text" name="nama" class="form-control" placeholder="Input Nama Kelas">
              </div>
              <div class="form-group">
                <label>Tingkatan Kelas</label>
                <input type="radio" name="tingkatans" class="form-control-inline ml-3" value="1" checked>1</input>
                <input type="radio" name="tingkatans" class="form-control-inline ml-3" value="2">2</input>
                <input type="radio" name="tingkatans" class="form-control-inline ml-3" value="3">3</input>
              </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" name="btn-tambah">Simpan Perubahan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- main end-->

<?php
  include 'templates/footer.php'
?>
