<?php 

$string = "  <div class=\"content-wrapper\">
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
        <h2 style=\"margin-top:0px\">".ucfirst($table_name)." Read</h2>
        <table class=\"table\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td></td><td><a href=\"<?php echo site_url('plugin/".$c_url."') ?>\" class=\"btn btn-default\">Cancel</a></td></tr>";
$string .= "\n\t</table>
       </div>
   </div>
        </section>
</div>";



$hasil_view_read = $this->createFile($string, $target."modules/plugin/views/" . $v_read_file);

?>