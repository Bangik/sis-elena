<?php
  require_once "config/init.php";

  $error = '';

  if (isset($_COOKIE['hashenc']) and isset($_COOKIE['00keys'])) {
    $idUser = $_COOKIE['hashenc'];
    $idsha = $_COOKIE['00keys'];
    $query = mysqli_query($link, "SELECT nis FROM siswa WHERE id='$idsha'");
    $nis = mysqli_fetch_array($query);
    $query2 = mysqli_query($link, "SELECT nip FROM guru WHERE id='$idsha'");
    $nip = mysqli_fetch_array($query2);
    $query3 = mysqli_query($link, "SELECT username_admin FROM admin WHERE id='$idsha'");
    $nia = mysqli_fetch_array($query3);
    if ($idUser === hash('sha256', $nis['nis'])) {
      $_SESSION['user'] = $nis['nis'];
    }elseif ($idUser === hash('sha256', $nip['nip'])) {
      $_SESSION['user_guru'] = $nip['nip'];
    }elseif ($idUser === hash('sha256', $nia['username_admin'])) {
      $_SESSION['user_admin'] = $nia['username_admin'];
    }
  }

  //redirect kalau user sudah login
  if( isset($_SESSION['user'])){
    header('Location: dasboard-siswa.php');
  }elseif (isset($_SESSION['user_guru'])) {
    header('Location: dasboard-guru.php');
  }elseif (isset($_SESSION['user_admin'])) {
    header('Location: dashboard-admin.php');
  }

  if( isset($_POST['submit']) ){
    $nama = $_POST['username'];
    $pass = $_POST['password'];
    if (isset($_POST['remember'])) {
      $ceklist = "cek";
    }

    if(!empty(trim($nama)) && !empty(trim($pass)) ){

      if(cek_nama($nama) != 0 ){
        if(cek_data($nama, $pass)){
          redirect_login($nama, $ceklist);
        }else{
          $error = 'data ada yang salah';
        }
      }elseif (cek_nama_guru($nama) != 0) {
        if(cek_data_guru($nama, $pass)){
          redirect_login_guru($nama, $ceklist);
        }else {
          $error = 'data ada yang salah';
        }
      }elseif (cek_nama_admin($nama) != 0) {
        if(cek_data_admin($nama, $pass)){
          redirect_login_admin($nama, $ceklist);
        }else {
          $error = 'data ada yang salah';
        }
      }else{
        $error = 'namanya belum terdaftar di database';
      }
    }else $error = 'data tidak boleh kosong';
  }

  //meguji pesan session
  if(isset($_SESSION['msg'])){
    flash_delete($_SESSION['msg']);
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- my css -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./asset/css/style-login.css" rel="stylesheet">
    <title>SIS ELENA LOG IN</title>
  </head>
  <body class="">
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
      <div class="container">
        <a class="navbar-brand text-white text-a" href="index.html">SISTEM INFORMASI & E-LEARNING SMAN 1 AKABILURU</a>
        <a class="navbar-brand text-white text-b" href="index.html">SIS ELENA SMAN 1 AKABILURU</a>
      </div>
    </nav>
    <!-- navbar end -->
    <!-- main start -->
    <div class="text-center">
      <form class="form-signin" method="post" action="#">
        <? if($error != ''){ ?>
            <div id="error">
              <?= $error; ?>
        </div>
        <? } ?>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="username" id="inputUsername" class="form-control" name="username" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me" name="remember"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-success btn-block" name="submit" type="submit">Sign in</button>

      </form>
      <a  href="#" class="text-color-a">Lupa Username / Password ?</a>
    </div>
    <!-- main end -->

    <!-- footer start -->
    <div class="row footer">
      <div class="col text-center text-muted">
        <p>	&copy; 2020 SMAN 1 AKABILURU</p>
      </div>
    </div>
    <!-- footer end -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>
