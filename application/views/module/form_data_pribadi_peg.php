 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
     <section class="content-body">
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Data Pribadi Pegawai</h3>

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
                              <div class="col-md-2">
                                   <label class="form-control-label">Photo</label>
                                  <image src="<?php echo base_url('doc/images/photos_em');?>/<?php echo $photos;?>" id="photo" width="150" height="150"></image>
                                  <input type="file" name="photos" class="form-control"  onchange="document.getElementById('photo').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                                <div class="col-md-5">
                                  <strong class="text-center"> Data Pribadi</strong>
                                  <div class="form-group">
                                    <label class="form-control-label"> Kartu Identitas / SIM / Paspor*:</label>
                                      <input type="text" name="nik" class="form-control" value="<?php echo $nik; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label class="form-control-label"> Nama Lengkap*:</label>
                                      <input type="text" name="nama" class="form-control" value="<?php echo $nama;?>">
                                  </div>
                                  <div class="form-group">
                                    <label class="form-control-label"> Tempat*:</label>
                                      <input type="text" name="tempat" class="form-control" value="<?php echo $tempat;?>">
                                  </div>
                                  <div class="form-group">
                                    <label class="form-control-label"> Tanggal Lahir*:</label>
                                      <input type="date" name="tanggallahir" class="form-control" value="<?php echo $tanggallahir;?>">
                                  </div>
                                  
                                   <div class="form-group">
                                    <label class="form-control-label">No Kontak*:</label>
                                      <input type="text" name="kontak" class="form-control" value="<?php echo $kontak;?>">
                                      <label>contoh: 089xxxxx</label>
                                  </div>
                                  <div class="form-group">
                                    <label class="form-control-label">No Telephone:</label>
                                      <input type="text" name="kontak1" class="form-control" value="<?php echo $kontak1;?>">
                                      <label>contoh: 089xxxxx</label>
                                  </div>
                                </div>
                               
                                <div class="col-md-5">
                                 <div class="form-group">
                                    <label class="form-control-label">Alamat KTP*:</label>
                                      <textarea name="alamat_KTP" class="form-control textarea" rows="5"> <?php echo $alamat_KTP;?>
                                      </textarea>
                                  </div>
                                  <div class="form-group">
                                    <label class="form-control-label">Alamat Sekarang*:</label>
                                      <textarea name="alamat_sekarang" class="form-control" rows="5">
                                        <?php echo $alamat_sekarang;?>
                                      </textarea>
                                  </div>
                                  </div>
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
  