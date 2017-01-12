
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
        <h2 style="margin-top:0px">Dynamic_menu <?php echo $button ?></h2>
        <div class="col-md-5">
     <?php echo form_open($action);?>
	    <div class="form-group">
            <label for="tinyint">Parent Id <?php echo form_error('parent_id') ?></label>
         <input type="text" name="parent_id" id="parent_id" placeholder="Parent Id" value="<?php echo $parent_id; ?>"/ readonly >
            <select name="listparent" id="listparent" class="form-control">
            <option value="0">Default(0)</option>
              <?php foreach($list_parent_id as $th){?>
              <option value="<?php echo $th->id ?>"><?php echo $th->title.'('.$th->id.')' ?></option>
              <?php } ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Title <?php echo form_error('title') ?></label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $title; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Url <?php echo form_error('url') ?></label>
            <input type="text" class="form-control" name="url" id="url" placeholder="Url" value="<?php echo $url; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Menu Order <?php echo form_error('menu_order') ?></label>
            <input type="text" class="form-control" name="menu_order" id="menu_order" placeholder="Menu Order" value="<?php echo $menu_order; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Level <?php echo form_error('level') ?></label>
            <input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Icon <?php echo form_error('icon') ?></label>
            <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Description <?php echo form_error('description') ?></label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $description; ?>" />
        </div>
      </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('dynamic_menu/index') ?>" class="btn btn-default">Cancel</a>
	<?php echo form_close();?>
 </div>
   </div>
        </section>
</div>