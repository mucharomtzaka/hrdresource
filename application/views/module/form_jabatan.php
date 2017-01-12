 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content">
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Data Jabatan Pegawai</h3>

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
                          <div class="tab-content">
                             <div role="tabpanel" class="tab-pane active" id="pribadi">
                              <div class="row">
                              <?php if($message){?>
                              <div class="col-md-3">
                                 <?php echo $message;?>
                                 </div>
                                <?php } ?>
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label class="form-control-label"> Name Jabatan*:</label>
                                      <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
                                  </div>
                             </div>
                      <div class="box-footer">
              <?php echo form_submit('submit',$button,'class="btn btn-primary"');?>
               <a href="javascript:history.go(-1);" class="btn btn-warning"><i class="fa fa-arrow-left"> </i> Back</a>
            </div>
        <!-- /.box-footer-->
         <?php echo form_close();?>
          </div>
        </div>
      </section>
  </div>
  <!-- /.content-wrapper -->
  