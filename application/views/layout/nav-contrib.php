  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="<?php echo base_url('login'); ?>">
            <i class="fa fa-dashboard"></i><span>Dashboard</span>
          </a>
        </li>
        <?php if($this->session->userdata('jenis_user') == 'Contributor') {?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-newspaper-o"></i><span>Berita/Artikel</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="<?php echo base_url('contributor/informasi/insertinformasi') ?>"><i class="fa fa-plus"></i>Tambah Informasi</a></li>
              <li><a href="<?php echo base_url('contributor/informasi/viewInformasi/berita') ?>"><i class="fa fa-folder-open"></i>Data Berita</a></li>
              <li><a href="<?php echo base_url('contributor/informasi/viewInformasi/artikel') ?>"><i class="fa fa-folder-open"></i>Data Artikel</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-file-picture-o"></i><span> Galeri</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="<?php echo base_url('contributor/kategori_galleri'); ?>"> <i class="fa fa-folder-open"></i>Kategori Gallery</a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url('login/logout')?>">
              <i class="fa fa-sign-out"></i> <span> Sign Out</span>
            </a>
          </li>
        <?php } elseif ($this->session->userdata('jenis_user') == 'Editor') { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-newspaper-o"></i><span>Berita/Artikel</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('editor/informasi/viewInformasi/berita') ?>"><i class="fa fa-folder-open"></i>Data Berita</a></li>
              <li><a href="<?php echo base_url('editor/informasi/viewInformasi/artikel') ?>"><i class="fa fa-folder-open"></i>Data Artikel</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="<?php echo base_url('editor/kategori_galleri')?>">
              <i class="fa fa-film"></i><span>Kategori Galeri</span>
            </a>
          </li>
        <?php } elseif ($this->session->userdata('jenis_user') == 'Operator') { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-file-text"></i><span>Kelola Izin</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="<?php echo base_url('operator/izin'); ?>"><i class="fa fa-folder-open"></i>Jenis Izin</a></li>
              <li><a href="<?php echo base_url('operator/syarat_izin') ?>"><i class="fa fa-folder-open"></i>Master Syarat</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i><span>Kelola Pemohon Izin</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="<?php echo base_url('operator/pemohon_izin/insertpemohonizin'); ?>"><i class="fa fa-plus"></i>Tambah Pemohon Izin</a></li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-folder"></i><span>Daftar Pemohon Izin</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="active"><a href="<?php echo base_url('operator/pemohon_izin/datapemohonizin/dalamproses'); ?>"><i class="fa fa-list-alt"></i>Daftar Proses</a></li>
                  <li class="active"><a href="<?php echo base_url('operator/pemohon_izin/datapemohonizin/menunggu'); ?>"><i class="fa fa-list-alt"></i>Daftar Menunggu</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-file-text"></i><span>Kelola Perizinan</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="<?php echo base_url('operator/perizinan/insertperizinan/pilih_izin'); ?>"><i class="fa fa-plus"></i>Tambah Perizinan</a></li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-folder"></i><span>Daftar Perizinan</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="active"><a href="<?php echo base_url('operator/perizinan/daftarperizinan/dalamproses'); ?>"><i class="fa fa-list-alt"></i>Daftar Proses</a></li>
                  <li class="active"><a href="<?php echo base_url('operator/perizinan/daftarperizinan/menunggu'); ?>"><i class="fa fa-list-alt"></i>Daftar Menunggu</a></li>
                  <li class="active"><a href="<?php echo base_url('operator/perizinan/daftarperizinan/izinterbit'); ?>"><i class="fa fa-list-alt"></i>Daftar Izin Terbit</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="treeview">
            <a href="<?php echo base_url('operator/perizinan/laporanperizinan'); ?>">
              <i class="fa fa-bar-chart"></i><span>Laporan Perizinan</span>
            </a>
          </li>
        <?php } elseif($this->session->userdata('jenis_user') == "Admin" ) { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa  fa-wrench"></i><span>Konfigurasi Web</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active">
                <a href="<?php echo base_url('admin/konfigurasi'); ?>"><i class="fa fa-globe"></i>Umum</a>
              </li>
              <li>
                <a href="<?php echo base_url('admin/konfigurasi/logo'); ?>"><i class="fa fa-cog"></i>Logo</a>
              </li>
              <li>
                <a href="<?php echo base_url('admin/konfigurasi/icon'); ?>"><i class="fa fa-cog"></i>Icon</a>
              </li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i><span>Manajemen Pegawai</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="treeview">
                <a href="<?php echo base_url('admin/pegawai/insertpegawai')?>">
                  <i class="fa fa-plus"></i>
                  <span>Tambah Pegawai</span>
                  <span class="pull-right-container">
                    <i></i>
                  </span>
                </a>
                <li class="treeview">
                  <a href="<?php echo base_url('admin/pegawai');?>">
                    <i class="fa fa-list-alt"></i> <span>Data Pegawai</span>
                    <span class="pull-right-container"><i></i></span>
                  </a>
                </li>
              </li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa  fa-user"></i><span>Manajemen User</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active">
                <a href="<?php echo base_url('admin/user/insertuser'); ?>"><i class="fa fa-plus"></i>Tambah User</a>
              </li>
              <li>
                <a href="<?php echo base_url('admin/user'); ?>"><i class="fa fa-list-alt"></i>Data User</a>
              </li>
            </ul>
          </li>
        <?php } elseif($this->session->userdata('jenis_user') == 1) {?>

        <?php } else { ?>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
