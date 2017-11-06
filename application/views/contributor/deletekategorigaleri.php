<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $galeri->id_kategori_galleri; ?>">
  <i class="fa fa-trash"> Hapus</i>
</button>

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $galeri->id_kategori_galleri;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Hapus Kategori?</h4>
      </div>
      <div class="modal-body">
        Apakah Anda Yakin Ingin Menghapus Kategori Ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="<?php echo base_url('contributor/kategori_galleri/deletekategori/'.$galeri->id_kategori_galleri) ?>" class="btn btn-danger"><i class="fa fa-trash">Hapus Kategori Ini</i></a>
      </div>
    </div>
  </div>
</div>
