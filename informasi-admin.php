<?php
  include 'templates/header-admin.php';

  $query = mysqli_query($link, "SELECT * FROM informasi ORDER BY id");

  if (isset($_POST['simpan']) && isset($_POST['tujuan'])) {
    $query_update = mysqli_query($link, "UPDATE informasi SET judul_informasi='$_POST[judul_informasi]', deskripsi='$_POST[deskripsi]', tujuan='$_POST[tujuan]' WHERE id='$_POST[id]'");
    if ($query_update) {
      echo "<script>
              document.location='informasi-admin.php';
            </script>";
    }
  }
  if (isset($_POST['btn-tambah'])) {
    $query_tambah = mysqli_query($link, "INSERT INTO informasi(judul_informasi, deskripsi, tujuan) VALUES('$_POST[judul]', '$_POST[desk]', '$_POST[tujuans]')");
    if ($query_tambah) {
      echo "<script>
              document.location='informasi-admin.php';
            </script>";
    }
  }


?>
    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-1">
        <div class="col mb-4">
          <div class="card">
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Judul Informasi</th>
                  <th>Deskripsi</th>
                  <th>Tujuan</th>
                  <th colspan="2">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no=1;
                  while ($data = mysqli_fetch_array($query)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $data["judul_informasi"]; ?></td>
                    <td><?php echo $data["deskripsi"];   ?></td>
                    <td><?php echo $data["tujuan"];   ?></td>
                    <td>
                      <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $data['id']; ?>">Ubah</a>
                    </td>
                    <td><a href="delete-informasi.php?id=<?php echo $data['id']; ?>" class="btn btn-danger" role="button" onclick="return confirm('apakah anda ingin menghapus data ini?')">Hapus</a></td>
                  </tr>
                  <!-- The Modal -->
                  <div class="modal fade" id="myModal<?php echo $data['id']; ?>">
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
                              <label>Judul Informasi</label>
                              <input type="hidden" name="id" class="form-control" value="<?php echo $data['id']; ?>">
                              <input type="text" name="judul_informasi" class="form-control" placeholder="Input Judul">
                            </div>
                            <div class="form-group">
                              <label>Deskripsi</label>
                              <textarea name="deskripsi" class="form-control" placeholder="Input Deskripsi"></textarea>
                            </div>
                            <div class="form-group">
                              <label>Tujuan</label>
                              <input type="radio" name="tujuan" class="form-control-inline ml-3" value="Seluruh Siswa" checked>Seluruh Siswa</input>
                              <input type="radio" name="tujuan" class="form-control-inline ml-3" value="Guru">Guru</input>
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
            <h4 class="modal-title">Tambah Informasi</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <form action="" method="post">
              <div class="form-group">
                <label>Judul Informasi</label>
                <input type="hidden" name="id" class="form-control" value="<?php echo $data['id']; ?>">
                <input type="text" name="judul" class="form-control" placeholder="Input Judul">
              </div>
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="desk" class="form-control" placeholder="Input Deskripsi"></textarea>
              </div>
              <div class="form-group">
                <label>Tujuan</label>
                <input type="radio" name="tujuans" class="form-control-inline ml-3" value="Seluruh Siswa" checked>Seluruh Siswa</input>
                <input type="radio" name="tujuans" class="form-control-inline ml-3" value="Guru">Guru</input>
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
