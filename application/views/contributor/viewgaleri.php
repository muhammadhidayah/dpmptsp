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
          <h3 class="box-title">
            <?php echo $title; ?>
          </h3><hr>
          <a href="<?php echo base_url('contributor/galeri/tambahgaleri/'.$this->uri->segment('4'))?>" class="btn btn-primary btn-xs"><li class="fa fa-plus"></li> Tambah Foto</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div id="gallery">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Thumbnail</th>
                  <th>Judul Foto</th>
                  <th>Keterangan</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($galeri as $galeri) {?>
                  <tr>
                    <td>
                      <a href="<?php echo base_url('assets/upload/galeri/'.$galeri->gambar)?>" data-fancybox="group" data-caption>
                        <img src="<?php echo base_url('assets/upload/galeri/thumbs/'.$galeri->gambar)?>">
                      </a>
                    </td>
                    <td><?php echo $galeri->judul_galeri; ?></td>
                    <td><?php echo $galeri->keterangan_galeri; ?></td>
                    <td>
                      <?php include ('deletegaleri.php'); ?>
                    </td>
                  </tr>
                <?php }?>
                </tbody>
              </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
