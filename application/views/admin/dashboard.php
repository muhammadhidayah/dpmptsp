<section class="content">
     <div class="row">
       <div class="col-xs-12">
         <div class="box">
           <div class="box-header">
             <?php
               if($this->session->flashdata('sukses')) {
                 echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Sukses!</h4>';
                 echo $this->session->flashdata('sukses');
                 echo '</div>';
               }
             ?>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <table>

             </table>
           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->
   </section>
