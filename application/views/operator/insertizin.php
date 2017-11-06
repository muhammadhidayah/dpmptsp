<section class="content">
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tambah Izin</h3>
          <hr />
          <div id="sukses" class="alert alert-success" role="alert" style="display: none;"></div>
          <div id="peringatan" class="alert alert-warning alert-dismissible" style="display: none;"></div>
        </div>

        <!-- Body Untuk Insert Izin dan persyaratan -->
        <div class="box-body">
          <form role="form" id="form_fieldizin">

            <!---->
            <div id="insert_izin" class="col-md-12">
              <div class="form-group col-md-6">
                <label>Nama Izin</label>
                <input type="text" placeholder="Masukkan Nama Izin" name="nama_izin" value="<?php echo set_value('nama_izin')?>" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label>Lama Berlaku Izin</label>
                <input type="number" min="1" class="form-control" name="masa_berlaku_izin" value="<?php echo set_value('masa_berlaku_izin')?>" placeholder="Masukkan Dalam Hitungan Bulan">
              </div>
              <div class="form-group col-md-6">
                <label>Syarat: </label>
                <input type="text" name="id_syarat[]" id="id_syarat" hidden="true">
                <button type="button" name="button" class="btn-primary btn-xs" id="btn_add">+</button>
                <input type="text" name="nama_syarat[]" id="nama_syarat" class="form-control" placeholder="Masukkan Syarat Izin">
              </div>
            </div>

            <!---->
            <div class="box-footer">
              <input type="button" name="submit" value="Simpan" id="submit" class="btn btn-primary btn-sm">
            </div>
          </form>
        </div>
        <!-- / Akhir Body Untuk Insert Izin dan persyaratan -->

      </div>
    </div>
  </div>
  <!-- /.row (main row) -->

</section>

<script type="text/javascript">
  $(document).ready(function(){
    var i = 1;
    var availableTags = '<?php echo base_url('operator/syarat_izin/searchsyarat')?>';
    $('#btn_add').click(function(){
      i++;
      var html_code = '<div id="row'+i+'" class="form-group col-md-6">';
      html_code += '<label>Syarat: </label>';
      html_code += '<input type="text" name="id_syarat[]" id="id_syarat" hidden="true">';
      html_code += '<button type="button" name="button" class="btn-danger btn-xs btn_remove" id="'+i+'">-</button>';
      html_code += '<input type="text" name="nama_syarat[]" id="nama_syarat" class="form-control">';
      html_code += '</div>'

      $('#insert_izin').append(html_code);
    });

    $(document).on('click', '.btn_remove', function(){
      var btn_id = $(this).attr('id');
      $("#row"+btn_id+"").remove();
    });

    $('#submit').click(function(){
      $.ajax({
        url: "<?php echo base_url('operator/izin/insertizindb')?>",
        data: $('#form_fieldizin').serialize(),
        method: "POST",
        dataType: 'json',
        success: function(data) {
          if(data.error != null) {
            $('#peringatan').html(data.error);
            $('#peringatan').fadeIn();
          } else {
            if(data.success) {
              $('#sukses').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Sukses!</h4> Izin Berhasil di Tambahkan!').fadeIn();
              $('#form_fieldizin')[0].reset();
            } else {
              $('#sukses').addClass('alert-danger').removeClass('alert-success');
              $('#sukses').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-close"></i> Gagal!</h4> Izin Gagal di Tambahkan!').fadeIn().delay(5000).fadeOut('slow');
            }
          }
        }
      });
    });

    $(document).on('keyup', '#nama_syarat', function(){
      var id = $(this).closest("div").attr("id");
      $(this).autocomplete({
        source: "<?php echo base_url('operator/syarat_izin/searchsyarat')?>",
        minLength:2,
        select: function(event, ui) {
          $(this).closest('div').find("#nama_syarat").val(ui.item.value);
          $(this).closest('div').find("#id_syarat").val(ui.item.key);
        }
      });
    });

    $("[type='number']").keypress(function (evt) {
      evt.preventDefault();
    });
  });
</script>
