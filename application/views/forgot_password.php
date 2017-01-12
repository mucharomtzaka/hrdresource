<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="login-box-body col-md-4">
      <div class="box-body">
      <div class="row">

<h1><?php echo lang('forgot_password_heading');?></h1>
<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

<div id="infoMessage"><?php echo $message;?></div>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Log in SystemMaps</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/ionicons.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/font-awesome.min.css');?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/iCheck/square/blue.css');?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">

<?php echo form_open("welcome/forget_password");?>
 <p>
        <label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
        <?php echo form_input($identity);?>
      </p>
  
    <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?></p>
      <p> <a href="javascript:history.go(-1);" class="btn btn-warning"><i class="fa fa-arrow-left"> </i> Back</a></p>
     
     <?php echo form_close();?>

  <!-- /.content-wrapper -->
</div>
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
</body>
</html>