<?php
  include 'templates/header-guru.php';

  $query = mysqli_query($link, "SELECT * FROM informasi WHERE tujuan='Guru' ORDER BY id DESC LIMIT 1");
  $hasil = mysqli_fetch_array($query);

?>
    <!-- main start-->
    <div class="container">
      <div class="row row-cols-1 row-cols-md-1">
        <div class="col mb-4">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $hasil['judul_informasi']; ?></h5>
                <p class="card-text"><?php echo $hasil['deskripsi']; ?></p>
                <p></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- main end-->

<?php
  include 'templates/footer.php'
?>
