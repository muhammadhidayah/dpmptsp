<section class="content">
     <script src="<?php echo base_url('assets/tinymce/js/tinymce/tinymce.min.js')?>"></script>
     <script>
       tinymce.init({
         selector: 'textarea',
         height: 500,
         menubar: false,
         plugins: [
           'advlist autolink lists link image charmap print preview anchor',
           'searchreplace visualblocks code fullscreen',
           'insertdatetime media table contextmenu paste code'
         ],
         toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
         content_css: '//www.tinymce.com/css/codepen.min.css'
       });
     </script>
     <!-- Default box -->
     <div class="box">
       <div class="box-header with-border">
         <?php
           echo validation_errors('<div class="alert alert-warning alert-dismissible">','</div>');
           if(isset($errors)) {
             echo '<div class="alert alert-warning alert-dismissible">';
             echo $errors;
             echo '</div>';
           }
         ?>

         <h3 class="box-title">Tambah Berita</h3>
       </div>
       <?php
       foreach ($informasi as $informasi) {
       $attribute = array('role' => 'form'); echo form_open_multipart(base_url('contributor/informasi/updateinformasi/'.$informasi->id_informasi), $attribute); ?>
             <div class="box-body">
               <div class="form-group col-md-6">
                 <label for="exampleInputEmail1">Judul Informasi</label>
                 <input type="text" class="form-control" name="judul_informasi" placeholder="Judul Informasi" value="<?php echo $informasi->judul_informasi; ?>" required="true">
               </div>
               <div class="form-group col-md-6">
                 <label for="gambarBerita">Gambar Berita</label>
                 <input type="file" name="gambar">
               </div>
               <div class="form-group col-md-8">
                 <label for="Deskripsi">Deskripsi Berita</label>
                 <input type="text" name="deskripsi_informasi" value="<?php echo $informasi->deskripsi_informasi; ?>" class="form-control" required="true">
               </div>
               <div class="form-group col-md-4">
                 <label>Jenis Informasi</label>
                 <select class="form-control" name="jenis_informasi">
                   <option value="berita">Berita</option>
                   <option value="artikel" <?php if($informasi->jenis_informasi == "artikel") echo "selected"?>>Artikel</option>
                 </select>
               </div>
               <div class="form-group col-md-12">
                 <label for="isiBerita">Isi Berita</label>
                 <textarea class="form-control" name="isi_informasi"><?php echo $informasi->isi_informasi; ?></textarea>
               </div>
             </div>
             <!-- /.box-body -->

             <div class="box-footer">
               <button type="submit" class="btn btn-primary" name="submit">Submit</button>
             </div>
           <?php } echo form_close(); ?>
       <!-- /.box-body -->
       <div class="box-footer">
       </div>
       <!-- /.box-footer-->
     </div>
     <!-- /.box -->

   </section>
