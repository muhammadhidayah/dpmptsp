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
          <div class="alert alert-success" role="alert" style="display: none;"></div>

          <form id="laporanperizinan" action="<?php echo base_url('operator/perizinan/cetaklaporan')?>" method="POST">
            <div class="form-group col-md-4">
              <label>Jenis Izin: </label>
                <select class="form-control select2" style="width: 100%;" name="nama_izin">
                  <?php foreach ($izin as $izin): ?>
                    <option value="<?php echo $izin->id_izin?>"><?php echo $izin->nama_izin; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
              <label>Date range:</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="reservation" name="rangewaktu">
              </div>
            <!-- /.input group -->
            </div>

            <div class="form-group col-md-4">
              <label>Status Perizinan</label>
              <select class="form-control select2" style="width: 100%;" name="status_perizinan">
                <option value="Dalam Proses">Dalam Proses</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Izin Terbit">Izin Terbit</option>
              </select>
            </div>

            <div class="form-group col-sm-12">
              <button type="button" class="btn btn-info" name="btntampil" id="btntampil"><i class="fa fa-search"></i> Tampil</button>
              <!-- <button type="submit" class="btn btn-success" name="btncetak" id="btncetak"><i class="fa fa-print"></i> Cetak</button> -->
            </div>
          </form>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="laporan1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No Pendaftaran</th>
              <th>No Izin</th>
              <th>NIK Pemohon Izin</th>
              <th>Status Perizinan</th>
              <th>Jenis Perizinan</th>
              <th>Penerima Berkas</th>
            </tr>
            </thead>
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

$(document).ready(function(){

  $(".select2").select2();
  $('#reservation').daterangepicker();
  $('#btntampil').click(function(){
    $.ajax({
      url: '<?php echo base_url('kepdinas/perizinan/getLaporanIzin')?>',
      method: 'POST',
      data: $('#laporanperizinan').serialize(),
      dataType: 'json',
      type: 'ajax',
      success: function(response){
        $('#laporan1').dataTable().fnClearTable();
        $('#laporan1').dataTable().fnDestroy();
        var data = { "aaData": [] };

        $.each(response, function(input, output) {
          data.aaData.push({"id_perizinan": output.id_perizinan,
                            "no_perizinan": output.nomor_perizinan,
                            "nik_pemohon_izin": output.nik_pemohon_izin,
                            "status_perizinan": output.status_perizinan,
                            "nama_izin": output.nama_izin,
                            "nama_pegawai": output.nama_pegawai
          });
        });

        table = $('#laporan1').DataTable({
          "aaData": data.aaData,
          "columns": [
            {data: "id_perizinan"},
            {data: "no_perizinan"},
            {data: "nik_pemohon_izin"},
            {data: "status_perizinan"},
            {data: "nama_izin"},
            {data: "nama_pegawai"}
          ]
        });
        console.log(response);
      }
    });
  });
});
</script>
