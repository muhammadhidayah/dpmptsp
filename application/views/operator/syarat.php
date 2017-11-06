<section class="content">
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
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
          <h3 class="box-title">Master Syarat</h3><hr/>
          <a href="<?php echo base_url('operator/syarat_izin/insertsyarat')?>" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>Tambah Syarat</a>
        </div>

        <div class="box-body">
          <?php foreach ($syarat as $syarat): ?>
            <div class="col-md-3 col-sm-4"><i class="fa fa-file-text-o"></i> <?php echo $syarat->nama_syarat; ?><a href="<?php echo base_url('operator/syarat_izin/deletesyarat/'.$syarat->id_syarat)?>" title="Hapus Syarat"> <li class="fa fa-close"></li></a></div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
  <!-- /.row (main row) -->

</section>
