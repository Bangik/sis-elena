<?php
  include 'templates/header-guru.php';
  if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];
  }
  $err = "";
  $kode_guru = $rowUser['nip'];
  if (isset($_POST['btnsimpan'])) {
    //ambil value kode mapel
    $query_kode_mapel = mysqli_query($link, "SELECT tb_mengajar.kode_guru, tb_mengajar.kode_mapel, tb_mengajar.kode_kelas FROM tb_mengajar LEFT JOIN kelas ON tb_mengajar.kode_kelas = kelas.kd_kelas WHERE tb_mengajar.kode_guru='$kode_guru' AND tb_mengajar.kode_kelas='$_POST[kelas]'");
    $hasil_query_kode_mapel = mysqli_fetch_array($query_kode_mapel);

    //isi variabel dengan data dari $_POST untuk presensi
    $judul = $_POST['judul'];
    $nama_presensi = $_POST['nama_presensi'];
    $kode_mapel = $hasil_query_kode_mapel['kode_mapel'];
    $tanggal_mulai_presensi = date("Y-m-d", strtotime($_POST['tanggal_mulai_presensi']));
    $jam_mulai_presensi =  date("H:i", strtotime($_POST['jam_mulai_presensi']));
    $tanggal_akhir_prsensi = date("Y-m-d", strtotime($_POST['tanggal_akhir_presensi']));
    $jam_akhir_prsensi = date("H:i", strtotime($_POST['jam_akhir_presensi']));
    $deskripsi_presensi = $_POST['deskripsi_presensi'];

    //isi variabel dengan data dari $_POST untuk tugas
    $nama_tugas = $_POST['nama_tugas'];
    $tanggal_mulai_tugas = date("Y-m-d", strtotime($_POST['tanggal_mulai_tugas']));
    $jam_mulai_tugas =  date("H:i", strtotime($_POST['jam_mulai_tugas']));
    $tanggal_akhir_tugas = date("Y-m-d", strtotime($_POST['tanggal_akhir_tugas']));
    $jam_akhir_tugas = date("H:i", strtotime($_POST['jam_akhir_tugas']));
    $deskripsi_tugas = $_POST['deskripsi_tugas'];
    $nama_file = $_FILES['file_tugas']['name'];
    $size = $_FILES['file_tugas']['size'];
    $tempp = $_FILES['file_tugas']['tmp_name'];


    //uploaded file
    if ($size <= 160000000) {
      move_uploaded_file($tempp, 'upload/'.$nama_file);
    }else {
      $err = "Gagal Upload, Ukuran File Terlalu Besar. Maks 20 MB";
    }

    if ($nama_presensi == "") {
      //insert ke tabel tugas2
      $query_simpan_tugas = mysqli_query($link, "INSERT INTO tugas2(nama_tugas, kode_mapel, tanggal_mulai, jam_mulai, tanggal_akhir, jam_akhir, deskripsi, nama_file, file) VALUES ('$nama_tugas', '$kode_mapel', '$tanggal_mulai_tugas', '$jam_mulai_tugas', '$tanggal_akhir_tugas', '$jam_akhir_tugas', '$deskripsi_tugas', '$nama_file', '$tempp')");

      $query_simpan_presensi = "";
    }elseif ($nama_tugas == "") {
      //insert ke tabel presensi2
      $query_simpan_presensi = mysqli_query($link, "INSERT INTO presensi2(nama_presensi, kode_mapel, tanggal_mulai, jam_mulai, tanggal_akhir, jam_akhir, deskripsi) VALUES ('$nama_presensi', '$kode_mapel', '$tanggal_mulai_presensi', '$jam_mulai_presensi', '$tanggal_akhir_prsensi', '$jam_akhir_prsensi', '$deskripsi_presensi')");

      $query_simpan_tugas = "";
    }else {
      $query_simpan_tugas = mysqli_query($link, "INSERT INTO tugas2(nama_tugas, kode_mapel, tanggal_mulai, jam_mulai, tanggal_akhir, jam_akhir, deskripsi, nama_file, file) VALUES ('$nama_tugas', '$kode_mapel', '$tanggal_mulai_tugas', '$jam_mulai_tugas', '$tanggal_akhir_tugas', '$jam_akhir_tugas', '$deskripsi_tugas', '$nama_file', '$tempp')");

      $query_simpan_presensi = mysqli_query($link, "INSERT INTO presensi2(nama_presensi, kode_mapel, tanggal_mulai, jam_mulai, tanggal_akhir, jam_akhir, deskripsi) VALUES ('$nama_presensi', '$kode_mapel', '$tanggal_mulai_presensi', '$jam_mulai_presensi', '$tanggal_akhir_prsensi', '$jam_akhir_prsensi', '$deskripsi_presensi')");
    }

    if ($query_simpan_presensi or $query_simpan_tugas) {
      //ambil kode aktivitas presensi yang udah di insert di presensi2
      $query_tampil_presensi = mysqli_query($link, "SELECT kode_aktivitas FROM presensi2 WHERE nama_presensi='$nama_presensi'AND kode_mapel='$kode_mapel'AND tanggal_mulai='$tanggal_mulai_presensi' AND jam_mulai='$jam_mulai_presensi' AND tanggal_akhir='$tanggal_akhir_prsensi' AND jam_akhir='$jam_akhir_prsensi' AND deskripsi='$deskripsi_presensi' ");
      $hasil_query_tampil_presensi = mysqli_fetch_array($query_tampil_presensi);
      if ($hasil_query_tampil_presensi === NULL) {
        $kode_aktivitas1 = NULL;
      }else {
        $kode_aktivitas1 = $hasil_query_tampil_presensi['kode_aktivitas'];
      }

      //ambil kode aktivitas tugas yang udah di insert di tugas2
      $query_tampil_tugas = mysqli_query($link, "SELECT kode_aktivitas2 FROM tugas2 WHERE nama_tugas='$nama_tugas'AND kode_mapel='$kode_mapel'AND tanggal_mulai='$tanggal_mulai_tugas' AND jam_mulai='$jam_mulai_tugas' AND tanggal_akhir='$tanggal_akhir_tugas' AND jam_akhir='$jam_akhir_tugas' AND deskripsi='$deskripsi_tugas' ");
      $hasil_query_tampil_tugas = mysqli_fetch_array($query_tampil_tugas);
      if ($hasil_query_tampil_tugas === NULL) {
        $kode_aktivitas2 = NULL;
      }else {
        $kode_aktivitas2 = $hasil_query_tampil_tugas['kode_aktivitas2'];
      }
      //ambil siswa sesuai kelasnya
      $query_ambil_siswa = mysqli_query($link, "SELECT nis FROM siswa WHERE kode_kelas='$_POST[kelas]'");

      if (is_null($kode_aktivitas1)) {
        //insert ke tabel materi mapel
        $query_insert_materi_mapel = mysqli_query($link, "INSERT INTO materi_mapel(kode_mapel, judul, kode_aktivitas, kode_aktivitas2, kode_aktivitas3, kode_kelas) VALUES ('$kode_mapel', '$judul', NULL, $kode_aktivitas2, NULL, '$_POST[kelas]') ");

        while ($nis = mysqli_fetch_array($query_ambil_siswa)) {
          $query_insert_siswa2 = mysqli_query($link, "INSERT INTO tugas (kode_aktivitas_tugas, kode_mapel, nis, checkbox) VALUES ('$kode_aktivitas2', '$kode_mapel', '$nis[nis]','completion-manual-n' )");
        }
      }elseif (is_null($kode_aktivitas2)) {
        $query_insert_materi_mapel = mysqli_query($link, "INSERT INTO materi_mapel(kode_mapel, judul, kode_aktivitas, kode_aktivitas2, kode_aktivitas3, kode_kelas) VALUES ('$kode_mapel', '$judul', '$kode_aktivitas1', NULL, NULL, '$_POST[kelas]') ");

        //insert siswa ke tabel presensi
        while ($nis = mysqli_fetch_array($query_ambil_siswa)) {
          $query_insert_siswa = mysqli_query($link, "INSERT INTO presensi (kode_aktivitas, kode_mapel, nis, checkbox) VALUES ('$kode_aktivitas1', '$kode_mapel', '$nis[nis]','completion-manual-n' )");
        }
      }else {
        //insert ke tabel materi mapel
        $query_insert_materi_mapel = mysqli_query($link, "INSERT INTO materi_mapel(kode_mapel, judul, kode_aktivitas, kode_aktivitas2, kode_aktivitas3, kode_kelas) VALUES ('$kode_mapel', '$judul', $kode_aktivitas1, $kode_aktivitas2, NULL, '$_POST[kelas]') ");
        //insert siswa ke tabel presensi
        while ($nis = mysqli_fetch_array($query_ambil_siswa)) {
          $query_insert_siswa = mysqli_query($link, "INSERT INTO presensi (kode_aktivitas, kode_mapel, nis, checkbox) VALUES ('$kode_aktivitas1', '$kode_mapel', '$nis[nis]','completion-manual-n' )");

          $query_insert_siswa2 = mysqli_query($link, "INSERT INTO tugas (kode_aktivitas_tugas, kode_mapel, nis, checkbox) VALUES ('$kode_aktivitas2', '$kode_mapel', '$nis[nis]','completion-manual-n' )");
        }
      }




      echo "<script>
              alert('Data BERHASIL disimpan " .$kode_aktivitas1.  "');
              document.location='view-kelas.php?id=" . $_POST['kelas'] ."';
            </script>";
    }else {
      echo "<script>
              alert('Data GAGAL disimpan');
              document.location='tambah-aktivitas.php';
            </script>";
    }
  }

