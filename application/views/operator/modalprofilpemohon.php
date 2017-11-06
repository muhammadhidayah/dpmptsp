<button class="btn btn-success btn-sm" id="profil_pemohon" data-toggle="modal" data-target="#myModalUser" data-id="<?php echo $izin->nik_pemohon_izin; ?>">
  <i class="fa fa-eye"> Pemohon</i>
</button>

<!-- Modal -->
<div class="modal fade" id="myModalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> User Pemohon Izin</h4>
      </div>

      <div class="modal-body">
        <div id="modal-loader" style="display: none; text-align: center;">
            <img src="<?php echo base_url();?>assets/ajax-loader.gif">
        </div>

        <div id="content-profil">
          <div class="row">
            <div class="col-md-12">
              <div class="table table-responsive">
                <table class="table table-hover">
                  <tr>
                    <th>NIK</th>
                    <td id="nik_pemohon_izin"></td>
                  </tr>
                  <tr>
                    <th>Nama Lengkap</th>
                    <td id="full_name"></td>
                  </tr>
                  <tr>
                    <th>Jenis Kelamin</th>
                    <td id="jk"></td>
                  </tr>
                  <tr>
                    <th>Alamat</th>
                    <td id="alamat"></td>
                  </tr>
                  <tr>
                    <th>No HP</th>
                    <td id="nohp"></td>
                  </tr>
                  <tr>
                    <th>E-mail</th>
                    <td id="email"></td>
                  </tr>
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
