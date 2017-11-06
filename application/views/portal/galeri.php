<div class="wrapper row3">
  <main class="hoc container clear">
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content">
      <!-- ################################################################################################ -->
      <div id="gallery">
        <figure>
          <header class="heading">Album Galeri</header>
          <ul class="nospace clear">
            <?php foreach ($galeri as $galeri): ?>
              <li class="one_quarter">
                <a href="<?php echo base_url('portal/galeri/view/'.$galeri->slug_katgaleri)?>"><img src="<?php echo base_url()?>assets/front/images/galeri.png" alt=""></a>
                <center><p><?php echo $galeri->kategori_galleri; ?></p></center>
              </li>
            <?php endforeach; ?>
          </ul>
          <figcaption>Gallery Description Goes Here</figcaption>
        </figure>
      </div>
      <!-- ################################################################################################ -->
      <!-- ################################################################################################ -->
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
