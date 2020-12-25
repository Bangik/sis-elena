<?php

function cek_nama($nama){
    global $link;
    $nama = escape($nama);

    $query = "SELECT * FROM siswa WHERE nis = '$nama'";

    if( $result = mysqli_query($link, $query) ) return mysqli_num_rows($result);
}

function cek_nama_guru($nama){
    global $link;
    $nama = escape($nama);

    $query = "SELECT * FROM guru WHERE nip = '$nama'";

    if( $result = mysqli_query($link, $query) ) return mysqli_num_rows($result);
}
function cek_nama_admin($nama){
    global $link;
    $nama = escape($nama);

    $query = "SELECT * FROM admin WHERE username_admin = '$nama'";

    if( $result = mysqli_query($link, $query) ) return mysqli_num_rows($result);
}
//untuk login
function cek_data($nama, $pass){
  global $link;

    //mencegah sql injection
    $nama = escape($nama);
    $pass = escape($pass);

    $query  = "SELECT password FROM siswa WHERE nis = '$nama'";
    $result = mysqli_query($link, $query);
    $hash   = mysqli_fetch_assoc($result);

  if( $pass ==  $hash['password']) return true;
  else return false;
}

function cek_data_guru($nama, $pass){
  global $link;

    //mencegah sql injection
    $nama = escape($nama);
    $pass = escape($pass);

    $query  = "SELECT password_guru FROM guru WHERE nip = '$nama'";
    $result = mysqli_query($link, $query);
    $hash   = mysqli_fetch_assoc($result);

  if( $pass ==  $hash['password_guru']) return true;
  else return false;
}

function cek_data_admin($nama, $pass){
  global $link;

    //mencegah sql injection
    $nama = escape($nama);
    $pass = escape($pass);

    $query  = "SELECT password_admin FROM admin WHERE username_admin = '$nama'";
    $result = mysqli_query($link, $query);
    $hash   = mysqli_fetch_assoc($result);

  if( $pass ==  $hash['password_admin']) return true;
  else return false;
}

//mencegah injection
function escape($data){
  global $link;
  return mysqli_real_escape_string($link, $data);
}

function redirect_login($nama, $ceklist){
  global $link;
  $query = mysqli_query($link, "SELECT id FROM siswa WHERE nis='$nama'");
  $id = mysqli_fetch_array($query);
  $_SESSION['user'] = $nama;
  if ($ceklist == "cek") {
    setcookie('hashenc', hash('sha256', $nama), time() + 604800);
    setcookie('00keys', $id['id'], time() + 604800);
  }
  header('Location: dasboard-siswa.php');
}
function redirect_login_guru($nama, $ceklist){
  global $link;
  $query = mysqli_query($link, "SELECT id FROM guru WHERE nip='$nama'");
  $id = mysqli_fetch_array($query);
  $_SESSION['user_guru'] = $nama;
  if ($ceklist == "cek") {
    setcookie('hashenc', hash('sha256', $nama), time() + 604800);
    setcookie('00keys', $id['id'], time() + 604800);
  }
  header('Location: dasboard-guru.php');
}

function redirect_login_admin($nama, $ceklist){
  global $link;
  $query = mysqli_query($link, "SELECT id FROM admin WHERE username_admin='$nama'");
  $id = mysqli_fetch_array($query);
  $_SESSION['user_admin'] = $nama;
  if ($ceklist == "cek") {
    setcookie('hashenc', hash('sha256', $nama), time() + 604800);
    setcookie('00keys', $id['id'], time() + 604800);
  }
  header('Location: dashboard-admin.php');
}

function flash_delete($name){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>
