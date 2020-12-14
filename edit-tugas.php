<?php
  include 'templates/header.php';
  if (isset($_GET['id'])) {
    $kode_tugas = $_GET['id'];
    $id_siswa = $rowUser['nis'];
  }

  $tampil_tugas2 = mysqli_query($link, "SELECT * FROM tugas2 where kode_aktivitas2 = '$kode_tugas'");
  $tampilkan_tugas2 = mysqli_fetch_array($tampil_tugas2);

  $tgl = date('d', strtotime($tampilkan_tugas2['tanggal_akhir']));
  $bulan = date('m', strtotime($tampilkan_tugas2['tanggal_akhir']));
  $tahun = date('Y', strtotime($tampilkan_tugas2['tanggal_akhir']));
  $jam = date('H', strtotime($tampilkan_tugas2['jam_akhir']));
  $menit = date('i', strtotime($tampilkan_tugas2['jam_akhir']));
  $detik = date('s', strtotime($tampilkan_tugas2['jam_akhir']));
  $date_now = time();
  $deadline = mktime($jam,$menit,$detik,$bulan,$tgl,$tahun);
  $rentang = ($deadline-$date_now);
  $sisa_hari = floor($rentang / (60 * 60 * 24));
  $sisa_jam = floor(($rentang - ($sisa_hari*60*60*24)) / (60*60));
  if ($deadline < $date_now) {
    echo "<script>
            document.location='view-assign.php?id=" . $kode_tugas ."';
          </script>";
  }
?>
    <!-- main start-->
    <div class="container">
      <form action="upload.php" class="dropzone" id="dropzonewidget">
        <input type="hidden" class="kd_siswa" name="kode_siswa" value="<?php echo $id_siswa; ?>">
        <input type="hidden" class="kd_aktiv"name="kode_aktivitas" value="<?php echo $kode_tugas; ?>">
      </form>
      <div class="mt-5">
        <button class="btn btn-success btn-upload" name="simpan" type="submit">Simpan</button>
        <a href="javascript:window.history.go(-1);" class="btn btn-success">Batal</a>
      </div>
    </div>
    <!-- main end-->
    <script type='text/javascript'>
      Dropzone.autoDiscover = false;
      var kd_siswa = $('.kd_siswa').val();
      var kd_aktiv = $('.kd_aktiv').val();
      $(".dropzone").dropzone({
          maxFiles: 1,
          autoProcessQueue: false,
          init: function() {
            myDropzone = this;
            $.ajax({
              url: 'upload.php',
              type: 'post',
              data: {request: 2, kode_siswa:kd_siswa, kode_aktivitas:kd_aktiv},
              dataType: 'json',
              success: function(response){
                $.each(response, function(key,value) {
                  var mockFile = { name: value.name, size: value.size };

                  myDropzone.emit("addedfile", mockFile);
                  myDropzone.emit("thumbnail", mockFile, value.path);
                  myDropzone.emit("complete", mockFile);
                });
              }
            });
          },
          addRemoveLinks: true,
            removedfile: function(file) {
              var name = file.name;

             $.ajax({
               type: 'POST',
               url: 'upload.php',
               data: {name: name, request: 3, kode_siswa:kd_siswa, kode_aktivitas:kd_aktiv},
               sucess: function(data){
                  console.log('success: ' + data);
               }
             });
             var _ref;
              return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
           }
      });
      $('.btn-upload').click(function(){
        myDropzone.processQueue();
        var data = $('#dropzonewidget').serialize();

        $.ajax({
          type: 'POST',
          url: 'upload.php',
          data: data,
          success: function(data){
            document.location='view-assign.php?id=<?php echo $kode_tugas; ?>';
          }
        });
      });
    </script>
<?php
  include 'templates/footer.php'
?>
