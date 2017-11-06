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
            } else if($this->session->flashdata('gagal')) {
              echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Gagal di Hapus!</h4>';
              echo $this->session->flashdata('gagal');
              echo '</div>';
            } else {

            }
          ?>
          <h3 class="box-title">Data Kategori Galeri</h3><hr>
          <?php include('tambahkategori.php'); ?>

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
                   <a href="<?php echo base_url('contributor/galeri/viewgaleri/'.$galeri->id_kategori_galleri) ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"> Lihat Foto</i></a>
                   <a href="<?php echo base_url('contributor/galeri/tambahgaleri/'.$galeri->id_kategori_galleri) ?>" class="btn btn-primary btn-xs"><i class="fa fa-plus"> Tambah Foto</i></a>
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
