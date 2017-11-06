<section class="content">
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <div class="col-xs-12">
      <div class="box">

        <!-- Begin Box Header-->
        <div class="box-header">
          <?php
                if($this->session->flashdata('sukses')) {
                  echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Sukses!</h4>';
                  echo $this->session->flashdata('sukses');
                  echo '</div>';
                }
              ?>
          <h3 class="box-title">Daftar Pemohon Izin</h3>
        </div>
        <!-- End Box Header -->

        <!-- Begin Box Body -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telp</th>
                <th>E-mail</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($pemohon as $pemohon): ?>
                <tr>
                  <td><?php echo $pemohon->nik_pemohon_izin; ?></td>
                  <td><?php echo $pemohon->nama_pemohon_izin; ?></td>
                  <td><?php echo $pemohon->alamat_pemohon_izin; ?></td>
                  <td><?php echo $pemohon->tlp_pemohon_izin; ?></td>
                  <td><?php echo $pemohon->email_pemohon_izin; ?></td>
                  <td><a href="<?php echo base_url('operator/pemohon_izin/editpemohonizin/'.$pemohon->nik_pemohon_izin)?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a><?php include('deletepemohonizin.php'); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- End Box Body -->



      </div>
    </div>
  </div>
  <!-- /.row (main row) -->

</section>
