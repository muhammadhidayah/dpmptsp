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
          ?>
          <h3 class="box-title">Data Kategori Galeri</h3><hr>

        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nama Kategori</th>
              <th>Keterangan</th>
              <th>Status Kategori</th>
              <th>Jumlah Foto</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($galeri as $galeri) {?>
              <tr>
                <td><?php echo $galeri->kategori_galleri; ?></td>
                <td><?php echo $galeri->keterangan_katgalleri; ?></td>
                <td><?php echo $galeri->status_katgaleri; ?></td>
                <td><?php echo $galeri->jumlah; ?></td>
                <td>
                  <a href="<?php echo base_url('editor/galeri/viewgaleri/'.$galeri->id_kategori_galleri); ?>" class="btn btn-primary btn-sm" title="Lihat Galeri">
                    <i class="fa fa-eye"> Galeri</i>
                  </a>
                  <?php if($galeri->status_katgaleri == 'unpublish') { ?>
                    <a href="<?php echo base_url('editor/kategori_galleri/editstatuskatgaleri/'.$galeri->id_kategori_galleri.'/'.$galeri->status_katgaleri) ?>" class="btn btn-primary btn-sm" title="Publish Kategori">
                      <i class="fa fa-check-square-o"></i> Publish
                    </a>
                  <?php } else { ?>
                    <a href="<?php echo base_url('editor/kategori_galleri/editstatuskatgaleri/'.$galeri->id_kategori_galleri.'/'.$galeri->status_katgaleri) ?>" class="btn btn-danger btn-sm" title="Unpublish Kategori"><i class="fa fa-check-square-o"></i>Unpublish</a>
                  <?php } ?>
                  <?php include('deletekategorigaleri.php'); ?>
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
