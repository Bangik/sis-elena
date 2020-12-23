<?php
include 'templates/header-admin.php';
  $kode_kelas = $_GET['id'];
  $idk = $_GET['idk'];

  $query_kelas = mysqli_query($link, "SELECT nama FROM kelas WHERE kd_kelas='$kode_kelas'");
  $kelas = mysqli_fetch_array($query_kelas);

if (isset($_POST['simpan'])) {
  $nis = $_POST['nis'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $alamat = $_POST['alamat'];
  $password = $_POST['password'];
  $kode_kelas2 = $_POST['kode_kelas'];
  //$kode_aktivitas2 = $_POST['aktivitas'];
  $querynya = mysqli_query($link, "UPDATE siswa SET nis='$nis', nama='$nama', email='$email', alamat='$alamat', password='$password', kode_kelas='$kode_kelas2' WHERE nis='$nis'");
}
?>
<div class="container">
  <div class="row row-cols-1 row-cols-md-1">
    <div class="col mb-4">
      <div class="text-center h2" style="display:none;">
        <h2>DAFTAR SISWA KELAS <?php echo " ".$kelas['nama']; ?></h2>
      </div>
      <div class="card">
        <div class="card-body table-responsive-lg">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Password</th>
                <th>Alamat</th>
                <th>Email</th>
                <th colspan="2" class="btn-print2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql="select * from siswa where kode_kelas = '$kode_kelas'";
              $hasil=mysqli_query($link,$sql);
              $no=1;
              while ($data = mysqli_fetch_array($hasil)) {
              ?>
              <tr>
                <td><?php echo $no++;?></td>
                <td><?php echo $data["nis"]; ?></td>
                <td><?php echo $data["nama"];   ?></td>
                <td><?php echo $data["password"];   ?></td>
                <td><?php echo $data["alamat"];   ?></td>
                <td><?php echo $data["email"];   ?></td>
                <td class="btn-print2">
                  <a href="#" type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal<?php echo $data['nis'];?>">Edit</a>
                </td>
                <td class="btn-print2"><a href="delete-siswa.php?id=<?php echo $data['nis']; ?>&idm=<?php echo $kode_kelas; ?>&idk=<?php echo $idk; ?>" class="btn btn-danger" role="button" onclick="return confirm('apakah anda ingin menghapus data ini?')">Hapus</a></td>
              </tr>
              <!-- The Modal -->
                <div class="container">
                  <div class="modal fade" id="myModal<?php echo $data['nis']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Ubah Data Siswa</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="container">
                        <div class="modal-body">
                          <form action="" method="post">
                            <div class="form-group">
                              <label>Nis</label>
                              <input type="text" name="nis" class="form-control" placeholder="Input nis" value="<?php  echo $data['nis'] ?>">
                            </div>
                            <div class="form-group">
                              <label>Nama</label>
                              <input type="text" name="nama" class="form-control" placeholder="Input nama" value="<?php  echo $data['nama'] ?>">
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control" placeholder="Input email" value="<?php  echo $data['email'] ?>">
                            </div>
                            <div class="form-group">
                              <label>Alamat</label>
                              <input type="text" name="alamat" class="form-control" placeholder="Input alamat" value="<?php  echo $data['alamat'] ?>">
                            </div>
                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" name="password" class="form-control" placeholder="Input password" value="<?php  echo $data['password'] ?>">
                            </div>
                            <div class="form-group">
                              <label for="inputState">Kelas</label>
                              <select id="inputState" class="form-control" name="kode_kelas">
                              <?php
                                $query_mapel = mysqli_query($link, "SELECT DISTINCT kd_kelas, nama FROM kelas GROUP BY nama");
                                while ($row = mysqli_fetch_array($query_mapel)) {
                              ?>
                              <option value="<?php echo $row['kd_kelas']; ?>"><?php echo $row['nama']; ?></option>
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
                  </div>
                </div>
              </tbody>
              <?php
              }
              ?>
          </table>
        </div>
      </div>
    </div>
  </div>
  <a href="tambah-siswa.php?id=<?php echo $kode_kelas; ?>&idk=<?php echo $idk; ?>" class="btn btn-success mr-4 mt-4 btn-print2" role="button">Tambah Data</a>
  <a href="import-siswa.php?id=<?php echo $kode_kelas; ?>&idk=<?php echo $idk; ?>" class="btn mr-4 mt-4 btn-success btn-print2" role="button">Import Data</a>
  <a href="export-siswa.php?id=<?php echo $kode_kelas; ?>&idk=<?php echo $idk; ?>" class="btn mr-4 mt-4 btn-success btn-print2">Export Excel</a>
  <a href="#" type="button" class="btn btn-success mr-4 mt-4 btn-print btn-print2">Print</a>
  <a href="admin-pilih-kelas.php?id=<?php echo $idk; ?>" class="btn btn-success mr-4 mt-4 btn-print2" role="button">Kembali</a>
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
 include 'templates/footer.php' ?>
