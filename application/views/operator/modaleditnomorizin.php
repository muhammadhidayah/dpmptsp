<?php if($izin->nomor_perizinan == "" && $izin->status_perizinan == "Izin Terbit") { ?>
<a href="#" id="<?php echo $id; ?>" data-id="<?php echo $izin->id_perizinan; ?>"><i class="fa fa-edit"></i> <?php echo $val; ?></a>
<?php }else { ?>
<sup><a href="#" id="<?php echo $id; ?>" data-id="<?php echo $izin->id_perizinan; ?>"><i class="fa fa-edit"></i> <?php echo $val; ?></a></sup>
<?php } ?>
<!-- Modal -->
<div class="modal fade" id="myModalEditIzin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>

      <div class="modal-body">
      <div id="peringatan" class="alert alert-warning alert-dismissible" style="display: none;"></div>
        <?php echo form_open('', array('id' => 'myFormIdIzin', 'class' => 'form-horizontal')); ?>
          <div class="form-group col-md-6">
            <input type="text" class="form-control" placeholder="Masukkan Nomor Perizinan" name="nomor_perizinan" size="40" value="<?php echo set_value('nomor_perizinan'); ?>">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save">Simpan</button>
      </div>
    </div>
  </div>
</div>
