<?php include 'templates/header-guru.php';
  $id = $rowUser['nip'];
  $pw = $rowUser['password_guru'];
  $err ="";
  if(isset($_POST['submit'])) {
    if ($_POST["newPassword"] == $_POST["confirmPassword"]) {
      if($_POST["currentPassword"] == $pw) {
        if ($_POST["newPassword"] == $pw) {
          $err = "Password Tidak Boleh Sama dengan Password Saat Ini";
        }else {
          mysqli_query($link,"UPDATE guru SET password_guru='$_POST[newPassword]' WHERE nip='$id'");
          echo "<script>
                  document.location='dasboard-siswa.php';
                </script>";
        }
      } else{
        $err = "Password Lama Salah";
      }
    }else {
      $err = "Konfirmasi Password Tidak Sama";
    }
  }
?>
  <div class="container">
    <div class="row row-cols-1 row-cols-md-1">
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <?php echo $err; ?>
            <form class="form" action="" method="post">
              <div class="form-group">
                <label>Password Saat Ini</label>
                <input type="password" name="currentPassword" class="form-control pass-now" placeholder="Password saat ini" required>
              </div>
              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="newPassword" class="form-control pass-new" placeholder="Password Baru" required>
              </div>
              <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="confirmPassword" class="form-control pass-new-2" placeholder="Konfirmasi Password Baru" required>
              </div>
              <button type="submit" name="submit" class="btn btn-success">Simpan</button>
              <a href="dasboard-siswa.php" class="btn btn-success">Batal</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'templates/footer.php'?>
