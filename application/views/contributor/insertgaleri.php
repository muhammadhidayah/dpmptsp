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

         <h3 class="box-title">Tambah Foto</h3>
       </div>
       <?php $attribute = array('role' => 'form'); echo form_open_multipart(base_url('contributor/galeri/tambahgaleri/'.$this->uri->segment('4')), $attribute); ?>
             <div class="box-body">
               <div class="form-group col-md-6">
                 <label for="exampleInputEmail1">Judul Foto</label>
                 <input type="text" class="form-control" name="judul_galeri" placeholder="Judul Foto" value="<?php echo set_value('judul_galeri'); ?>" required="true">
               </div>
               <div class="form-group col-md-6">
                 <label for="gambarInformasi">Gambar Foto</label>
                 <input type="file" name="gambar" required="true">
               </div>
               <div class="form-group col-md-12">
                 <label for="isiInformasi">Deskripsi Foto</label>
                 <textarea class="form-control" name="deskripsi_foto" ><?php echo set_value('isi_informasi'); ?></textarea>
               </div>
             </div>
             <!-- /.box-body -->

             <div class="box-footer">
               <button type="submit" class="btn btn-primary" name="submit">Submit</button>
             </div>
           <?php echo form_close(); ?>
       <!-- /.box-body -->
       <div class="box-footer">
       </div>
       <!-- /.box-footer-->
     </div>
     <!-- /.box -->

   </section>
