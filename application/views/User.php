<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header">
  <div class="row">
     <div class="col-md-3 text-right">
                <form action="<?php echo site_url('user/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('user/index'); ?>" class="btn btn-default">Reset</a>
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
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
       <?php echo anchor('user/create_user', lang('index_create_user_link'),'class="btn btn-primary"')?> | <?php echo anchor('user/create_group', lang('index_create_group_link'),'class="btn btn-primary"')?>
         <h1><?php echo lang('index_heading');?></h1>
        <p><?php echo lang('index_subheading');?></p>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
       <p color="red"> <?php echo $message;?></p>

        <div class="table-responsive">
         <table class="table table-bordered table-hover " id="mytable" >
         <thead>
            <tr>
          <th>#</th>
            <th><?php echo lang('index_username');?></th>
            <th ><?php echo lang('index_fname_th');?></th>
            <th><?php echo lang('index_lname_th');?></th>
            <th><?php echo lang('index_email_th');?></th>
            <th><?php echo lang('index_groups_th');?></th>
            <th><?php echo lang('index_status_th');?></th>
            <th colspan="2"><?php echo lang('index_action_th');?></th>
          </tr>
         </thead>
         <tbody>
           <?php foreach ($users as $user):?>
            <tr>
                    <td>#</td>
                    <td><?php echo htmlspecialchars($user->username,ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
              <td>
                <?php foreach ($user->groups as $group):?>
                  <?php echo anchor("user/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                        <?php endforeach?>
              </td>
              <td><?php echo ($user->active) ? anchor("user/deactivate/".$user->id, lang('index_active_link')) : anchor("user/activate/". $user->id, lang('index_inactive_link'));?></td>
              <td><i class="fa fa-edit"></i><?php echo anchor("user/edit_user/".$user->id, 'Edit','class=" btn btn-info" ') ;?></td>
               <?php foreach ($user->groups as $group):?>
              <?php if($group->id !='1'&& $group->id !='3'){?>
                   <td><i class="fa fa-remove"></i><?php echo anchor("user/delete_user/".$user->id, 'delete','class="btn btn-warning"') ;?></td>
             <?php }?>
            <?php endforeach?>
            </tr>
          <?php endforeach;?>
         </tbody>
        </table>
         
        <div class="col-md-6">

                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                 <?php if($total_rows == null){?>
                  Record Not Found!
                 <?php } ?>
      </div>
        </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <?php echo $links;?>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->