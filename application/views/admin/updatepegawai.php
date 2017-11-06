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
          <?php echo form_open_multipart('admin/pegawai/updatePegawai/'.$this->uri->segment('4')); ?>
              <div class="form-group col-md-6">
                <label>No. Induk Pegawai</label>
                <input type="text" name="nip" class="form-control" placeholder="Masukkan No. Induk Pegawai" value="<?php echo $pegawai->nip; ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label>Nama</label>
                <input type="text" name="nama_pegawai" class="form-control" placeholder="Masukkan Nama Pegawai" value="<?php echo $pegawai->nama_pegawai;?>" required>
              </div>
              <div class="form-group col-md-6">
                <label>Alamat</label>
                <input type="text" name="alamat_pegawai" class="form-control" placeholder="Nama Jalan, RT/RW, No Rumah, Desa, Kecamatan" value="<?php echo $pegawai->alamat_pegawai?>" required>
              </div>
              <div class="form-group col-md-6">
                <label>Telepon</label>
                <input type="text" name="tlp_pegawai" class="form-control" placeholder="0812xxxxxxx" value="<?php echo $pegawai->tlp_pegawai?>" required>
              </div>
              <div class="form-group col-md-6">
                <label>E-mail</label>
                <input type="text" name="email_pegawai" class="form-control" placeholder="Masukkan Email Pegawai" value="<?php echo $pegawai->email_pegawai?>">
              </div>
              <div class="form-group col-md-6">
                <label>Jabatan</label>
                <select class="form-control" name="id_jabatan">
                  <?php foreach ($jabatan as $jabatan): ?>
                    <option value="<?php echo $jabatan->id_jabatan?>" <?php if($pegawai->id_jabatan == $jabatan->id_jabatan) echo "selected";?>><?php echo $jabatan->nama_jabatan ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            <div class="col-md-12">
              <div class="form-group col-md-6">
                <label>Foto</label>
                <input type="file" name="foto_pegawai">
                <p class="help-block">Upload foto degan ekstensi jpg. atau .png</p>
              </div>
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
