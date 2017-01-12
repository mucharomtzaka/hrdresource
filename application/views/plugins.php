  <div class="content-wrapper">
    <!-- Main content -->
		    <section class="content-header">
		      <!-- Default box -->
		     <div class="box-header">
		      	<?php if($message){?>
                    <div class="span4 offset4 alert alert-info text-center"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                       <p><?php echo $message;?></p>
                    </div>
                <?php } ?>
		      	</div>
		    </section>

		     <section class="content-body">
		      <!-- Default box -->
		      <div class="box">
		      	<div class="box-header">
		      	<?php echo anchor('plugin/forminput','Tambah Plugin','class=" btn btn-info"><i class="fa fa-plus"></i');?>
                <?php echo anchor('dynamic_menu/index','Tambah Menu Navigasi','class=" btn btn-info"><i class="fa fa-plus"></i');?></caption>
		      	</div>
		      	<div class="box-body">
		      	 <div class="table-responsive">
			        <table class="table table-bordered table-hover text-center ">
			            <tr>
			                <th>No</th>
							<th>Name Modules</th>
							<th>Status Modules</th>
							<th>Aksi</th>
			            </tr>
			            <?php
			            foreach ($modules as $modules_data)
			            {
			             ?>
			                <tr>
								<td width="80px"><?php echo ++$start ?></td>
								<td><?php echo $modules_data->name_modules ?></td>
								<?php if($modules_data->status_modules =='1'){ ?>
								<td>Enable Register</td>
								<?php }else{?>
								<td> Disable Register</td>
								<?php } ?>
								<td><a href="<?php echo base_url('settings/formpluginedit');?>/<?php echo $modules_data->id;?>" class="btn btn-warning"><i class="fa fa-edit"></i>Update</a> |
                                <a href="<?php echo base_url('settings/formpluginremove');?>/<?php echo $modules_data->id;?>/<?php echo $modules_data->name_modules;?>" class="btn btn-danger"><i class="fa fa-trash"></i>Remove</a> |
                                <?php if($modules_data->status_modules =='1'){ ?>
                                 <a href="<?php echo base_url('settings/disable_plugin/');?><?php echo $modules_data->id;?>" class="btn btn-success"><i class="fa fa-edit"></i>Enable</a></td>
                                <?php }else{?>
                                 <a href="<?php echo base_url('settings/enable_plugin/');?><?php echo $modules_data->id;?>" class="btn btn-info"><i class="fa fa-edit"></i>Disable</a></td>
                                <?php } ?>
                                </td>
						</tr>
			                <?php
			            }
			            ?>
			        </table>
			        </div>
		      	</div>
		      	<div class="box-footer">
		      		<a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		      	<?php echo $pagination ?>
		      	</div>
		      </div>
		    </section>
		    <section class="content">
		    	 <div class="row">
           <div class="col-md-6">
          <fieldset>
            <legend>
              Generate CRUD 
            </legend>
            <?php echo form_open('module/generatorplug');?>
            <div class="form-group">
                        <label>Select Table - <a href="<?php echo $_SERVER['PHP_SELF'] ?>">Refresh</a></label>
                        <select id="table_name" name="table_name" class="form-control" onchange="setname()">
                            <option value="">Please Select</option>
                            <?php
                          /*  $table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';*/
                            foreach ($table_list as $table) {
                                ?>
                               <option value="<?php echo $table;?>"><?php echo $table;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
            <div class="form-group">
                        <div class="row">
                            <?php $jenis_tabel = isset($_POST['jenis_tabel']) ? $_POST['jenis_tabel'] : 'reguler_table'; ?>
                            <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="jenis_tabel" value="reguler_table" <?php echo $jenis_tabel == 'reguler_table' ? 'checked' : ''; ?>>
                                        Reguler Table
                                    </label>
                                </div>                            
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="jenis_tabel" value="datatables" <?php echo $jenis_tabel == 'datatables' ? 'checked' : ''; ?>>
                                        Datatables
                                    </label>
                                </div>
                            </div>
                        </div> -->
                    </div>

                 <!--    <div class="form-group">
                        <div class="checkbox">
                            <?php $export_excel = isset($_POST['export_excel']) ? $_POST['export_excel'] : ''; ?>
                            <label>
                                <input type="checkbox" name="export_excel" value="1" <?php echo $export_excel == '1' ? 'checked' : '' ?>>
                                Export Excel
                            </label>
                        </div>
                    </div>    

                    <div class="form-group">
                        <div class="checkbox">
                            <?php $export_word = isset($_POST['export_word']) ? $_POST['export_word'] : ''; ?>
                            <label>
                                <input type="checkbox" name="export_word" value="1" <?php echo $export_word == '1' ? 'checked' : '' ?>>
                                Export Word
                            </label>
                        </div>
                    </div>  -->   
                     <div class="form-group">
                        <label>Custom Controller Name</label>
                        <input type="text" id="controller" name="controller" value="<?php echo isset($_POST['controller']) ? $_POST['controller'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    <div class="form-group">
                        <label>Custom Model Name</label>
                        <input type="text" id="model" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    <input type="submit" value="Generate" name="generate" class="btn btn-primary" onclick="javascript: return confirm('This will overwrite the existing files. Continue ?')" />
                <?php echo form_close();?>
                <br>

            <!--     <?php
                foreach ($hasil as $h) {
                    echo '<p>' . $h . '</p>';
                }
                ?> -->
          </fieldset>
        </div>
           
              <div class="col-md-6">
               <fieldset>
                <legend>Setting Generate Folder</legend>
                <?php echo form_open('settings/settgenerate');?>
                    <div class="form-group">
                        <label>Target Folder</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="target" checked value="application/" >
                                    application/
                                    </label>
                                </div>                            
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                    <label>
                                        <input type="radio" name="target" value="output/">
                                        output/
                                    </label>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <input type="submit" value="Save" name="save" class="btn btn-primary" />
               <?php echo form_close();?>
                </fieldset>
            </div>
		    </section>
  </div>
  <script type="text/javascript">
            function capitalize(s) {
                return s && s[0].toUpperCase() + s.slice(1);
            }

            function setname() {
                var table_name = document.getElementById('table_name').value.toLowerCase();
                if (table_name != '') {
                    document.getElementById('controller').value = capitalize(table_name);
                    document.getElementById('model').value = capitalize(table_name) + '_model';
                } else {
                    document.getElementById('controller').value = '';
                    document.getElementById('model').value = '';
                }
            }
        </script>