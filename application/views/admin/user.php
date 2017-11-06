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
              <th>No. Induk Pegawai</th>
              <th>Username</th>
              <th>Jenis User</th>
              <th>Last Update</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($user as $user) {?>
              <tr>
                <td><?php echo $user->nip; ?></td>
                <td><?php echo $user->username_pegawai; ?></td>
                <td><?php echo $user->jenis_user; ?></td>
                <td><?php echo $user->last_login; ?></td>
                <td>
                   <a href="<?php echo base_url('admin/user/updateuser/'.$user->id_user.'/'.$user->nip) ?>" class="btn btn-primary btn-sm" title="Edit User Admin"><i class="fa fa-edit"></i></a>

                   <?php include('modaldeleteuser.php'); ?>
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
