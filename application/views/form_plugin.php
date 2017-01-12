 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
     <section class="content-body">
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title">Form Plugin </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>

        </div>
          <div class="box-body">
              <?php echo form_open_multipart($aksi);?>
              <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
              <input type="hidden" name="idmenu" value="<?php echo $idmenu; ?>" /> 
                          <div class="tab-content">
                             <div role="tabpanel" class="tab-pane active" id="pribadi">
                              <div class="row">
                             
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label class="form-control-label">Nama Modules*:</label>
                                      <input type="text" name="nama_plugin" class="form-control" value="<?php echo $nama_plugin; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label class="form-control-label">Nama Menu plugin*:</label>
                                      <input type="text" name="nama_menu" class="form-control" value="<?php echo $nama_menu; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label class="form-control-label">URL*:</label>
                                      <input type="text" name="nama_url" class="form-control" value="<?php echo $nama_url; ?>">
                                  </div>
                                </div>
                               
                                <?php if($message){?>
                               <div class="col-md-3">
                                      <?php echo $message;?>
                                </div>
                               <?php } ?>
                                </div>
                             </div>
                      <div class="box-footer">
              <?php echo form_submit('submit',$button,'class="btn btn-primary"');?>
              <?php echo $back;?>
            </div>
        <!-- /.box-footer-->
         <?php echo form_close();?>
          </div>
        </div>
      </section>
  </div>
  <!-- /.content-wrapper -->
  