?>
    <!-- main start-->
    <div class="container">
      <form method="POST" action="tambah-aktivitas.php" enctype="multipart/form-data">
        <div class="form-group">
          <label>Judul</label>
          <input type="text" name="judul" class="form-control" placeholder="Input Judul Aktivitas" required>
        </div>

        <div class="form-group">
          <input type="checkbox" class="btn-presensi">Presensi</input>
          <div class="form-presensi form-group" style="display:none;">
            <input type="text" name="nama_presensi" class="form-control" placeholder="Input Judul Presensi">
          </div>
          <div class="form-presensi form-group" style="display:none;">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai_presensi" class="form-control" placeholder="Tanggal">
          </div>
          <div class="form-presensi form-group" style="display:none;">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai_presensi" class="form-control" placeholder="Jam">
          </div>
          <div class="form-presensi form-group" style="display:none;">
            <label>Tanggal Berakhir</label>
            <input type="date" name="tanggal_akhir_presensi" class="form-control" placeholder="Tanggal">
          </div>
          <div class="form-presensi form-group" style="display:none;">
            <label>Jam Berakhir</label>
            <input type="time" name="jam_akhir_presensi" class="form-control" placeholder="Jam">
          </div>
          <div class="form-presensi form-group" style="display:none;">
            <label>Deskripsi</label>
            <textarea name="deskripsi_presensi" class="form-control" rows="3"></textarea>
          </div>
        </div>

        <div class="form-group">
          <input type="checkbox" class="btn-tugas">Tugas</input>
          <div class="form-tugas form-group" style="display:none;">
            <input type="text" name="nama_tugas" class="form-control" placeholder="Input Judul Tugas">
            <div class="form-tugas form-group" style="display:none;">
              <label>Tanggal Mulai</label>
              <input type="date" name="tanggal_mulai_tugas" class="form-control" placeholder="Tanggal">
            </div>
            <div class="form-tugas form-group" style="display:none;">
              <label>Jam Mulai</label>
              <input type="time" name="jam_mulai_tugas" class="form-control" placeholder="Jam">
            </div>
            <div class="form-tugas form-group" style="display:none;">
              <label>Tanggal Berakhir</label>
              <input type="date" name="tanggal_akhir_tugas" class="form-control" placeholder="Tanggal">
            </div>
            <div class="form-tugas form-group" style="display:none;">
              <label>Jam Berakhir</label>
              <input type="time" name="jam_akhir_tugas" class="form-control" placeholder="Jam">
            </div>
            <div class="form-tugas form-group" style="display:none;">
              <label>Deskripsi</label>
              <textarea name="deskripsi_tugas" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-tugas form-group" style="display:none;">
              <label>Upload File Maks 20 MB <?php echo $err; ?></label>
              <input type="file" name="file_tugas" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <input type="checkbox" class="btn-upload">Upload</input>
          <div class="form-upload form-group" style="display:none;">
            <label>Upload</label>
            <input type="text" name="kode_barang" class="form-control" placeholder="Input Judul">
          </div>
        </div>


        <div class="form-group">
          <input type="hidden" name="kelas" value="<?php echo $id_kelas; ?>">
        </div>
          <button type="submit" class="btn btn-success" name="btnsimpan">Simpan</button>
          <button type="reset" class="btn btn-danger" name="btnreset">Kosongkan</button>
      </form>
    </div>
    <!-- main end-->
    <script type="text/javascript">
    $(document).ready(function(){
      $(".btn-presensi").click(function(){
        if($(this).prop("checked") == true) {
          $(".form-presensi").show();
        }else if($(this).prop("checked") == false) {
          $(".form-presensi").hide();
        }
      });
      $(".btn-tugas").click(function(){
        if($(this).prop("checked") == true) {
          $(".form-tugas").show();
        }else if($(this).prop("checked") == false) {
          $(".form-tugas").hide();
        }
      });
      $(".btn-upload").click(function(){
        if($(this).prop("checked") == true) {
          $(".form-upload").show();
        }else if($(this).prop("checked") == false) {
          $(".form-upload").hide();
        }
      });
    });
    </script>
<?php
  include 'templates/footer.php'
?>
