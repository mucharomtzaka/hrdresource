<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('Adminpage');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
  
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Hrd</b> Information System</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>


      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Control Sidebar Toggle Button -->
          <!-- User Account: style can be found in dropdown.less -->
         <li> <?php echo anchor('/','Home','i class="fa fa-home"></i');?> </li>
          <?php if($this->ion_auth->is_admin()){ ?>
           <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class=" fa fa-list">Sistem</span>
           </a>
                 <ul class="dropdown-menu">
                   <li><a href="<?php echo base_url('settings');?>"> <span class="fa fa-gear"></span>
                  <?php echo lang('link_general');?> </a>
                    <?php if($this->ion_auth->is_programmer()){ ?>
                   <li><a href="<?php echo base_url('plugin');?>"> <span class=" fa fa-eye"></span>
                  <?php echo lang('link_modules');?></a>
                   </li>
                  <?php } ?>
                   <li>
                      <a href="<?php echo base_url('settings/backup');?>"><i class="fa fa-download"></i>Backup DB</a>
                    </li>
                   </ul>
             </li>
             <?php } ?>
             <li><?php echo anchor('Adminpage/profil','Profil','i class="fa fa-users"></i');?></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="fa fa-user"><?php echo $this->session->userdata('email');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-center">
                  <a href="<?php echo base_url('home/change_password');?>" class="btn btn-default btn-warning">Change Password</a>
                </div>
              </li>
            </ul>
          </li>

          <li>
            <a href="<?php echo base_url('AuthLogout');?>"><i class="fa fa-sign-out"><?php echo lang('link_logout');?></i></a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="nav col-md-1 pull-right"> 
    <?php echo lang('link_choose_lang');?>
              <select onchange="javascript:window.location.href='<?php echo base_url(); ?>LanguageSwitcher/switchLang/'+this.value;" class="form-control select">
               <option value="#" disabled=""> ========</option>
              <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
              <option value="indonesian" <?php if($this->session->userdata('site_lang') == 'indonesian') echo 'selected="selected"'; ?>>Indonesia</option>
          </select>
  </div>
  </header>