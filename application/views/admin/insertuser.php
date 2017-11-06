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
            if(isset($error)) {
              echo '<div class="alert alert-warning>';
              echo $error;
              echo '</div>';
            }
          ?>
          <h3 class="box-title">Data Pegawai</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php echo form_open('admin/user/insertuser'); ?>
              <div class="form-group col-md-6">
                <label>No. Induk Pegawai</label>
                <input type="text" id="nip" name="nip" class="form-control" placeholder="Masukkan No. Induk Pegawai" value="<?php echo set_value('nip'); ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label>Username</label>
                <input type="text" name="username_pegawai" class="form-control" placeholder="Masukkan Nama Pegawai" value="<?php echo set_value('username_pegawai');?>" required>
              </div>
              <div class="form-group col-md-6">
                <label>Password</label>
                <input type="password" class="form-control" name="password_pegawai" placeholder="Masukkan Password User" value="<?php echo set_value('password_pegawai')?>">
              </div>
              <div class="form-group col-md-6">
                <label>Jabatan</label>
                <select class="form-control" name="jenis_user">
                  <option value="Contributor">Contributor</option>
                  <option value="Editor">Editor</option>
                  <option value="Operator">Operator</option>
                  <option value="Admin">Admin</option>
                  <option value="Kepala Dinas">Kepala Dinas</option>
                </select>
              </div>
            <div class="col-md-12">
              <div class="form-group col-md-6">
                <input type="submit" name="submit" value="Simpan" class="btn btn-primary btn-md">
              </div>
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

<script>
  $(document).ready(function(){
    $('#nip').autocomplete({
      source: '<?php echo base_url('admin/Pegawai/searchPegawai')?>',
      minLength: 2,
      select: function(event, ui) {
        $('#nip').val(ui.item.label);
      }
    });
  });
</script>
