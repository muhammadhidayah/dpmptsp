<button class="btn btn-info btn-xs" id="detail_izin" data-toggle="modal" data-target="#myModal" data-id="<?php echo $izin->id_perizinan; ?>">
  <i class="fa fa-eye"> Kelengkapan</i>
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>

      <div class="modal-body">
        <div id="modal-loader" style="display: none; text-align: center;">
            <img src="<?php echo base_url();?>assets/ajax-loader.gif">
        </div>

        <div id="dynamic-content">
          <div class="row">
            <div class="col-md-12">
              <div class="table table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Nama Syarat</th>
                      <th>Kelengkapan</th>
                    </tr>
                  </thead>
                  <tbody id="showdata">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
