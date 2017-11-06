<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?php echo $user->id_user; ?>">
  <i class="fa fa-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $user->id_user;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Hapus Pegawai?</h4>
      </div>
      <div class="modal-body">
        Apakah Anda Yakin Ingin Menghapus User Ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="<?php echo base_url('admin/user/deleteuser/'.$user->id_user) ?>" class="btn btn-danger"><i class="fa fa-trash">Hapus User</i></a>
      </div>
    </div>
  </div>
</div>
