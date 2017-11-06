 <!-- User Account: style can be found in dropdown.less -->
<?php if($this->session->userdata('id_level') == 3) {
    $this->load->model('User_pengelola_izin_m');
    $id_user  = $this->session->userdata('id_user');
    $profil   = $this->User_pengelola_izin_m->getUserPengelolaIzinByIdUser($user);
?>
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <?php if($profil->foto_user_pengelola_izin != null ||
             $profil->foto_user_pengelola_izin != "") { ?>
              <img src="<?php echo base_url('assets/upload/fotouser/'.$profil->foto_user_pengelola_izin); ?>" class="user-image" alt="User Image">>
    <?php } else { ?>
              <img src="<?php echo base_url('assets/upload/fotouser/'); ?>avatar.png" class="user-image" alt="User Image">
    <?php } ?>
    <span class="hidden-xs">Alexander Pierce</span>
  </a>
  <ul class="dropdown-menu">
  <!-- User image -->
    <li class="user-header">
      <img src="<?php echo base_url();?>assets/login/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

      <p>
        Alexander Pierce - Web Developer
      </p>
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-right">
        <a href="<?php echo base_url('login/logout'); ?>" class="btn btn-default btn-flat">Keluar</a>
      </div>
    </li>
  </ul>
</li>
<?php } ?>
<!-- Control Sidebar Toggle Button -->
