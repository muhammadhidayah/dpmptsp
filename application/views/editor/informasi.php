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
          <h3 class="box-title"><?php echo $title; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Thumbnail</th>
              <th style="width:30%">Judul</th>
              <th style="width:30%">Deskripsi</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($informasi as $informasi) {?>
              <tr>
                <td><img src="<?php echo base_url('/assets/upload/informasi/thumbs/'.$informasi->gambar_informasi); ?>"></td>
                <td><?php echo $informasi->judul_informasi; ?></td>
                <td><?php echo $informasi->deskripsi_informasi; ?></td>
                <td>
                  <?php echo $informasi->status_informasi?>
                </td>
                <td>
                   <a href="#" class="btn btn-primary btn-sm" onclick="window.open('<?php echo base_url('editor/informasi/detailinformasi/'.$informasi->id_informasi)?>','_blank','width=900,height=1280')" title="Lihat"><i class="fa fa-eye"></i></a>
                   <a href="<?php echo base_url('editor/informasi/updateinformasi/'.$informasi->id_informasi) ?>" class="btn btn-primary btn-sm" title="Edit Berita"><i class="fa fa-edit"></i></a>

                   <?php include('deleteinformasi.php'); ?>
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
