<?php
  include 'templates/header.php';
?>
  <div class="container" >
   <div class='content'>
    <form action="upload.php" class="dropzone" id="dropzonewidget">
      <input type="hidden" name="kode_siswa" value="1222">
      <input type="hidden" name="kode_aktivitas" value="8">
    </form>

    <input type="button" id='uploadfiles' value='Simpan' >
   </div>
   <div class="col text-center">
     <p class="btn btn-success" style="width: 10rem;" >Tambahkan Tugas</p>
   </div>
  </div>

  <script type='text/javascript'>
    Dropzone.autoDiscover = false;
    $(".dropzone").dropzone({
        maxFiles: 1,
        autoProcessQueue: false,
        init: function() {
            myDropzone = this;
            $.ajax({
                url: 'upload.php',
                type: 'post',
                data: {request: 2},
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
             data: {name: name,request: 3},
             sucess: function(data){
                console.log('success: ' + data);
             }
           });
           var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
         }
    });
    $('#uploadfiles').click(function(){
      myDropzone.processQueue();
      var data = $('#dropzonewidget').serialize()

      $.ajax({
        type: 'POST',
        url: 'upload.php',
        data: data
      });
    });

  </script>

<?php
  include 'templates/footer.php'
?>
