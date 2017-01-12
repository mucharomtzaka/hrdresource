<?php 

$string = "
  <div class=\"content-wrapper\">
   <section class=\"content\">
    <div class=\"box\">
 <div class=\"box-header with-border\">
          <div class=\"box-tools pull-right\">
            <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\" data-toggle=\"tooltip\" title=\"Collapse\">
              <i class=\"fa fa-minus\"></i></button>
            <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"remove\" data-toggle=\"tooltip\" title=\"Remove\">
              <i class=\"fa fa-times\"></i></button>
          </div>
        </div>
         <div class=\"box-body\">
        <h2 style=\"margin-top:0px\">".ucfirst($table_name)." List</h2>
        <div class=\"row\" style=\"margin-bottom: 10px\">
            <div class=\"col-md-4\">
                <?php echo anchor(site_url('plugin/".$c_url."/create'),'Create', 'class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i'); ?>
            </div>
            <div class=\"col-md-4 text-center\">
                <div style=\"margin-top: 8px\" id=\"message\">
                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class=\"col-md-3 text-right\">
                <form action=\"<?php echo site_url('plugin/$c_url/index'); ?>\" class=\"form-inline\" method=\"get\">
                    <div class=\"input-group\">
                        <input type=\"text\" class=\"form-control\" name=\"q\" value=\"<?php echo \$q; ?>\">
                        <span class=\"input-group-btn\">
                            <?php 
                                if (\$q <> '')
                                {
                                    ?>
                                    <a href=\"<?php echo site_url('plugin/$c_url'); ?>\" class=\"btn btn-default\">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class=\"btn btn-primary\" type=\"submit\">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class=\"table-responsive\">
        <table class=\"table table-bordered\" style=\"margin-bottom: 10px\">
            <tr>
                <th>No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t<th>Action</th>
            </tr>";
$string .= "<?php
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";

$string .= "\n\t\t\t<td width=\"80px\"><?php echo ++\$start ?></td>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}


$string .= "\n\t\t\t<td style=\"text-align:center\">"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('plugin/".$c_url."/read/'.$".$c_url."->".$pk."),'Read',' class=\"btn btn-default\"><i class=\"fa fa-eye\"></i'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('plugin/".$c_url."/update/'.$".$c_url."->".$pk."),'Update','class=\"btn btn-warning\"><i class=\"fa fa-edit\"></i'); "
        . "\n\t\t\t\techo ' | '; "
        . "\n\t\t\t\techo anchor(site_url('plugin/".$c_url."/delete/'.$".$c_url."->".$pk."),'Delete','onclick=\"javasciprt: return confirm(\\'Are You Sure  to Delete ?\\')\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</td>";

$string .=  "\n\t\t</tr>
                <?php
            }
            ?>
        </table>
        </div>
        <div class=\"row\">
            <div class=\"col-md-6\">
                <a href=\"#\" class=\"btn btn-primary\">Total Record : <?php echo \$total_rows ?></a>";
$string .= "\n\t    </div>
            <div class=\"col-md-6 text-right\">
                <?php echo \$pagination ?>
            </div>
        </div>
   </div>
   </div>
        </section>
</div> ";


$hasil_view_list = $this->createFile($string, $target."modules/plugin/views/" . $v_list_file);

?>