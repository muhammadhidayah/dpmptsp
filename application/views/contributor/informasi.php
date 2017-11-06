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
          <h3 class="box-title">Data Informasi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Thumbnail</th>
              <th>Judul</th>
              <th>Jenis Informasi</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($informasi as $informasi) {?>
              <tr>
                <td><center><img src="<?php echo base_url('/assets/upload/informasi/thumbs/'.$informasi->gambar_informasi); ?>"></center></td>
                <td style="width:40%"><?php echo $informasi->judul_informasi; ?></td>
                <td><?php echo $informasi->jenis_informasi; ?></td>
                <td>
                  <?php echo $informasi->status_informasi?>
                </td>
                <td>
                   <a href="<?php echo base_url('contributor/informasi/updateinformasi/'.$informasi->id_informasi) ?>" class="btn btn-primary btn-sm" title="Edit Berita"><i class="fa fa-edit"></i></a>

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
