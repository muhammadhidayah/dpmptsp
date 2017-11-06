<?php $konfigurasi = $this->Konfigurasi_model->getKonfigurasi(); ?>
<!DOCTYPE html>
<!--
Template Name: Basend
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html lang="">
<head>
<title>

<?php if(isset($title)) { ?>
<?php echo $title .' - '. $konfigurasi->nama_kantor;?>
<?php } else { ?>
<?php echo $konfigurasi->nama_kantor;?>
<?php } ?>
</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="Shortcut Icon" type="image/x-icon" href="<?php echo base_url('assets/img/'.$konfigurasi->icon_web); ?>">
<link href="<?php echo base_url('')?>assets/front/layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url('')?>assets/front/layout/styles/slide.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/fancybox/jquery.fancybox.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

<meta name="description" content="<?php echo $deskripsi;?>" />
<meta property="og:title" content="<?php echo $konfigurasi->nama_kantor;?>" />
<meta property="og:description" content="<?php echo $deskripsi;?>">
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $konfigurasi->urlweb_kantor?>" />
<style type="text/css">
  iframe{ width: 100%;
    height: 280px;

  }
</style>
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<?php include('header.php')?>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php echo $contents;?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include('footer.php');?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="<?php echo base_url('')?>assets/front/layout/scripts/jquery.min.js"></script>
<script src="<?php echo base_url('')?>assets/front/layout/scripts/slide.js"></script>
<script src="<?php echo base_url('')?>assets/front/layout/scripts/jquery.backtotop.js"></script>
<script src="<?php echo base_url('')?>assets/front/layout/scripts/jquery.mobilemenu.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancybox/jquery.fancybox.js"></script>
</body>
</html>
