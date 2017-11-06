<sup><a href="#" id="editstatusizin" data-id="<?php echo $izin->id_perizinan; ?>"><i class="fa fa-edit"></i> Edit Status</a></sup>

<!-- Modal -->
<div class="modal fade" id="myModalEditStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>

      <div class="modal-body">
        <form class="form-horizontal" action="" method="POST" id="myFormStatus">
          <div class="form-group col-md-12">
            <select name="status_perizinan" class="form-control">
              <option value="Izin Terbit">Izin Terbit</option>
              <option value="Menunggu" <?php if($izin->status_perizinan == "Menunggu") echo "selected";?>>Menunggu</option>
              <option value="Dalam Proses" <?php if($izin->status_perizinan == "Dalam Proses") echo "selected";?>>Dalam Proses</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save">Simpan</button>
      </div>
    </div>
  </div>
</div>
