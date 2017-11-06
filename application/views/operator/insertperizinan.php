<section class="content">
	<!-- Main row -->
    <div class="box">
        <div class="box-header with-border">
            <?php
                echo validation_errors('<div class="alert alert-warning alert-dismissible">','</div>');

                if(isset($error)) {
                  echo '<div class="alert alert-warning alert-dismissible">';
                  echo $error;
                  echo '</div>';
                }
            ?>
        	<h3 class="box-title">
                <?php echo $izin[0]->nama_izin;?>
            </h3>
        </div>
        <div class="box-body">
            <div class="col-sm-12 alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Perhatian</h4>
                <ol>
                    <li>
                        <p>Masukkan Nomor Izin Jika Izin Sudah Terbit Sebelumnya <br /> Jika Belum Dikosongkan Saja</p>
                    </li>
                    <li>
                        <p>Pastikan NIP Sudah di Inputkan ke Dalam Database<br />Jika Belum Harap Hubungi Bagian Admin</p>
                    </li>
                    <li>
                        <p>Jika Izin Sudah Terbit sebelumnya Upload lah Izin tersebut dalam bntuk pdf</p>
                    </li>
                </ol>

            </div>
            <?php echo form_open_multipart();?>
                <div class="form-group col-md-6">
                    <label>Nomor Izin</label>
                    <input type="text" name="nomor_perizinan" class="form-control" placeholder="Masukkan Nomor Izin">
                </div>
                <div class="form-group col-md-6">
                    <label>Tanggal Izin Di Buat</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="tgl_izin_dibuat" required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Status Izin</label>
                    <select name="status_perizinan" class="form-control">
                        <option value="Dalam Proses">Dalam Proses</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Izin Terbit">Izin Terbit</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Jenis Perizinan</label>
                    <select name="jenis_perizinan" class="form-control">
                        <option value="Baru">Baru</option>
                        <option value="Perubahan">Perubahan</option>
                        <option value="Perpanjangan">Perpanjangan</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>NIK Pemohon Izin</label>
                    <input type="text" class="form-control" name="nik_pemohon_izin" id="nik_pemohon_izin" value="<?php echo set_value('nik_pemohon_izin')?>" placeholder="Masukkan NIK Pemohon Izin" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Alamat Lokasi</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Jalan, RT/RW, No Rumah, Desa, Kecamatan" name="alamat_perizinan" value="<?php echo set_value('alamat_perizinan')?>">
                </div>
                <?php foreach ($izin as $izin) { ; ?>
                <div class="form-group col-md-6">
                    <label><?php echo $izin->nama_syarat ?></label>
                    <select name="<?php echo $izin->nama_syarat ?>" class="form-control">
                        <option value="Lengkap">Ada</option>
                        <option value="Tidak Lenkap">Tidak Ada</option>
                    </select>
                </div>
                <?php } ?>

                <div class="form-group col-md-12">
                    <label>Upload Berkas</label>
                    <input type="file" name="berkas">
                    <p class="help-block">Upload seluruh berkas permohonan dengan menyimpannya dalam bentuk .rar atau .zip</p>
                    <label>Upload Izin</label>
                    <input type="file" name="izin-terbit">
                    <p class="help-block">Jika Izin Sudah Terbit Silahkan Untuk di Upload dalam bentuk .pdf</p>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" name="submit" class="btn btn-primary" value="submit">Submit</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <!-- /.row (main row) -->
</section>

<script>
  $(document).ready(function(){
    $('#nik_pemohon_izin').autocomplete({
      source: '<?php echo base_url('operator/Pemohon_izin/searchPemohonIzin')?>',
      minLength: 2,
      select: function(event, ui) {
        $('nik_pemohon_izin').val(ui.item.label);
      }
    });
  });
</script>
