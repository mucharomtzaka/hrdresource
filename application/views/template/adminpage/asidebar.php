  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
         if($this->ion_auth->is_admin()||$this->ion_auth->is_programmer()){
             echo $menu;
         }   
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>