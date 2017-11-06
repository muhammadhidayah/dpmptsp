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
          <div class="alert alert-success" role="alert" style="display: none;">p </div>
          <h3 class="box-title">Data Permohonan Izin</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No Pendaftaran</th>
              <th>No Izin</th>
              <th>Persyaratan</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($perizinan as $izin) {?>
              <tr>
                <td><?php echo $izin->id_perizinan; ?></td>
                <td>
                  <?php if($izin->nomor_perizinan == "" && $izin->status_perizinan == "Izin Terbit") {
                    $val = 'Tambah Nomor Izin';
                    $id = 'tambahnomorizin';
                    include('modaleditnomorizin.php');
                  } elseif ($izin->nomor_perizinan != "" && $izin->status_perizinan == "Izin Terbit") {
                      echo $izin->nomor_perizinan;
                      $val  = 'Edit Nomor Izin';
                      $id   = 'editnomorizin';
                      include('modaleditnomorizin.php');
                    } else {

                    }?>

                  </td>
                <td>
                  <?php include ('modaldetailperizinan.php'); ?>
                </td>
                <td> <?php echo $izin->status_perizinan; ?> &nbsp <?php include('modaleditstatusizin.php'); ?></td>
                <td>
                  <!--<a href="<?php echo base_url('operator/perizinan/downloadizin/'.$izin->berkas_perizinan); ?>" class="btn btn-success btn-sm"><i class="fa fa-download" title="Download Berkas Izin"> Download</i></a>-->
                  <?php include('modalprofilpemohon.php'); ?>
                  <a href="<?php echo base_url('operator/perizinan/cetaktandaterima/'.$izin->id_perizinan.'/'.$izin->nik_pemohon_izin); ?>" class="btn btn-info btn-sm" title="Print Tanda Terima" target="_blank"><i class="fa fa-print"> Tanda Terima</i></a>
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
$(document).ready(function(){

$(document).on('click', '#editnomorizin',function(e){
  e.preventDefault();
  var id_perizinan = $(this).data('id');
  $('#myModalEditIzin').modal('show');
  $('#myModalEditIzin').find('.modal-title').html('Edit Nomor Izin');
  $('#myFormIdIzin').attr('action','<?php echo base_url('operator/perizinan/editnomorperizinan/'); ?>'+id_perizinan);

  $.ajax({
    url       : '<?php echo base_url('operator/perizinan/detailizin/'); ?>'+id_perizinan,
    method    : 'GET',
    dataType  : 'json',
    success   : function(data){
      $('input[name=no_id_perizinan]').val(data[0].no_id_perizinan);
    },
    error     : function(){
      $('.modal-body').html('<i class="fa fa-info"></i> Something went wrong, Please try again...');
    }
  })
});

$(document).on('click', '#tambahnomorizin', function(e){
  e.preventDefault();
  var id_perizinan = $(this).data('id');
  $('#myModalEditIzin').modal('show');
  $('#myModalEditIzin').find('.modal-title').html('Tambah No ID Izin');
  $('#myFormIdIzin').attr('action','<?php echo base_url('operator/perizinan/editnomorperizinan/'); ?>'+id_perizinan);
})

$(document).on('click','#save', function(){
  var url     = $('#myFormIdIzin').attr('action');
  var data    = $('#myFormIdIzin').serialize();
  $.ajax({
    url     : url,
    method  : 'POST',
    data    : data,
    dataType: 'json',
    type    : 'ajax',
    success : function(response) {
      if(response.errors != null) {
        $('#peringatan').html(response.errors);
        $('#peringatan').fadeIn();
      } else {
        if(response.success) {
          $('#myModalEditStatus').modal('hide');
          $('.alert').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Sukses!</h4> Status Izin Berhasil di Update!').fadeIn().delay(5000).fadeOut('slow');
          location.reload();
        }
      }
    },
    error     : function(){
      $('.modal-body').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
    }
  });
});

$(document).on('click', '#editstatusizin', function(e) {
  e.preventDefault();
  var izin_id = $(this).data('id');
  $('#myModalEditStatus').modal('show');
  $('#myModalEditStatus').find('.modal-title').html('Edit Status Permohonan Izin');
  $('#myFormStatus').attr('action', '<?php echo base_url('operator/perizinan/editStatusPerizinan/'); ?>'+izin_id);

  $.ajax({
    url     : '<?php echo base_url('operator/perizinan/detailizin/'); ?>'+izin_id,
    type    : 'GET',
    dataType: 'json',
    data    : 'id='+izin_id,
    success : function(data) {
      $('select[name=status_perizinan]').val(data[0].status_perizinan);
    },
    error   : function() {
      $('.modal-body').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
    }

  });
});

$(document).on('click', '#btn-save', function(){
  var url   = $('#myFormStatus').attr('action');
  var data  = $('#myFormStatus').serialize();

  $.ajax({
    url     : url,
    method  : 'POST',
    data    : data,
    dataType: 'json',
    type    : 'ajax',

    success : function(response) {
      if(response.success) {
        $('#myModalEditStatus').modal('hide');
        $('.alert').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Sukses!</h4> Status Izin Berhasil di Update!').fadeIn().delay(5000).fadeOut('slow');
        location.reload();
      }
    },
    error   : function() {
      $('.modal-body').html('<i class="fa fa-info"></i> Something went wrong, Please try again...');
    }
  });
});

$(document).on('click', '#profil_pemohon', function(e){
  e.preventDefault();
  var uid = $(this).data('id');

  $('#content-profil').hide();
  $('#modal-loader').show();

  $.ajax({
    url     : '<?php echo base_url('operator/Pemohon_izin/detailpemohonizin/'); ?>'+uid,
    type    : 'POST',
    data    : 'id='+uid,
    dataType: 'json'
  })
  .done(function(data){
    console.log(data);
    $('#content-profil').hide();
    $('#content-profil').show();
    $('#modal-loader').hide();
    $('#nik_pemohon_izin').html(data.nik_pemohon_izin);
    $('#full_name').html(data.nama_pemohon_izin);
    $('#jk').html(data.jk_pemohon_izin);
    $('#alamat').html(data.alamat_pemohon_izin);
    $('#nohp').html(data.tlp_pemohon_izin);
    $('#email').html(data.email_pemohon_izin);
  })
  .fail(function(){
    $('.modal-body').html('<i class="fa fa-info"></i> Something went wrong, Please try again...');
  });
});

$(document).on('click', '#detail_izin', function(e){
  e.preventDefault();
  var uid = $(this).data('id');

  $('#dynamic-content').hide();
  $('#modal-loader').show();

  $.ajax({
    url       : '<?php echo base_url('operator/perizinan/detailizin/');?>'+uid,
    type      : 'POST',
    data      : 'id='+uid,
    dataType  : 'json'
  })
  .done(function(data){
    console.log(data);
    $('#dynamic-content').hide();
    $('#dynamic-content').show();
    var hasil = '';
    var i;

    for(i = 0; i < data.length; i++) {
      hasil +=  '<tr>' +
                  '<td>'+data[i].nama_syarat+'</td>' +
                  '<td>'+data[i].kelengkapan_syarat+'</td>'+
                '</tr>'
    }
    $('#modal-loader').hide();
    $('#myModalLabel').html(data[0].nama_izin);
    $('#showdata').html(hasil);
  })
  .fail(function(){
    $('#modal-body').html('<i class="fa fa-info"></i> Something went wrong, Please try again...');
  });
});
});
</script>
