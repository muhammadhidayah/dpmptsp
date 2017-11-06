<section class="content">
  <!-- Main row -->
  <div class="row">

    <!--Artikel Info-->
    <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo count($perizinan); ?></h3>
              <p>Perizinan</p>
            </div>
            <div class="icon">
              <i class="ion ion-document"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>

    <!--Berita Info-->
    <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo count($izin); ?></h3>
              <p>Jumlah Izin</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>

    <!--Kategori Galeri Info-->
    <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo count($pegawai); ?></h3>
              <p>Pegawai</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
  </div>

  <!--Div Untuk Informasi-->
<div class="col-lg-9 col-xs-6">
  <div class="box box-primary">
    <div class="box-header with-border">
      <i class="fa fa-bar-chart-o"></i>

      <h3 class="box-title">Grafik Perizinan Tahun <?php echo date('Y');?></h3>
      <h3 class="box-title pull-right"><a href="<?php echo base_url('kepdinas/perizinan/laporanperizinan')?>" class="btn btn-primary btn-xs"><i class="fa fa-location-arrow"></i> Detail</a></h3>
    </div>
    <div class="box-body">
      <div id="bar-chart" style="height: 300px;"></div>
    </div>
    <!-- /.box-body-->
  </div>
</div>
  <!-- /.row (main row) -->

  <div class="row">

  </div>
        <!-- /.col -->
</section>


<script type="text/javascript">
  $(document).ready(function(){
    /*
     * BAR CHART
     * ---------
     */

    var bar_data;

    $.ajax({
      url: '<?php echo base_url('kepdinas/perizinan/getPerizinanByYear')?>',
      dataType: 'json',
      async: false,
      success: function(data) {
        bar_data = data;
      }
    });

    console.log(bar_data);

    $.plot("#bar-chart", [bar_data], {
      grid: {
        borderWidth: 1,
        borderColor: "#f3f3f3",
        tickColor: "#f3f3f3"
      },
      series: {
        bars: {
          show: true,
          barWidth: 0.5,
          align: "center"
        }
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      }
    });
  });
</script>
