<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <style media="screen">
      input {
        width: 100%;
      }
      img {
        width: 600px;
        height: 150px;
      }
      table {
        width: 100%
      }

    </style>
    <script language="Javascript">

        function redirectToEdit(){
            window.opener.location.href="<?php echo base_url('editor/informasi/updateinformasi/'.$informasi[0]->id_informasi)?>";
            self.close();
        }

    </script>
  </head>
  <body>
    <table border="1px">
      <tr>
        <td colspan="3"><center><img src="<?php echo base_url('assets/upload/informasi/'.$informasi[0]->gambar_informasi)?>" alt="<?php echo $informasi[0]->judul_informasi;?>"></center></td>
      </tr>
      <tr>
        <td width="20%">Judul Informasi</td>
        <td>:</td>
        <td width="80%"><?php echo $informasi[0]->judul_informasi; ?></td>
      </tr>
      <tr>
        <td width="20%">Deskripsi Informasi</td>
        <td>:</td>
        <td width="80%"><?php echo $informasi[0]->deskripsi_informasi ?></td>
      </tr>
      <tr>
        <td>Posting</td>
        <td>:</td>
        <td><?php if($informasi[0]->nama_pegawai != NULL) {echo $informasi[0]->nama_pegawai;} else {echo "Anonymous";} ?></td>
      </tr>
      <tr>
        <td>Tanggal Posting</td>
        <td>:</td>
        <td><?php echo $informasi[0]->tanggal_post_informasi; ?></td>
      </tr>
      <tr>
        <td>Isi Informasi</td>
        <td>:</td>
        <td><?php echo strip_tags($informasi[0]->isi_informasi); ?></td>
      </tr>
      <tr>
        <td align="right" colspan="3">
          <a href="<?php echo base_url('editor/informasi/publishinformasi/'.$informasi[0]->id_informasi)?>"><button type="button" name="button">Publish</button></a>
          <button type="button" name="button" onclick="redirectToEdit()">Sunting</button>
          <a href="<?php echo base_url('editor/informasi/deleteinformasi/'.$informasi[0]->id_informasi)?>"><button type="button" name="button">Delete</button></a>
        </td>
      </tr>

    </table>
  </body>
</html>
