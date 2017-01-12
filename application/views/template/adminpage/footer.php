</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('plugins/fastclick/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('dist/js/app.min.js');?>"></script>
<script type="text/javascript">
  $(function(){
    $('#listparent').on('change',function(k){
       var e = $('#listparent option:selected').val();
       $('#parent_id').val(e);
    });
    $('#list_news').on('change',function(k){
       var ek = $('#list_news option:selected').val();
       $('#news_id').val(ek);
    });
    $('#list_kate').on('change',function(k){
       var ep = $('#list_kate option:selected').val();
       $('#Categories_id').val(ep);
    });
  });
</script>
</body>
</html>