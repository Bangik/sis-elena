<?php
  include 'templates/header-admin.php';
  if (isset($_GET['id'])) {
    $kode_kelas = $_GET['id'];
    $idk = $_GET['idk'];
    if (isset($_POST['submit'])) {
      $nis=$_POST["nis"];
      $nama=$_POST["nama"];
      $email=$_POST["email"];
      $alamat=$_POST["alamat"];
      $password=$_POST["password"];

      $query = mysqli_query($link, "INSERT INTO siswa (nis, nama, email, alamat, password, kode_kelas) VALUES ('$nis', '$nama', '$email', '$alamat', '$password', '$kode_kelas')");
      if ($query) {
        echo "<script>document.location='admin-siswa-kelas.php?id=" . $kode_kelas . "&idk=".$idk."'</script>";
      }else {
        echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
      }
    }
?>
  <div class="container">
    <form action="" method="post">
      <div class="form-group">
        <label>NIS</label>
        <input type="text" name="nis" class="form-control" placeholder="Masukan NIS" required />
      </div>
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required/>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="Masukan Email" required/>
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" rows="5"placeholder="Masukan Alamat" required></input>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukan Password" required/>
      </div>
      <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
      <a href="javascript:window.history.go(-1);" name="submit" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
    </form>
  </div>
     <!-- main end-->
<?php
}else {
  echo "TIDAK ADA DATA";
}
  include 'templates/footer.php'
?>
