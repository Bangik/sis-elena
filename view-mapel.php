<?php
  include 'templates/header.php';
  $id = $_GET['id'];
  $nis = $rowUser['nis'];

  $tampilMateriQuery = mysqli_query($link, "SELECT materi_mapel.id, materi_mapel.kode_mapel, materi_mapel.judul, materi_mapel.kode_aktivitas, materi_mapel.kode_aktivitas2, materi_mapel.kode_aktivitas3, materi_mapel.checkbox, presensi2.nama_presensi, tugas2.nama_tugas FROM materi_mapel LEFT JOIN presensi2 ON materi_mapel.kode_aktivitas=presensi2.kode_aktivitas LEFT JOIN tugas2 ON materi_mapel.kode_aktivitas2=tugas2.kode_aktivitas2 where materi_mapel.kode_mapel='$id'" );


?>
    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-1">
        <?php
          while ($tampilMateri = mysqli_fetch_array($tampilMateriQuery)) :
            $querychek = mysqli_query($link, "SELECT checkbox FROM presensi WHERE nis ='$nis' AND kode_aktivitas='$tampilMateri[kode_aktivitas]'");
            $hasil = mysqli_fetch_array($querychek);

            $querychek2 = mysqli_query($link, "SELECT checkbox FROM tugas WHERE nis ='$nis' AND kode_aktivitas_tugas='$tampilMateri[kode_aktivitas2]'");
            $hasil2 = mysqli_fetch_array($querychek2);
        ?>
        <div class="col mb-4">
          <div class="card">
            <div class="card-body">
              <a href="#" class="text-color-a"><h5 class="card-title"><?php echo $tampilMateri['judul']; ?></h5></a>
              <?php
                if ($tampilMateri['nama_presensi'] != "") {
                  echo "<div class='d-flex justify-content-between'>
                      <a href='view-presensi.php?id=" . $tampilMateri['kode_aktivitas'] . "' class='card-text text-color-a' ><p> ". $tampilMateri['nama_presensi'] ."</p></a>
                      <form action='completes.php' method='post' class='float-right' id='forms'>
                        <input type='hidden' name='idform' value=' ". $tampilMateri['kode_aktivitas'] ."'>
                        <input type='hidden' name='nis' value='".$nis."'>
                        <input type='hidden' name='statusform' value='".$hasil['checkbox']."'>
                        <input type='hidden' name='kode_mapel_form' value='".$tampilMateri['kode_mapel']."'>
                        <button type='submit' name='btnchek_presensi' class= 'btn btn-link'>
                          <img src='./asset/img/".$hasil['checkbox'].".svg'>
                        </button>
                      </form>
                    </div>";
                }
                if ($tampilMateri['nama_tugas'] != "") {
                  echo "<div class='d-flex justify-content-between'>
                    <a href='view-assign.php?id=".$tampilMateri['kode_aktivitas2']."' class='card-text text-color-a'><p>".$tampilMateri['nama_tugas']."</p></a>
                    <form action='completes.php' method='post' class='float-right'>
                      <input type='hidden' name='nis_tugas' value='".$nis."'>
                      <input type='hidden' name='idform2' value='".$tampilMateri['kode_aktivitas2']."'>
                      <input type='hidden' name='statusform2' value='".$hasil2['checkbox']."'>
                      <input type='hidden' name='kode_mapel_form2' value='".$tampilMateri['kode_mapel']."'>
                      <button type='submit' name='btnchek_tugas' class='btn btn-link'>
                        <img src='./asset/img/".$hasil2['checkbox'].".svg'>
                      </button>
                    </form>
                  </div>";
                }
              ?>


            </div>
          </div>
        </div>
      <?php
        endwhile;
      ?>
      </div>
    </div>
    <!-- main end-->

    <!-- <script>
      $(document).ready(function(){
        // jika terjadi event submit pada form
        $('#1').click(function(e) {
          // mencegah agar halaman tidak pindah halaman / refresh
          //e.preventDefault()
          // ambil data
          var data = $('.forms').serialize()
          // ambil method dari method di form
          var method = $('.forms').attr('method')
          // ke mana data akan dikirim
          // diambil dari action di form
          var action = $('.forms').attr('action')
          // memulai kirim ajax
          $.ajax({
            url: action,
            data: data,
            method: method,
            beforeSend: function() {
              // lakukan sesuatu sebelum data dikirim
              // misalkan memulai loading
            },
            success: function(data) {
              document.location='view-mapel.php?id=PA01';
            }
          })
        })
      })
    </script> -->

<?php
  include 'templates/footer.php'
?>
