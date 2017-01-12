<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Log in Human Resources Development</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/ionicons.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/font-awesome.min.css');?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/iCheck/square/blue.css');?>">
</head>
<body class="hold-transition login-page" >
<div class="login-box page-container">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Log in Human Resources Development </p>

   <?php echo form_open('welcome/postgetAuth');?>
      <div class="form-group <?php echo $has_notife;?>">
        <input type="text" class="form-control" placeholder="Email" name="identity">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group <?php echo $has_notife;?>">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> <?php echo lang('login_remember_label');?>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo lang('login_submit_btn');?></button>
        </div>
        <!-- /.col -->
      </div>
   <?php echo form_close();?>
    <!-- /.social-auth-links -->
    <?php echo $message;?>
    <div class="form-group has-error">
     <?php if($notif=='error'){?>
     <label class="control-label">
      <p> jika 3 kali memasukan email dan password Salah , Maka Akun Akan Terkunci Otomotis.</p></label>
    <a href="<?php echo base_url('welcome/forget_password');?>">Bantuan Masuk</a>
   </div>

   <?php }else{ ?>
   <div class="form-group has-error">
   <label class="control-label">
    <a href="<?php echo base_url('welcome/forget_password');?>">Bantuan Masuk</a>
    </div>
   <?php }?>
   <center><?php echo anchor(base_url(),'Halaman Depan');?></center>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('plugins/iCheck/icheck.min.js');?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>