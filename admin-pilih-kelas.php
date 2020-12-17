<?php
  include 'templates/header-admin.php';
  if (isset($_GET['id'])) {
    $tampilMapel = mysqli_query($link, "SELECT kd_kelas,nama FROM kelas WHERE tingkatan='$_GET[id]' ORDER BY nama ASC");
?>

    <!-- main start-->
    <div class="container">

      <div class="row row-cols-1 row-cols-md-4 text-center">

        <?php
          while ($dataMapel = mysqli_fetch_array($tampilMapel)) :
        ?>
        <div class="col mb-4">
          <div class="card">
            <a href="admin-siswa-kelas.php?id=<?php echo $dataMapel['kd_kelas'];?>&idk=<?php echo $_GET['id']; ?>" class="text-color-a">
              <img src="./asset/img/matematika-logo.jpg" class="card-img-top mx-auto d-block" alt="..." style="width:70%">
              <div class="card-body">
                <h5 class="card-title"><?php echo $dataMapel['nama'] ?></h5>
              </div>
            </a>
          </div>
        </div>
        <?php
          endwhile;
        ?>
      </div>
      <div class="mb-4 text-center">
        <a href="dashboard-admin.php" class="btn btn-success" role="button">Kembali</a>
      </div>
    </div>
    <!-- main end-->
<?php
  }else {
    echo "TIDAK ADA DATA";
  }
?>

<?php include 'templates/footer.php' ?>
