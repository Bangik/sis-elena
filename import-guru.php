<?php
  include 'templates/header-admin.php';

  if (isset($_POST['button'])) {
    require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
    require('spreadsheet-reader-master/SpreadsheetReader.php');

    $target_file = "upload/".basename($_FILES['files']['name']);
    if (file_exists($target_file)) {
      $target_file = "upload/".time().basename($_FILES["files"]["name"]);
    }
    move_uploaded_file($_FILES['files']['tmp_name'],$target_file);
    $Reader = new SpreadsheetReader($target_file);
    foreach ($Reader as $Key => $Row){
     if ($Key < 1) continue;
     $query=mysqli_query($link, "INSERT INTO guru(nip, nama, email, alamat, password_guru, kode_mapel) VALUES ('$Row[0]',  '$Row[1]', '$Row[2]', '$Row[3]', '$Row[4]', '$Row[5]')");
    }
    if ($query) {
      echo "<script>
              document.location='admin-guru.php';
            </script>";
     }else{
      echo mysqli_error($link);
     }
 }

?>

<div class="container">
  <div class="row row-cols-1 row-cols-md-1">
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Langkah 1</h5>
          <p class="card-text">Gunakan file template excel yang kami sediakan.</p>
          <a href="download.php?file=TEMPLATES-GURU.xls" class="btn btn-success mb-3">Download</a>
          <h5 class="card-title">Langkah 2</h5>
          <ul>
            <li>Gunakan file tersebut sebagai template untuk daftar produk yang akan di upload.</li>
            <li>Pastikan setelah diisi sesuai format, klik "save" untuk menyimpan perubahan.</li>
            <li>Pastikan file excel format .xls</li>
            <li>Perhatikan hal-hal berikut dalam mengisi template excel:</li>
            <ul>
              <li>Nama kolom dibaris pertama tidak boleh diganti.</li>
              <li>Kode mapel di isi sesuai dengan kode mapel yang di ampu guru mapel</li>
            </ul>
          </ul>
          <h5 class="card-title">Langkah 3</h5>
          <p class="card-text">Pilih template excel yang sudah diisi dan disimpan dengan mengklik tombol dibawah ini.</p>
          <form class="form" action="" method="post" enctype="multipart/form-data">
              <input type="file" name="files">
              <button type="submit" name="button" class="btn btn-success">Upload</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include 'templates/footer.php'
?>
