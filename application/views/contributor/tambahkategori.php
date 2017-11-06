<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Kategori Galeri
</button>

<!-- Modal -->
<div <?php if(validation_errors() != "" ) { echo 'class="modal show"'; } else { echo 'class="modal fade"';}?> id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Kategori Galeri</h4>
      </div>
      <?php echo form_open(base_url('contributor/kategori_galleri/insertkategori')); ?>
      <div class="modal-body">
        <div class="form-group col-xs-6">
          <label>Nama Kategori</label>
          <input class="form-control" type="text" name="kategori_galleri" value="<?php echo set_value('kategori_galleri');?>" required>
        </div>
        <div class="form-group col-xs-6">
          <label>Keterangan Kategori</label>
          <input class="form-control" type="text" name="keterangan_katgalleri" value="<?php echo set_value('keterangan_katgalleri');?>" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        <?php echo form_close(); ?>
    </div>
  </div>
</div>
