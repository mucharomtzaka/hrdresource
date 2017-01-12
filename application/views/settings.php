  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
          <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Settings</h3>
                <?php if($message){?>
                    <div class="span4 offset4 alert alert-info text-center"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                       <p><?php echo $message;?></p>
                    </div>
                <?php } ?>
                <!-- /.box-tools -->
              </div>
            </div>

            <div class="box-body">
              <div class="row">
                      <?php echo form_open_multipart('settings/postset');?>
                  <input type="hidden" class="form-control"  name="id" value="<?php echo $id[1];?>">
                  <div class="col-md-5">
                         <div class="form-group has-feedback">
                            <label class="form-control-label">Header Title</label>
                            <input type="text" class="form-control" placeholder="Header Title" name="header_title" value="<?php echo $header_title;?>">
                            <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                          </div>
                         <div class="form-group has-feedback">
                          <label class="form-control-label">Footer Title</label>
                          <input type="text" class="form-control" placeholder="footer Title"  name="footer_title" value="<?php echo $footer_title;?>">
                          <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="form-control-label">Meta Title</label>
                          <textarea name="meta_title" cols="70" rows="5" class="form-control textarea"><?php echo $meta_title;?></textarea>
                          <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                        </div>
                   
                         <div class="form-group has-feedback">
                          <label class="form-control-label">Skin Themes Colors </label>
                          <select name="skinthemes" class="form-control">
                            <option value="<?php echo $themes;?>" selected="Yes"><?php echo $themes;?></option>
                         <option>---Silahkan Pilih---</option>
                          <option value="skin-blue">skin-blue</option>
                          <option value="skin-black">skin-black</option> 
                          <option value="skin-purple">skin-purple</option>
                          <option value="skin-red">skin-red</option>
                          <option value="skin-yellow">skin-yellow</option>
                          <option value="skin-green"> skin-green</option>
                          <option value="skin-blue-light">skin-blue-light</option>
                          <option value="skin-red-light">skin-red-light</option>
                          <option value="skin-black-light">skin-black-light</option>
                          <option value="skin-purple-light">skin-purple-light</option>
                          <option value="skin-yellow-light">skin-yellow-light</option>
                          <option value="skin-green-light">skin-green-light</option>
                          </select>
                          <span class="glyphicon glyphicon-down form-control-feedback"></span>
                        </div>

                          <div class="form-group has-feedback">
                            <label class="form-control-label">Protocol </label>
                            <input type="text" class="form-control" placeholder="default SMTP"  name="smtp_protocol" value="<?php echo $protocol;?>" required>
                            <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                          </div>
                          <div class="form-group has-feedback">
                            <label class="form-control-label">SMTP Host </label>
                            <input type="text" class="form-control" placeholder="SMTP Host"  name="smtp_host" value="<?php echo $smtp_host;?>" required>
                            <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                          </div>
                          <div class="form-group has-feedback">
                            <label class="form-control-label">SMTP User </label>
                            <input type="text" class="form-control" placeholder=" SMTP User"  name="smtp_user" value="<?php echo $smtp_user;?>" required>
                            <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                          </div>
                           <div class="form-group has-feedback">
                            <label class="form-control-label">SMTP Password </label>
                            <input type="password" class="form-control" placeholder="SMTP Password"  name="smtp_password" value="<?php echo $smtp_pass;?>" required>
                            <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                          </div>
                         <div class="form-group has-feedback">
                          <label class="form-control-label">SMTP Port </label>
                          <input type="text" class="form-control" placeholder="default SMTP Port :465"  name="smtp_port" value="<?php echo $smtp_port;?>" required>
                          <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                          <label class="form-control-label">NewLine </label>
                          <input type="text" class="form-control" placeholder="default newline"  name="newline" value='<?php echo $newline_smtp;?>' required>
                          <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                        </div>
                  </div>

                   <div class="col-md-5">
                       <div class="form-group has-feedback">
                        <label class="form-control-label">Name Company</label>
                        <input type="text" class="form-control" placeholder="Name Company"  name="company_title" value="<?php echo $name_company;?>">
                        <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                      </div>
                       <div class="form-group has-feedback">
                        <label class="form-control-label">Address Company</label>
                        <input type="text" class="form-control" placeholder="Address Company"  name="address_title" value="<?php echo $address_company;?>">
                        <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                      </div>
                       <div class="form-group has-feedback">
                        <label class="form-control-label">Contact Company</label>
                        <input type="text" class="form-control" placeholder="contact Company"  name="contact_title" value="<?php echo $contact_company;?>">
                        <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                      </div>
                       <div class="form-group has-feedback">
                        <label class="form-control-label">Company Description</label>
                        <textarea name="profil_title" cols="70" rows="5" class="form-control textarea"><?php echo $name_company_profil_des;?></textarea>
                        <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                      </div>
                         <div class="form-group has-feedback">
                        <image src="<?php echo base_url('doc/images');?>/<?php echo $image_favicon;?>" id="output2" width="150" height="150"></image>
                          <label class="form-control-label">Image Favicon</label>
                          <input type="file" name="Favicon" class="form-control"  onchange="document.getElementById('output2').src = window.URL.createObjectURL(this.files[0])">
                          <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                        </div>
                         <div class="form-group has-feedback">
                           <image src="<?php echo base_url('doc/images');?>/<?php echo $backgrounds;?>" id="output3" width="150" height="150"></image>
                          <label class="form-control-label">Logo Company </label>
                          <input type="file" name="loginback" class="form-control" onchange="document.getElementById('output3').src = window.URL.createObjectURL(this.files[0])">
                          <span class="glyphicon glyphicon-edit form-control-feedback"></span>
                        </div>
                    </div>

              </div>
            </div>
            <div class="box-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-info"><i class="fa fa-delete"></i>Reset</button>
                        <a href="javascript:history.go(-1)" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
            </div>
              <?php echo form_close();?>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --