<section class="content">
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tambah Syarat</h3>
          <hr />
          <div class="alert alert-success" role="alert" style="display: none;">p </div>
        </div>
        <div class="box-body">
          <div class="col-xs-6">
            <form id="tambah_syarat">
              <table class="table table-bordered" id="syarat_field">
                <tr>
                  <td><input type="text" name="syarat[]" placeholder="Nama Syarat" id="syarat"></td>
                  <td><input type="text" name="ketsyarat[]" placeholder="Keterangan Syarat" id="syarat"></td>
                  <td><button type="button" name="add" id="add" class="btn btn-primary btn-xs">More</button></td>
                </tr>
              </table>
              <input type="button" name="submit" id="submit" class="btn btn-primary btn-sm" value="Simpan">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.row (main row) -->

</section>

<script type="text/javascript">
  $(document).ready(function(){
    var i = 1;
    $('#add').click(function(){
      i++;
      var html_code = '<tr id="row'+i+'">';
      html_code += '<td><input type="text" name="syarat[]" placeholder="Nama Syarat" id="syarat"></td>';
      html_code += '<td><input type="text" name="ketsyarat[]" placeholder="Keterangan Syarat" id="ketsyarat"></td>'
      html_code += '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-xs btn_remove">-</button></td>';
      $('#syarat_field').append(html_code);
    });

    $(document).on('click','.btn_remove', function(){
      var btn_id = $(this).attr('id');
      $("#row"+btn_id+"").remove();
    });

    $('#submit').click(function(){
      $.ajax({
        url: "<?php echo base_url('operator/syarat_izin/tambahsyarat')?>",
        method: "POST",
        data: $('#tambah_syarat').serialize(),
        dataType: 'json',
        type    : 'ajax',
        success: function(response) {
          if(response.errors != null) {
            console.log(response.errors);
            $('.alert').addClass('alert-danger').removeClass('alert-success');
            $('.alert').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Failed!</h4> '+response.errors).fadeIn().delay(5000).fadeOut('slow');
          } else {
            $('.alert').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Sukses!</h4> Syarat Berhasil di Insert!').fadeIn().delay(5000).fadeOut('slow');
          }
            // location.reload();
        },
        error: function(){
          $('.alert').addClass('alert-danger').removeClass('alert-success');
          $('.alert').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Failed!</h4> Syarat Sudah di Inputkan!').fadeIn().delay(5000).fadeOut('slow');
        }
      });
    });
  });
</script>
