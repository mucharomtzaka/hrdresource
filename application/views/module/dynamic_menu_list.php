
  <div class="content-wrapper">
   <section class="content-header">
              <!-- Default box -->
             <div class="box-header">
                <?php if($message){?>
                    <div class="span4 offset4 alert alert-info text-center"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                       <p><?php echo $message;?></p>
                    </div>
                <?php } ?>
                 <div class="col-md-3 text-right">
                <form action="<?php echo site_url('dynamic_menu/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('dynamic_menu/index'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
                </div>
            </section>
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
        <h2 style="margin-top:0px">Dynamic_menu List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('dynamic_menu/create'),'Create', 'class="btn btn-primary"><i class="fa fa-plus"></i'); ?>
                 <?php echo anchor(site_url('plugin/index'),'Plugin', 'class="btn btn-primary"><i class="fa fa-plus"></i'); ?>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Parent Id</th>
		<th>Title</th>
		<th>Url</th>
		<th>Menu Id</th>
		<th>Status</th>
		<th>Level</th>
		<th>Icon</th>
		<th>Description</th>
    <th>Order</th>
		<th>Action</th>
            </tr><?php
            foreach ($dynamic_menu_data as $dynamic_menu)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $dynamic_menu->parent_id ?></td>
			<td><?php echo $dynamic_menu->title ?></td>
			<td><?php echo $dynamic_menu->url ?></td>
			<td><?php echo $dynamic_menu->id ?></td>
			<td><?php echo $dynamic_menu->status ?></td>
			<td><?php echo $dynamic_menu->level ?></td>
			<td><i class="<?php echo $dynamic_menu->icon ?>"></i></td>
			<td><?php echo $dynamic_menu->description ?></td>
      <td><?php echo $dynamic_menu->menu_order ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('dynamic_menu/read/'.$dynamic_menu->id),'Read',' class="btn btn-default"><i class="fa fa-eye"></i'); 
				echo ' | '; 
				echo anchor(site_url('dynamic_menu/update/'.$dynamic_menu->id),'Update','class="btn btn-warning"><i class="fa fa-edit"></i'); 
				echo ' | '; 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
   </div>
   </div>
        </section>
</div> 