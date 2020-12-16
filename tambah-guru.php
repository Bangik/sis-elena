<?php
  include 'templates/header-admin.php';
  if (isset($_POST['submit'])) {
    $nip=$_POST["nip"];
    $nama=$_POST["nama"];
    $email=$_POST["email"];
    $alamat=$_POST["alamat"];
    $password=$_POST["password_guru"];
    $mapel=$_POST["kode_mapel"];
    $hasil=mysqli_query($link, "INSERT into guru (nip,nama,email,alamat,password_guru,kode_mapel) values ('$nip','$nama','$email','$alamat','$password','$mapel')");
      if ($hasil) {
        echo "<script>document.location='admin-guru.php'</script>";
      }
      else {
        echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
      }
   }
?>
  <div class="container">
    <form action="" method="post">
      <div class="form-group">
        <label>Nip</label>
        <input type="text" name="nip" class="form-control" placeholder="Masukan Nip" required />
      </div>
      <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required/>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control" placeholder="Masukan Email" required/>
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <input name="alamat" class="form-control" rows="5"placeholder="Masukan Alamat" required></input>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="text" name="password_guru" class="form-control" placeholder="Masukan Password" required/>
      </div>
       <div class="form-group">
          <label>mapel</label>
          <input type="text" name="kode_mapel" class="form-control" placeholder="Masukan mapel" required/>
      </div>

      <button type="submit" name="submit" class="btn btn-success">Simpan</button>
      <a href="javascript:window.history.go(-1);" name="submit" class="btn btn-danger">Batal</a>
    </form>
  </div>
     <!-- main end-->
<?php
  include 'templates/footer.php'
?>
