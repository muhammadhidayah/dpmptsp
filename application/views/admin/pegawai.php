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
          <h3 class="box-title">Daftar Pegawai</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Foto</th>
              <th>No. Induk Pegawai</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($pegawai as $user) {?>
              <tr>
                <td><img src="<?php echo base_url('assets/upload/fotouser/'.$user->foto_pegawai)?>" alt="" width="30" height="20"></td>
                <td><?php echo $user->nip; ?></td>
                <td><?php echo $user->nama_pegawai; ?></td>
                <td><?php echo $user->nama_jabatan; ?></td>
                <td><?php echo $user->email_pegawai; ?></td>
                <td>
                   <a href="<?php echo base_url('admin/pegawai/updatepegawai/'.$user->nip) ?>" class="btn btn-primary btn-sm" title="Edit User Admin"><i class="fa fa-edit"></i></a>

                   <?php include('modaldeletepegawai.php'); ?>
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

<script>
</script>
