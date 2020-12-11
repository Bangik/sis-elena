<?php
  include 'templates/header.php';
?>
    <!-- main start-->
    <div class="container">
      <form action="/file-upload" class="dropzone" id="my-awesome-dropzone"></form>
      <div class="mt-5">
        <button class="btn btn-success" name="simpan" type="submit">Simpan</button>
        <a href="javascript:window.history.go(-1);" class="btn btn-success">Batal</a>
      </div>
    </div>
    <!-- main end-->
<?php
  include 'templates/footer.php'
?>
