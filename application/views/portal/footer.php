<div class="wrapper row4 bgded overlay" style="background-image:url('images/demo/backgrounds/02.png');">
  <footer id="footer" class="hoc clear">
    <!-- ################################################################################################ -->
    <div class="one_third first">
      <h6 class="heading">DPMPTSP</h6>
      <p><?php echo $konfigurasi->deskripsi_web; ?></p>
    </div>
    <div class="one_third">
      <h6 class="heading">About Us</h6>
      <ul class="nospace btmspace-30 linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          <?php echo $konfigurasi->alamat_kantor; ?>
          </address>
        </li>
        <li><i class="fa fa-phone"></i> <?php echo $konfigurasi->telp_kantor; ?></li>
        <li><i class="fa fa-envelope-o"></i> <?php echo $konfigurasi->email_kantor; ?></li>
      </ul>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="heading">Maps</h6>
      <article>
        <?php echo $konfigurasi->koordinat_kantor; ?>
      </article>
    </div>
    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear">
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; <?php echo date('Y')?> - All Rights Reserved - <a href="<?php echo base_url()?>">DPMPTSPP Kab. Belitung</a></p>
    <p class="fl_right">Template by <a target="_blank" href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
