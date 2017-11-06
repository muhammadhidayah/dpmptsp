<section class="content">
  <!-- Main row -->
  <div class="row">

    <!--Artikel Info-->
    <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $jumlah_artikel; ?></h3>
              <p>Artikel Publish</p>
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
              <h3><?php echo $jumlah_artikel; ?></h3>
              <p>Berita Publish</p>
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
              <h3><?php echo $jumlah_artikel; ?></h3>
              <p>Galeri Publish</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-folder"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>

    <!--Foto Info-->
    <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $jumlah_artikel; ?></h3>
              <p>Foto</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-image"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
  </div>

  <!--Div Untuk Informasi-->
  <div class="row">
    <section class="col-lg-8">
          <div class="nav-tabs-custom">
            <div class="box box-warning">
              <div class="box-header">
                <i class="ion ion-paper-airplane"></i>
                <h3 class="box-title">Informasi Yang Belum di Publish</h3>
              </div>
              <?php $i = 0; foreach ($informasi  as $informasi): ?>
                <?php if(++$i == 5) break; ?>
                <?php if($informasi->status_informasi == "unpublish") { ?>
                  <div class="box-body chat" id="chat-box">
                    <div class="item">
                      <img src="<?php echo base_url('assets/upload/informasi/thumbs/'.$informasi->gambar_informasi)?>">
                      <p class="message">
                        <a href="#" class="name" onclick="window.open('<?php echo base_url('editor/informasi/detailinformasi/'.$informasi->id_informasi)?>','_blank','width=900,height=1280')">
                          <small class="pull-right"><i class="fa fa-clock-o"></i><?php echo $informasi->tanggal_post_informasi; ?></small>
                          <?php echo $informasi->judul_informasi;?>
                        </a>
                        <?php echo substr($informasi->deskripsi_informasi,0,300); ?>
                      <a href="#" class="name">
                        <small class="pull-right"><i class="ion-ios-compose-outline"></i> <?php if($informasi->nama_pegawai != NULL) {echo $informasi->nama_pegawai;} else {echo "Anonymous";} ?></small>
                      </a>
                      </p>
                    </div>
                  </div>
                <?php } ?>
              <?php endforeach; ?>
            </div>
          </div>
        </section>
  </div>
  <!-- /.row (main row) -->

  <div class="row">

  </div>
        <!-- /.col -->
</section>
