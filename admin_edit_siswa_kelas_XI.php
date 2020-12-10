<?php
  include 'templates/header-admin.php';
?>
     <!-- main start-->
     <div class="container" style="width:1000px">
       <div class="row">
         <div class="col-sm">
           <div class="card border-dark mb-3" style="width: 15rem;">
             <img src="./asset/img/user-profile.png" class="card-img-top mx-auto d-block" style="width:80%" alt="...">
             <div class="card-body">
               <div class="form-group" >
                 <label for="exampleFormControlFile1">Pilih Foto</label>
                 <input type="file" class="form-control-file" id="pilih_foto">
               </div>
             </div>
           </div>
         </div>
         <div class="col-sm">
           <form>
             <div class="form-group row">
               <label for="inputnama" class="col-sm-2 col-form-label">Nama</label>
               <div class="col-sm-10">
                 <input type="text" class="form-control" id="edit_adminnama_siswa_XI">
               </div>
             </div>
             <div class="form-group row">
               <label for="inputemail" class="col-sm-2 col-form-label">NIS</label>
               <div class="col-sm-10">
                 <input type="email" class="form-control" id="edit_adminnis_siswa_XI">
               </div>
             </div>
             <div class="form-group row">
               <label for="inputemail" class="col-sm-2 col-form-label">Password</label>
               <div class="col-sm-10">
                 <input type="email" class="form-control" id="edit_adminpasword_siswa_XI">
               </div>
             </div>
             <div class="form-group row">
               <label for="inputalamat" class="col-sm-2 col-form-label">Email</label>
               <div class="col-sm-10">
                 <input type="text" class="form-control" id="edit_adminemail_siswa_XI">
               </div>
             </div>
             <div class="form-group row">
               <label for="inputalamat" class="col-sm-2 col-form-label">Alamat</label>
               <div class="col-sm-10">
                 <input type="text" class="form-control" id="edit_adminalamat_siswa_XI">
               </div>
             </div>
             <div class="form-group row" >
               <label for="deskripsi" class="col-sm-2 col-form-label" >Deskripsi</label>
               <div class="col-sm-10">
                 <input type="text" style="height:100px" class="form-control" id="edit_admindeskripsi_siswa_XI">
               </div>
             </div>
           </form>
         </div>
       </div>
     </div>
     <div class="mx-auto" style="width: 200px;">
       <input class="btn btn-primary" type="submit" value="Edit Siswa">
        <a href="admin_siswa_kelas_XI.php" class="btn btn-primary" role="button">Batal</a>
     </div>
     <!-- main end-->
<?php
  include 'templates/footer.php'
?>