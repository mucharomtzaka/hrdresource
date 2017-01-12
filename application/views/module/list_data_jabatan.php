 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    	
       <div class="row">
         <?php if($message){?>
              <div class="col-md-3">
                  <?php echo $message;?>
             </div>
        <?php } ?>
       <div class="col-md-3 text-right">
                <form action="<?php echo site_url('jabatan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('jabatan/index'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
       </div>
    </section>
    <section class="content">
      <div class="box ">
        <div class="box-header with-border">
        	  <h3 class="box-title">Daftar Jabatan</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
          
        </div>

          <div class="box-body">
          	<div class="table-responsive">
             <caption><?php echo anchor('jabatan/forminput','tambah data','class=" btn btn-info"><i class="fa fa-plus"></i');?></caption>
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Pendidikan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($peg_data as $key) { ?>
                  <tr>
                  <td>#</td>
                     <td><?php echo $key->name_jabatan; ?> </td>
                        <td><i class="fa fa-edit"></i><?php echo anchor("jabatan/formupdate/".$key->id, 'Edit','class=" btn btn-info" ') ;?> |
                        <i class="fa fa-remove"></i><?php echo anchor("jabatan/delete/".$key->id, 'Delete','class=" btn btn-warning" ') ;?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
             
              <div class="col-md-6">

                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
      </div>
          	</div>
          </div>
            <div class="box-footer">
            
            </div>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

     </section>
 </div>