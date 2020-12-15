<?php
require_once "config/init.php";

if(isset($_GET['id']) && isset($_GET['idm']) && isset($_GET['idg']))  {
  $kode_aktivitas = $_GET['id'];
  $idm = $_GET['idm'];
  $idg = $_GET['idg'];
  $post = $_POST;
  $file_folder = "upload/"; // folder untuk load file
  $no = 1;

  $kodeMapelGuruQuery = mysqli_query($link, "SELECT * FROM tb_mengajar where kode_guru='$idg' and kode_kelas='$idm'");
  $kodeMapelGuru = mysqli_fetch_array($kodeMapelGuruQuery);
  $kodeMapelGuru2 = $kodeMapelGuru['kode_mapel'];

  $tampil_tugas_query = mysqli_query($link, "SELECT tugas.jam, tugas.tanggal, tugas.status, tugas.file, tugas.nilai, mapel.nama_mapel, siswa.nis, siswa.nama FROM tugas LEFT JOIN mapel ON tugas.kode_mapel = mapel.kode_mapel LEFT JOIN siswa ON tugas.nis=siswa.nis WHERE tugas.kode_mapel='$kodeMapelGuru2' AND tugas.kode_aktivitas_tugas='$kode_aktivitas' ORDER BY siswa.nis  ASC ");

  $query_tugas2 = mysqli_query($link, "SELECT nama_tugas FROM tugas2 WHERE kode_aktivitas2='$kode_aktivitas'");
  $nama_tugas = mysqli_fetch_array($query_tugas2);

  if(extension_loaded('zip')) {   //memeriksa ekstensi zip
    $zip = new ZipArchive(); // Load zip library
    $nama = $nama_tugas['nama_tugas'].time().".zip";  // nama Zip
    if($zip->open($nama, ZIPARCHIVE::CREATE)===TRUE) {
      while ($tampil_tugas = mysqli_fetch_array($tampil_tugas_query)){
         $zip->addFile($file_folder.$tampil_tugas['file'], $file_folder.$no++.". ".$tampil_tugas['file']);
      }
      $zip->close();
    }
    if(file_exists($nama))  {  // Unduh Zip
      header('Content-type: application/zip');
      header('Content-Disposition: attachment; filename="'.$nama.'"');
      readfile($nama);
      unlink($nama);
    }
  } else {
    $error .= "* Zip ekstensi tidak ada";
  }
}

?>
