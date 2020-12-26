<?php
  include 'templates/header-admin.php';
  if (isset($_GET['id'])) {
    $tampilMapel = mysqli_query($link, "SELECT kd_kelas,nama FROM kelas WHERE tingkatan='$_GET[id]' ORDER BY nama ASC");
?>

    <!-- main start-->
    <div class="container">

      <div class="row row-cols-1 row-cols-md-4 text-center">

        <?php
        $no = 1;
          while ($dataMapel = mysqli_fetch_array($tampilMapel)) :
        ?>
        <div class="col mb-4 cardss">
          <div class="card">
            <a href="admin-siswa-kelas.php?id=<?php echo $dataMapel['kd_kelas'];?>&idk=<?php echo $_GET['id']; ?>" class="text-color-a">
              <img src="./asset/img/img<?php echo $no++; ?>.svg" class="card-img-top mx-auto d-block" alt="..." style="width:100%; height:100%;">
              <div class="card-body">
                <h5 class="card-title"><?php echo $dataMapel['nama'] ?></h5>
              </div>
            </a>
          </div>
        </div>
        <?php
          if ($no == 11) {
              $no = 1;
          }
          endwhile;
        ?>
      </div>
    </div>
    <!-- main end-->
    <script type="text/javascript" src="./asset/js/animatejs.js"></script>
<?php
  }else {
    echo "TIDAK ADA DATA";
  }
?>

<?php include 'templates/footer.php' ?>
