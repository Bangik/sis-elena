<?php
  include 'templates/header-admin.php';
  if (isset($_POST['simpan'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password_guru'];
    $mapel = $_POST['kode_mapel'];
    //$kode_aktivitas2 = $_POST['aktivitas'];
    $querynya = mysqli_query($link, "UPDATE guru SET nip='$nip', nama='$nama', email='$email', alamat='$alamat', password_guru='$password', kode_mapel='$mapel' WHERE nip='$nip'");
  }
    if (isset($_GET['Nip'])) {
      $id_anggota=$_GET[" nip"];
      $hasil=mysqli_query($link,"delete from guru where id_anggota='$id_anggota' ");
      if ($hasil) {
        echo "<script>document.location='admin_guru.php'</script>";
      }
      else {
        echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
      }
    }
?>
  <div class="container">
    <div class="row row-cols-1 row-cols-md-1">
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Nip</th>
                <th>Nama</th>
                <th>Password</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>mapel</th>
                <th>opsi</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $hasil=mysqli_query($link, "SELECT * FROM guru order by nip desc");
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
                  <td><?php echo $data["kode_mapel"];   ?></td>
                  <td>
                    <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $data['nip']; ?>">Ubah</a>
                    <a href="delete-guru.php?id=<?php echo $data['nip']; ?>" class="btn btn-danger" role="button" onclick="return confirm('apakah anda ingin menghapus data ini?')">Hapus</a>
                  </td>
                </tr>
                <!-- The Modal -->
                <div class="modal fade" id="myModal<?php echo $data['nip']; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Rubah Status Presensi</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <!-- Modal body -->
                      <div class="modal-body">
                        <form action="" method="post">
                          <div class="form-group">
                            <label>Nip</label>
                            <input type="text" name="nip" class="form-control" placeholder="Input nip" required>
                          </div>
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Input nama" required>
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Input email" required>
                          </div>
                          <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Input alamat" required>
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password_guru" class="form-control" placeholder="Input password_guru" required>
                          </div>
                          <div class="form-group">
                            <label>Mapel</label>
                            <input type="text" name="kode_mapel" class="form-control" placeholder="Input kode_mapel" required>
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
    <a href="tambah-guru.php" class="btn btn-success" role="button">Tambah Data</a>
    <a href="dashboard-admin.php" class="btn btn-success" role="button">Kembali</a>
  </div>

<?php
  include 'templates/footer.php'
?>
