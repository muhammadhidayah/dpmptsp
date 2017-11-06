<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <?php
            if($this->session->flashdata('sukses')) {
              echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Sukses!</h4>';
              echo $this->session->flashdata('sukses');
              echo '</div>';
            }
            echo validation_errors('<div class="alert alert-warning">','</div>');
            if (isset($error)) {
              echo '<div class="alert alert-warning">';
              echo $error;
              echo "</div>";
            }
          ?>
          <h3 class="box-title">Ganti Logo</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php echo form_open_multipart('admin/konfigurasi/logo'); ?>
            <div class="col-md-5">
              <div class="form-group form-control-lg">
                <label><h3>Upload Logo Baru</h3></label>
                <input type="file" name="logo" required>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <label><h3>Logo Saat ini</h3> <hr></label>
                <p><img src="<?php echo base_url('assets/img/'.$konfigurasi->logo_web); ?>"></p>
              </div>
            </div>
            <div class="col-md-12">
              <input type="submit" name="submit" value="Simpan Konfigurasi" class="btn btn-primary btn-md">
            </div>
          <?php echo form_close(); ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
