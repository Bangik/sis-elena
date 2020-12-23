<?php
  include 'templates/header-admin.php';
  if (isset($_POST['submit'])) {
    $query = mysqli_query($link, "UPDATE admin SET nama='$_POST[nama]', email='$_POST[email]', alamat='$_POST[alamat]' WHERE id='$_POST[niss]'");
    if ($query) {
      echo "<script>
              document.location='edit-profile-admin.php';
            </script>";
    }else {
      echo "<script>
              alert('Gagal Ubah Data');
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
              <form method="post">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="hidden" name="niss" value="<?php echo $rowUser['id']; ?>">
                  <input type="text" class="form-control" name="nama" placeholder="Input Nama" value="<?php echo $rowUser['nama']; ?>">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Input Email" value="<?php echo $rowUser['email']; ?>">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" class="form-control" name="alamat" placeholder="Input Alamat" value="<?php echo $rowUser['alamat']; ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                <a href="dasboard-siswa.php" class="btn btn-success">Batal</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- main end-->

<?php include 'templates/footer.php' ?>
