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
    $querynya = mysqli_query($link, "UPDATE guru SET nip='$nip', nama='$nama', email='$email', alamat='$alamat', password_guru='$password', kode_mapel='$mapel' WHERE nip='$nip' ORDER BY nip ASC");
  }
?>
  <div class="container">
    <div class="row row-cols-1 row-cols-md-1">
      <div class="col mb-4">
        <div class="text-center h2" style="display:none;">
          <h2>Daftar Guru</h2>
        </div>
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
                <th>Mapel</th>
                <th class="btn-print2">Aksi</th>
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
                  <td class="btn-print2">
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
                            <input type="text" name="nip" class="form-control" placeholder="Input nip" value="<?php echo $data['nip']; ?>">
                          </div>
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Input nama" value="<?php echo $data['nama']; ?>">
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Input email" value="<?php echo $data['email']; ?>">
                          </div>
                          <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Input alamat" value="<?php echo $data['alamat']; ?>">
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password_guru" class="form-control" placeholder="Input password_guru" value="<?php echo $data['password_guru']; ?>">
                          </div>
                          <div class="form-group">
                            <label for="inputState">Mapel</label>
                            <select id="inputState" class="form-control" name="kode_mapel">
                            <?php
                              $query_mapel = mysqli_query($link, "SELECT DISTINCT kode_mapel, nama_mapel FROM mapel GROUP BY nama_mapel");
                              while ($row = mysqli_fetch_array($query_mapel)) {
                            ?>
                            <option value="<?php echo $row['kode_mapel']; ?>"><?php echo $row['nama_mapel']; ?></option>
                            <?php
                              }
                            ?>

                            </select>
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
    <a href="tambah-guru.php" class="btn mr-4 btn-success btn-print2" role="button">Tambah Data</a>
    <a href="export-guru.php" class="btn mr-4 btn-success btn-print2">Export Excel</a>
    <a href="#" type="button" class="btn btn-success mr-4 btn-print btn-print2">Print</a>
    <a href="dashboard-admin.php" class="btn mr-4 btn-success btn-print2" role="button">Kembali</a>
  </div>
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
