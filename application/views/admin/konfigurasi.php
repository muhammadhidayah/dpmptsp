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
          ?>
          <h3 class="box-title">Konfigurasi Umum</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php echo form_open('admin/konfigurasi/simpankonfigurasiumum'); ?>
            <div class="col-md-5">
              <div class="form-group form-control-lg">
                <label>Nama Web/Organisasi</label>
                <input type="text" name="nama_kantor" value="<?php echo $konfigurasi->nama_kantor; ?>" class="form-control" required placeholder="Nama Organisasi">
              </div>
              <div class="form-group">
                <label>Moto</label>
                <input type="text" name="tagline_kantor" value="<?php echo $konfigurasi->tagline_kantor; ?>" class="form-control" placeholder="memberikan pelayanan sepenuh hati dan profesional untuk terpenuhinya harapan">
              </div>
              <div class="form-group">
                <label>URL Website</label>
                <input type="url" name="urlweb_kantor" value="<?php echo $konfigurasi->urlweb_kantor; ?>" class="form-control" placeholder="http://contoh.com">
              </div>
              <div class="form-group">
                <label>E-mail Resmi</label>
                <input type="email" name="email_kantor" value="<?php echo $konfigurasi->email_kantor; ?>" class="form-control" placeholder="dpmppt@belitungkab.go.id">
              </div>
              <div class="form-group">
                <label>No Telepon</label>
                <input type="text" name="telp_kantor" value="<?php echo $konfigurasi->telp_kantor; ?>" class="form-control" placeholder="(0719)12xxxxxx">
              </div>
              <div class="form-group">
                <label>Alamat Kantor</label>
                <textarea name="alamat_kantor" class="form-control" placeholder="Jalan xxxxxx"><?php echo $konfigurasi->alamat_kantor; ?></textarea>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <label>Keyword (Pencarian Google)</label>
                <textarea name="keyword_web" class="form-control" placeholder="Keyword Untuk Pencarian Google"><?php echo $konfigurasi->keyword_web; ?></textarea>
              </div>
              <div class="form-group">
                <label>Deskripsi (Pencarian Google)</label>
                <textarea name="deskripsi_web" class="form-control" placeholder="Deskripsi Untuk Pencarian Google"><?php echo $konfigurasi->deskripsi_web; ?></textarea>
              </div>
              <div class="form-group">
                <label>Metatext (Konfigurasi Google Web Master)</label>
                <textarea name="metatext_web" class="form-control" placeholder="Metatext Untuk Konfigurasi Google Webmaster"><?php echo $konfigurasi->metatext_web; ?></textarea>
              </div>
              <div class="form-group">
                <label>Google Map</label>
                <textarea name="koordinat_kantor" class="form-control" placeholder="iFrame Google Maps"><?php echo $konfigurasi->koordinat_kantor; ?></textarea>
              </div>
              <style type="text/css">
                iframe{ width: 100%;
                  height: 100px;

                }
              </style>
              <p><?php echo $konfigurasi->koordinat_kantor; ?></p>
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
