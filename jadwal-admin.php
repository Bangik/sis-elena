<?php
  include 'templates/header-admin.php';
  $err = "";
  if (isset($_POST['btn-siswa']) || isset($_POST['btn-guru'])) {

  $target_dir = "jadwal/";
  $target_file = $target_dir . basename($_FILES["files"]["name"]);
  $tempp = $_FILES['files']['tmp_name'];
  $size = $_FILES['files']['size'];
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if ($size <= 40000000) {
      if ($imageFileType == "png") {
        if (file_exists($target_file)) {
          $target_file = "jadwal/".time().basename($_FILES["files"]["name"]);
        }
        if (isset($_POST['btn-siswa'])) {
          move_uploaded_file($tempp, $target_file);
          $query = mysqli_query($link, "INSERT INTO jadwal(kode_kelas, temp_file, file) VALUES ('$_POST[kode_kelas]', '$tempp', '$target_file')");
        }elseif (isset($_POST['btn-guru'])) {
          move_uploaded_file($tempp, $target_file);
          $query = mysqli_query($link, "INSERT INTO jadwal_guru(temp_file, file) VALUES ('$tempp', '$target_file')");
        }
      }else {
        $err = "Gagal Upload, File Harus Format PNG";
      }

    }else {
      $err = "Gagal Upload, Ukuran File Terlalu Besar. Maks 5 MB";
    }
  }
?>

<div class="container">
  <div class="row row-cols-1 row-cols-md-1 ">
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title text-center">Upload Jadwal Siswa dan Guru dengan format .PNG</h3>
          <h5 class="card-title">Upload untuk Siswa</h5>
          <?php echo $err; ?>
          <form class="form" action="" method="post" enctype="multipart/form-data">
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
              <input type="file" name="files">
              <button type="submit" name="btn-siswa" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
          </form>
          <h5 class="card-title mt-4">Upload untuk Guru</h5>
          <form class="form " action="" method="post" enctype="multipart/form-data">
            <input type="file" name="files">
            <button type="submit" name="btn-guru" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

<?php
  include 'templates/footer.php'
?>
