<div class="content-wrapper">
 <section class="content-header">
              <!-- Default box -->
             <div class="box-header">
             <div class="row">
                <?php if($message){?>
                    <div class="span4 offset4 alert alert-info text-center"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                       <p><?php echo $message;?></p>
                    </div>
                <?php } ?>
                </div>
         	</div>
</section>
<section class="content">
	<div class="box">
		<div class="row">
			<div class="col-md-5">
				<?php echo form_open_multipart($aksi_url) ;?>
				<div class="form-group has-success">
					<label> Username :<input type="text" class="form-control" name="username" value="<?php echo $username;?>"></label><br>
					<label> Email :<input type="text" class="form-control" name="email" value="<?php echo $email;?>"></label><br>
					<label> Firstname :<input type="text" class="form-control" name="first_name" value="<?php echo $first_name;?>"></label><br>
					<label> Lastname :<input type="text" class="form-control" name="last_name" value="<?php echo $last_name;?>"></label><br>
					<label> Phone :<input type="text" class="form-control" name="phone" value="<?php echo $phone;?>"></label><br>
					  <button type="submit" class="btn btn-primary"><?php echo $btn ?></button> 
				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</section>
</div>