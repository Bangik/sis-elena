<?php
// Upload directory
require_once "config/init.php";

$target_dir = "upload/";
$date_now = date("Y-m-d");
$time_now = date("H:i:s");
$request = 1;

if(isset($_POST['request'])){
	$request = $_POST['request'];
}

if (isset($_POST['kode_siswa']) && isset($_POST['kode_aktivitas'])) {
	$kode_siswa = $_POST['kode_siswa'];
	$kode_aktivitas = $_POST['kode_aktivitas'];

	// Upload file
	if($request == 1){
		$target_file = $target_dir . basename($_FILES["file"]["name"]);
		$nama = $_FILES["file"]["tmp_name"];
		$lokasi = $_FILES['file']['name'];
		$query = mysqli_query($link, "UPDATE tugas SET jam='$time_now', tanggal='$date_now', nama_file='$nama', file='$lokasi', status='Selesai' WHERE nis = '$kode_siswa' AND kode_aktivitas_tugas = '$kode_aktivitas'");
		$msg = "";
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {

		  $msg = "Successfully uploaded";
		}else{
		    $msg = "Error while uploading";
		}
		echo $msg;
		exit;
	}

}

// Read files from
if($request == 2 && isset($_POST['kode_siswa']) && isset($_POST['kode_aktivitas'])){
	$kode_siswa2 = $_POST['kode_siswa'];
	$kode_aktivitas2 = $_POST['kode_aktivitas'];
	$file_list = array();

	$query = mysqli_query($link, "SELECT file FROM tugas WHERE nis = '$kode_siswa2' AND kode_aktivitas_tugas = '$kode_aktivitas2'");
	$hasil = mysqli_fetch_array($query);
	// Target directory
	$dir = $target_dir;
	if (is_dir($dir)){

			if ($dh = opendir($dir)){
					// Read files
					while (($file = readdir($dh)) !== false){

							if($file != '' && $file != '.' && $file != '..' && $file == $hasil['file']){
									// File path
									$file_path = $target_dir.$file;

									// Check its not folder
									if(!is_dir($file_path)){

											$size = filesize($file_path);

											$file_list[] = array('name'=>$file,'size'=>$size,'path'=>$file_path);

									}
							}

					}
					closedir($dh);
			}
	}

	echo json_encode($file_list);
	exit;
}





// Remove file
if($request == 3 && isset($_POST['kode_siswa']) && isset($_POST['kode_aktivitas'])){
  $filename = $target_dir.$_POST['name'];
  unlink($filename);
	$query = mysqli_query($link, "UPDATE tugas SET jam='$time_now', tanggal='$date_now', nama_file=NULL, file=NULL, status='Belum Selesai' WHERE nis = '$kode_siswa' AND kode_aktivitas_tugas = '$kode_aktivitas'");
  exit;
}
