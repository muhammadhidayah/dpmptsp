<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear">
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <h6 class="heading">Berita</h6>
    </div>
    <div class="group excerpts">
      <?php $i = 0; foreach ($berita as $berita): $i++; if($i > 3) break;?>
        <article class="one_third">
          <figure><img src="<?php echo base_url('assets/upload/informasi/'.$berita->gambar_informasi); ?>" alt="">
            <figcaption>
              <time datetime="<?php echo $berita->tanggal_post_informasi;?>"><strong><?php echo substr($berita->tanggal_post_informasi,8,9);?></strong> <em><?php echo substr(date('F, Y', strtotime($berita->tanggal_post_informasi)),0,3); ?></em></time>
            </figcaption>
          </figure>
          <div class="hgroup">
            <h4 class="heading"><?php echo $berita->judul_informasi; ?></h4>
            <ul class="nospace meta">
              <li>by <a href="#">Admin</a></li>
            </ul>
          </div>
          <div class="txtwrap">
            <p><?php echo substr($berita->deskripsi_informasi, 0, 255); ?></p>
          </div>
          <footer><a class="btn" href="<?php echo base_url('portal/informasi/read/'.$berita->slug_informasi);?>">Read More &raquo;</a></footer>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="sectiontitle">
      <a href="#" class="btn btn-sm btn-lht">Lihat Artikel</a>
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>

</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper overlay coloured">
  <section class="hoc container clear">
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <h6 class="heading">Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu</h6>
      <p>Selau Memberikan Pelayanan Terbaik Kepada Masyarakat.</p>
    </div>
    <ul id="stats" class="nospace group">
      <li class="one_quarter first"><a href="#"><i class="fa fa-3x fa-cogs"></i></a>
        <p>Perizinan</p>
        <p>12345</p>
      <li class="one_quarter"><a href="#"><i class="fa fa-3x fa-comments-o"></i></a>
        <p>Layanan Izin</p>
        <p>12345</p>
      </li>
      <li class="one_quarter"><a href="#"><i class="fa fa-3x fa-user"></i></a>
        <p>Pegawai</p>
        <p>12345</p>
      </li>
      <li class="one_quarter"><a href="#"><i class="fa fa-3x fa-newspaper-o"></i></a>
        <p>Informasi</p>
        <p>12345</p>
      </li>
    </ul>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear">
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <h6 class="heading">Artikel</h6>
    </div>
    <div class="group excerpts">
      <?php $i = 0; foreach ($artikel as $berita): $i++; if($i > 3) break;?>
        <article class="one_third">
          <figure><img src="<?php echo base_url('assets/upload/informasi/'.$berita->gambar_informasi); ?>" alt="">
            <figcaption>
              <time datetime="<?php echo $berita->tanggal_post_informasi;?>"><strong><?php echo substr($berita->tanggal_post_informasi,8,9);?></strong> <em><?php echo substr(date('F, Y', strtotime($berita->tanggal_post_informasi)),0,3); ?></em></time>
            </figcaption>
          </figure>
          <div class="hgroup">
            <h4 class="heading"><?php echo $berita->judul_informasi; ?></h4>
            <ul class="nospace meta">
              <li>by <a href="#">Admin</a></li>
            </ul>
          </div>
          <div class="txtwrap">
            <p><?php echo substr($berita->deskripsi_informasi, 0, 255); ?></p>
          </div>
          <footer><a class="btn" href="<?php echo base_url('portal/informasi/read/'.$berita->slug_informasi);?>">Read More &raquo;</a></footer>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="sectiontitle">
      <a href="#" class="btn btn-sm btn-lht">Lihat Artikel</a>
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>

</div>

<style media="screen">
  .btn-lht{
    margin-top: 20px;
    margin-bottom: 50px;
  }
</style>
