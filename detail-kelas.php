<?php
  include 'templates/header-admin.php';
  if (isset($_GET['id'])) {

    if (isset($_POST['simpan'])) {
      if ($_POST['nama_lama'] == "-") {
        $query_insert = mysqli_query($link, "INSERT INTO tb_mengajar(kode_guru, kode_mapel, kode_kelas) VALUES ('$_POST[kode_guru_baru]', '$_POST[kode_mapel]', '$_POST[kode_kelas]')");
        if ($query_insert) {
          echo "<script>
                  document.location='detail-kelas.php?id=".$_POST['kode_kelas']."';
                </script>";
        }
      }else {
        $query_update = mysqli_query($link, "UPDATE tb_mengajar SET kode_guru='$_POST[kode_guru_baru]' WHERE kode_mapel='$_POST[kode_mapel]' AND kode_kelas='$_POST[kode_kelas]'");
        if ($query_update) {
          echo "<script>
                  document.location='detail-kelas.php?id=".$_POST['kode_kelas']."';
                </script>";
        }
      }
    }

    if (isset($_POST['btn-tambah'])) {
      $query_insert2 = mysqli_query($link, "INSERT INTO mapel(kode_mapel, nama_mapel, kode_kelas) VALUES ('$_POST[kd_mapel]', '$_POST[nm_mapel]', '$_POST[kd_kelas]')");
      if ($query_insert2) {
        echo "<script>
                document.location='detail-kelas.php?id=".$_POST['kd_kelas']."';
              </script>";
      }
    }

    $query = mysqli_query($link, "SELECT COUNT(nis) AS jumlah FROM siswa WHERE kode_kelas = '$_GET[id]'");
    $hasil = mysqli_fetch_array($query);
    $query1 = mysqli_query($link, "SELECT COUNT(kode_mapel) AS jumlah FROM mapel WHERE kode_kelas = '$_GET[id]'");
    $hasil1 = mysqli_fetch_array($query1);

    $query2 = mysqli_query($link, "SELECT mapel.kode_mapel, mapel.nama_mapel, tb_mengajar.kode_guru, guru.nama FROM mapel LEFT JOIN tb_mengajar ON tb_mengajar.kode_mapel = mapel.kode_mapel LEFT JOIN guru ON guru.nip = tb_mengajar.kode_guru WHERE mapel.kode_kelas = '$_GET[id]' ORDER BY mapel.kode_mapel ASC");
  }
?>

    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-1">
        <div class="col mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title">
                <h5>Jumlah Siswa : <?php echo $hasil['jumlah']; ?></h5>
                <h5>Jumlah Mapel : <?php echo $hasil1['jumlah']; ?></h5>
              </div>
              <table class="table table-hover text-center">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Mapel</th>
                  <th>Nama</th>
                  <th>Guru Pengampu</th>
                  <th colspan="2">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no=1;
                  while ($data = mysqli_fetch_array($query2)) {

                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $data["kode_mapel"]; ?></td>
                    <td><?php echo $data["nama_mapel"];   ?></td>
                    <td><?php
                      if ($data["nama"] === null) {
                        echo "-";
                      }else {
                        echo $data["nama"];
                      }

                    ?></td>
                    <td>
                      <a href="#" type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?php echo $data['kode_mapel']; ?>">Ubah</a>
                    </td>
                  </tr>
                  <!-- The Modal -->
                  <div class="modal fade" id="myModal<?php echo $data['kode_mapel']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Ubah Pengampu</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                          <form action="" method="post">
                            <div class="form-group">
                              <label>Pilih Guru</label>
                              <input type="hidden" name="kode_mapel" value="<?php echo $data['kode_mapel']; ?>">
                              <input type="hidden" name="kode_kelas" value="<?php echo $_GET['id']; ?>">
                              <input type="hidden" name="nama_lama" value="<?php
                              if ($data["nama"] === null) {
                                echo "-";
                              }else {
                                echo $data["nama"];
                              }; ?>">
                              <select class="form-control" name="kode_guru_baru">
                                <?php
                                  $tampilFilter = mysqli_query($link, "SELECT nip, nama FROM guru");
                                  while ($dataFilter = mysqli_fetch_array($tampilFilter)) {
                                    echo "<option value=\"{$dataFilter['nip']}\">";
                                    echo $dataFilter['nama'];
                                    echo "</option>";
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
      <div class="mb-4">
        <a href="#" class="btn mr-4 btn-success" role="button" data-toggle="modal" data-target="#myModal">Tambah Mapel</a>
        <a href="daftar-kelas.php" class="btn btn-success" role="button">Kembali</a>
      </div>
    </div>
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Tambah Mapel</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <form action="" method="post">
              <div class="form-group">
                <label>Kode Mapel</label>
                <input type="text" name="kd_mapel" class="form-control" placeholder="Input Kode Mapel">
              </div>
              <div class="form-group">
                <label>Nama Mapel</label>
                <input type="hidden" name="kd_kelas" class="form-control" value="<?php echo $_GET['id']; ?>">
                <input type="text" name="nm_mapel" class="form-control" placeholder="Input Nama Mapel">
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

<?php include 'templates/footer.php' ?>
