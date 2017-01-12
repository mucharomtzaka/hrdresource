
   <div class="content-wrapper">
   <section class="content">
    <div class="box box-success">
 <div class="box-header with-border">
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
         <div class="box-body form-horizontal">
         <div class="box-title">
            <h2 style="margin-top:0px">Groupnews <?php echo $button ?></h2>
        </div>
     <?php echo form_open($action);?>  
     <div class="box-body">
     <div class="row">
        <div class="col-md-3">
          <div class="form-group">
          <label for="int">Categories Id <?php echo form_error('Categories_id') ?></label>
          <input type="text" class="form-control" name="Categories_id" id="Categories_id" placeholder="Categories Id" value="<?php echo $Categories_id; ?>" />
          </div>
          <div class="form-group">
            <label for="int">News Id <?php echo form_error('news_id') ?></label>
            <input type="text" class="form-control" name="news_id" id="news_id" placeholder="News Id" value="<?php echo $news_id; ?>" />
        </div>
        </div>
        <div class="col-md-5">
        <label for="int">Categories list</label>
            <select name="list_kate"  id="list_kate" class="form-control">
              <?php foreach($list_kate as $rt){?>
                <option value="<?php echo $rt->id ?>"> <?php echo $rt->Categories ?></option>
              <?php } ?>
              </select>
         <label for="int">News list</label>
           <select name="list_news" id="list_news" class="form-control">
              <?php foreach($list_news as $rt){?>
                <option value="<?php echo $rt->id ?>"> <?php echo $rt->title ?></option>
              <?php } ?>
              </select>
        </div>
      </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('plugin/groupnews') ?>" class="btn btn-default"><i class="fa fa-cancel"></i>Cancel</a>
	<?php echo form_close();?>
  </div>
 </div>
   </div>
        </section>
</div>