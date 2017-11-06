<section class="content">
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

         <h3 class="box-title">Pemohon Izin</h3>
       </div>
       <?php $attribute = array('role' => 'form'); echo form_open_multipart(base_url('operator/pemohon_izin/insertpemohonizin'), $attribute); ?>
             <div class="box-body">
               <div class="form-group col-md-6">
                 <label>NIK (No. KTP) Pemohon Izin</label>
                 <input type="text" class="form-control "name="nik_pemohon_izin" placeholder="Nomor Induk Kependudukan" value="<?php echo set_value('nik_pemohon_izin')?>" required="true">
               </div>
               <div class="form-group col-md-6">
                 <label>Nama</label>
                 <input type="text" class="form-control" name="nama_pemohon_izin" placeholder="Nama Pemohon Izin" value="<?php echo set_value('nama_pemohon_izin'); ?>" required="true">
               </div>
               <div class="form-group col-md-6">
                 <label>Jenis Kelamin</label>
                 <select class="form-control" name="jk_pemohon_izin">
                   <option value="L">Laki - Laki</option>
                   <option value="P">Perempuan</option>
                 </select>
               </div>
               <div class="form-group col-md-6">
                 <label>Alamat</label>
                 <input type="text" class="form-control" name="alamat_pemohon_izin" placeholder="Masukkan Nama Jalan, RT/RW, No Rumah" value="<?php echo set_value('alamat_pemohon_izin')?>"required="true">
               </div>
               <div class="form-group col-md-6">
                 <label>Telepon</label>
                 <input type="text" class="form-control" name="tlp_pemohon_izin" placeholder="Nomor Telepon Pemohon Izin" value="<?php echo set_value('tlp_pemohon_izin')?>" required="true">
               </div>
               <div class="form-group col-md-6">
                 <label>Email (Opsional)</label>
                 <input type="email" class="form-control" name="email_pemohon_izin" placeholder="Email Pemohon Izin" value="<?php echo set_value('email_pemohon_izin')?>">
               </div>
               <div class="form-group col-md-6">
                 <label>Scan KTP (Opsional)</label>
                 <input type="file" name="ktp">
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
