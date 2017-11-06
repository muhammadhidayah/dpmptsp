<section class="content">
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Daftar Izin</h3> <hr>
          <a href="<?php echo base_url('operator/izin/insertizin')?>" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Tambah Izin</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Izin</th>
                <th>Masa Berlaku Izin</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 0; foreach ($izin as $izin): ?>
                <?php $i++; ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $izin->nama_izin; ?></td>
                  <td><?php echo $izin->masa_berlaku_izin; ?> Tahun</td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
  <!-- /.row (main row) -->

</section>
