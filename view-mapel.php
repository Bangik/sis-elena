<?php
  include 'templates/header.php';
  $id = $_GET['id'];
  $tampilMateriQuery = mysqli_query($link, "SELECT * FROM materi_mapel where kode_mapel='$id'");

?>
    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-1">
        <?php
          while ($tampilMateri = mysqli_fetch_array($tampilMateriQuery)) :
        ?>
        <div class="col mb-4">
          <div class="card">
              <div class="card-body">
                <a href="view-assign.php" class="text-color-a"><h5 class="card-title"><?php echo $tampilMateri['judul']; ?></h5></a>
                <p class="card-text">Presensi, 2 Januari 2020</p>
                <p class="card-text">Materi Pengantar Aljabar</p>
              </div>
          </div>
        </div>
      <?php endwhile; ?>
      </div>
    </div>
    <!-- main end-->

<?php
  include 'templates/footer.php'
?>
