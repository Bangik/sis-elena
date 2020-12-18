<?php
  include 'templates/header.php';
  $kode_kelas = $rowUser['kode_kelas'];

  $query = mysqli_query($link, "SELECT * FROM jadwal WHERE kode_kelas='$kode_kelas' ORDER BY id_jadwal DESC LIMIT 1");
  $hasil = mysqli_fetch_array($query);
?>

<div class="container">
  <div class="row row-cols-1 row-cols-md-1 text-center">
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Jadwal Pelajaran Akan Ditampilkan Disini</h3>
          <img src="<?php echo $hasil['file']; ?>" alt="...">
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include 'templates/footer.php'
?>
