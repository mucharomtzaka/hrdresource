
   <div class="content-wrapper">
   <section class="content">
    <div class="box">
 <div class="box-header with-border">
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
         <div class="box-body">
        <h2 style="margin-top:0px">Navbarplug <?php echo $button ?></h2>
        <div class="col-md-5">
     <?php echo form_open($action);?>
	    <div class="form-group">
            <label for="varchar">Navbar Menu <?php echo form_error('navbar_menu') ?></label>
            <input type="text" class="form-control" name="navbar_menu" id="navbar_menu" placeholder="Navbar Menu" value="<?php echo $navbar_menu; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Url <?php echo form_error('url') ?></label>
            <input type="text" class="form-control" name="url" id="url" placeholder="Url" value="<?php echo $url; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Icon <?php echo form_error('icon') ?></label>
            <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Parent Id <?php echo form_error('parent_id') ?></label>
            <input type="text" class="form-control" name="parent_id" id="parent_id" placeholder="Parent Id" value="<?php echo $parent_id; ?>" />
            <select name="listparent" id="listparent" class="form-control">
            <option value="0">Default(0)</option>
              <?php foreach($list_parent_id as $th){?>
              <option value="<?php echo $th->id_navbar ?>"><?php echo $th->navbar_menu.'('.$th->id_navbar.')' ?></option>
              <?php } ?>
            </select>
        </div>
        </div>
	    <input type="hidden" name="id_navbar" value="<?php echo $id_navbar; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('navbarplug/index') ?>" class="btn btn-default"><i class="fa fa-cancel"></i>Cancel</a>
	<?php echo form_close();?>
 </div>
   </div>
        </section>
</div>