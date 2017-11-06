<section class="content">
	<!-- Main row -->
    <div class="box">
        <div class="box-header with-border">
        	<h3 class="box-title"></h3>
        </div>
        <div class="box-body">
        	<?php foreach ($nama_izin as $izin): ?>
        	  <div class="form-group col-md-4">
              <a href="<?php echo base_url('operator/perizinan/insertperizinan/'.$izin->id_izin); ?>" class="btn btn-info btn-sm btn-block">
                <?php echo $izin->nama_izin; ?>
              </a>
        	  </div>
        	<?php endforeach; ?>
        </div>
    </div>
    <!-- /.row (main row) -->
</section>
