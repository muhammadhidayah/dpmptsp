<div class="wrapper row3">
  <main class="hoc container clear">
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content">
      <!-- ################################################################################################ -->
      <div id="gallery">
        <figure>
          <header class="heading"><?php echo $galeri[0]->kategori_galleri; ?></header>
          <ul class="nospace clear">
            <?php foreach ($galeri as $galeri): ?>
              <li class="one_quarter">
                <a href="<?php echo base_url('assets/upload/galeri/'.$galeri->gambar)?>" data-fancybox="group" data-caption>
                  <img src="<?php echo base_url('assets/upload/galeri/thumbs/'.$galeri->gambar)?>">
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
          <figcaption><?php echo $galeri->keterangan_katgalleri;?></figcaption>
        </figure>
      </div>
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $("[data-fancybox]").fancybox({ });
  });
</script>
