<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Settings extends CI_Controller {
	public $id = 'id';
	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()||!$this->ion_auth->is_programmer()) redirect('AuthLogin', 'refresh');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->database();
		$this->load->dbutil();
		$this->load->helper('file');
		$this->pengaturan = $this->settings_model->index();
		$this->emailset  = $this->settings_model->emailset();
	}

	public function index(){
		$this->data['message'] =$this->session->flashdata('message');
		$this->render_page('settings',array_merge_recursive($this->emailset,$this->data,$this->pengaturan));
	}

	private function render_page($view, $data=null, $returnhtml=false){
		$this->viewdata = (empty($data)) ? $this->data: $data;
		$view_html = $this->load->view('template/adminpage/header', $this->viewdata);
		$view_html = $this->load->view('template/adminpage/navbar', $this->viewdata);
		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);
		$list = $this->menu_model->menubar();
		$this->viewdata['menu'] = $this->menu_model->create_list($list,0);
		$view_html = $this->load->view('template/adminpage/asidebar', $this->viewdata);
		$view_html = $this->load->view('template/adminpage/footer', $this->viewdata);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

	public function  postset(){
		$var_input = $this->input->post(null,true);
			$filter = $this->security->xss_clean($var_input);
			$arraylistdata = array();
			$arraylistdata['id'] = $filter['id'];
			$arraylistdata['header_title'] = $filter['header_title'];
			$arraylistdata['footer_title'] = $filter['footer_title'];
			$arraylistdata['meta_title'] = $filter['meta_title'];
			$arraylistdata['themes'] = $filter['skinthemes'];
			$arraylistdata['name_company'] = $filter['company_title'];
			$arraylistdata['address_company'] = $filter['address_title'];
			$arraylistdata['contact_company'] = $filter['contact_title'];
			$arraylistdata['name_company_profil_des'] = $filter['profil_title'];

			  if ($_FILES['Favicon']['name']!='')
	             {
	               	$logo = $_FILES['Favicon']['name'];
	                $direktori = './doc/images/'; //Folder penyimpanan file
	                //$max_size  = 1000000*10; //Ukuran file maximal 10mb
	                 $nama_file =  $logo ; //Nama file yang akan di Upload
	               // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
	                 $nama_tmp  = $_FILES['Favicon']['tmp_name']; //Nama file sementara
	                 $upload = $direktori . $nama_file;
	                 $dt = $this->db->get_where('settings',array('id'=>1))->row();
	                 $file ='./doc/images/'.$dt->logo;
	                    if(file_exists($file)){
	                        unlink($file);
	                    }
	                 move_uploaded_file($nama_tmp, $upload);
	                 $arraylistdata['image_favicon'] =$logo;
	               }

	               if ($_FILES['loginback']['name']!='') {
	               	# code...
	               	$logo2 = $_FILES['loginback']['name'];
	                $direktori = './doc/images//'; //Folder penyimpanan file
	                //$max_size  = 1000000*10; //Ukuran file maximal 10mb
	                 $nama_file =  $logo2 ; //Nama file yang akan di Upload
	               // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
	                 $nama_tmp  = $_FILES['loginback']['tmp_name']; //Nama file sementara
	                 $upload = $direktori . $nama_file;
	                 $dt = $this->db->get_where('settings',array('id'=>1))->row();
	                 $file ='./doc/images/'.$dt->logo;
	                    if(file_exists($file)){
	                        unlink($file);
	                    }
	                 move_uploaded_file($nama_tmp, $upload);
	                 $arraylistdata['backgrounds'] =$logo2;
	               }
        
		            
					$this->settings_model->save($arraylistdata);


					$listdata['id'] = $filter['id'];
		            $listdata['protocol'] = $filter['smtp_protocol'];
		            $listdata['smtp_host'] = $filter['smtp_host'];
		            $listdata['smtp_user'] = $filter['smtp_user'];
		            $listdata['smtp_pass'] = $filter['smtp_password'];
		            $listdata['smtp_port'] = $filter['smtp_port'];
		            $listdata['newline_smtp'] = $filter['newline'];

					$this->settings_model->saveemail($listdata);
$string ="<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
| http://ellislab.com/codeigniter/user-guide/libraries/email.html
|
*/
\$config['mailtype'] = 'html';
\$config['protocol']='".$this->emailset['protocol']."';
\$config['smtp_host']='".$this->emailset['smtp_host'].".'; //(SMTP server)
\$config['smtp_port']='".$this->emailset['smtp_port']."'; //(SMTP port)
\$config['smtp_timeout']='30';
\$config['smtp_user']='".$this->emailset['smtp_user']."'; //(user@gmail.com)
\$config['smtp_pass']='".$this->emailset['smtp_pass']."'; // (gmail password)
\$config['charset'] = 'utf-8';
\$config['newline'] = ".$this->emailset['newline_smtp'].";


/* End of file email.php */
/* Location: ./application/config/email.php */";
					$target = 'application/';
					$this->createFile($string, $target."config/email.php");

					/*$filemail = $target."config/email.php";
					if(file_exists($filemail)){
						unlink($filemail);
					}*/

			$this->session->set_flashdata('message','Setting is update information');
			redirect('settings','refresh');
					//echo json_encode($filter);
	}

	public function createFile($string, $path)
		{
		    $create = fopen($path, "w") or die("Unable to open file!");
		    fwrite($create, $string);
		    fclose($create);
		    
		    return $path;
		}

   public function make_plugins(){
   	 $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'plugins/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'plugins/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'plugins/index';
            $config['first_url'] = base_url() . 'plugins/index';
        }

        $config['per_page'] = 5;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->_total_rows($q);
        $modules = $this->_get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'modules' => $modules,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
   	 $this->data['message'] =$this->session->flashdata('message');
   	 $this->data['table_list'] = $this->db->list_tables();
   	 $this->render_page('plugins',$this->data);
   }

    private function _get_limit_data($limit, $start = 0, $q = NULL) {
		   	$this->table = 'plugin_module'; 
		   	$order = 'DESC';
		    $this->db->order_by($this->id, $this->order);
		    $this->db->like('id', $q);
			$this->db->or_like('name_modules', $q);
			$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    private function _total_rows($q = NULL) {
       		$this->table = 'plugin_module'; 
    		$order = 'DESC';
		    $this->db->order_by($this->id, $this->order);
		    $this->db->like('id', $q);
			$this->db->or_like('name_modules', $q);
			$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_by_id($id)
    {

    	$this->table = 'plugin_module'; 
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_menu_id($menu){
    	$this->table = 'dynamic_menu'; 
        $this->db->where('title', $menu);
        return $this->db->get($this->table)->row();
    }

    public function formplugin(){
    	$this->data['button'] = 'Save';
		$this->data['aksi'] = 'settings/forminputproses';
		$this->data['nama_plugin'] = set_value('nama_plugin');
		$this->data['nama_menu'] = set_value('nama_menu');
		$this->data['nama_url'] = set_value('nama_url');
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->render_page('form_plugin',$this->data);
    }

   public function forminputproses(){
     $this->_rules();
      if ($this->form_validation->run() == true){
		 		$ft = $this->input->post(null,true);
		 		$filter = $this->security->xss_clean($ft);
		 		if($filter['nama_plugin'] <> $filter['nama_menu']){
			 		$this->session->set_flashdata('message','nama modules harus sama dengan nama menu!');
					redirect('plugin/forminput','refresh');
		 		}
		 		$gh = array('name_modules'=>$filter['nama_plugin'],
		 					'status_modules'=>0,'plug_id_dynamic_menu'=>19
		 					);
		 		$h  = array('title'=>$filter['nama_menu'],'url'=>'plugin/'.$filter['nama_url'].'','parent_id'=>19);
		 		$this->db->insert('dynamic_menu',$h);
		 		$this->db->insert('plugin_module',$gh);
		 		$this->session->set_flashdata('message','Plugin modules is add');
				redirect('plugin','refresh');
		 }else{
		 	$this->formplugin();
		 }
   }

   public function formupdateproses(){
     $this->_rules();
      	if ($this->form_validation->run() == true){
		 		$ft = $this->input->post(null,true);
		 		$filter = $this->security->xss_clean($ft);
		 		$cek['name_modules'] = $filter['nama_plugin'];
		 		$this->db->update('plugin_module',$cek,array('id'=>$filter['id']));
		 		$r['title'] = $filter['nama_menu'];
		 		$r['url'] = $filter['nama_url'];
		 		$this->db->update('dynamic_menu',$r,array('id'=>$filter['idmenu']));
		 		$this->session->set_flashdata('message','Plugin modules is update');
				redirect('plugin','refresh');
		 }else{
		 	$id = $this->input->post('id');
		 	$this->formpluginedit($id);
		 }
   }

   public function enable_plugin($id){
	   	$this->table ='plugin_module';
	   	$this->db->update($this->table,array('status_modules'=>1),array('id'=>$id));
	   	$this->session->set_flashdata('message','Plugin modules is enabled');
		redirect('plugin','refresh');
   }

   public function disable_plugin($id){
	   	$this->table ='plugin_module';
	   	$this->db->update($this->table,array('status_modules'=>0),array('id'=>$id));
	   	$this->session->set_flashdata('message','Plugin modules is disabled');
		redirect('plugin','refresh');
   }

   public function formpluginremove($id,$title){
   	    $titled = strtolower($title);
   		$target = './application/modules/plugin';
   		$path_controller = $target.'/controllers/'.$title.'.php';
   		$path_model      = $target.'/models/'.$title.'_model.php';
   		$path_view_form  = $target.'/views/'.$titled.'_form.php';
   		$path_view_read  = $target.'/views/'.$titled.'_read.php';
   		$path_view_list  = $target.'/views/'.$titled.'_list.php';
   		 $t = octal_permissions(fileperms($path_controller));
   		if(!@unlink($path_controller)||!@unlink($path_model)||!@unlink($path_view_list)||!@unlink($path_view_read)||!@unlink($path_view_form)){
   			$this->session->set_flashdata('message','Plugin modules is not deleted check premission =>'.$path_controller.$t.' ');
			redirect('plugin','refresh');
   		}else{
   			$this->db->delete('plugin_module',array('id'=>$id));
   			$this->db->delete('dynamic_menu',array('title'=>$title,'parent_id'=>19));
  			@unlink($path_controller);
  			@unlink($path_model);
  			@unlink($path_view_list);
  			@unlink($path_view_read);
  			@unlink($path_view_form);
	   		$this->session->set_flashdata('message','Plugin modules is deleted');
			redirect('plugin','refresh');
   		}
   }

   public function formpluginedit($id){
   		$row = $this->get_by_id($id);
   		$menu = $row->name_modules;
   		$t = $this->get_by_menu_id($menu);
   		if($row){
   			$this->data['button'] = 'update';
			$this->data['aksi'] = 'settings/formupdateproses';
			$this->data['id'] =set_value('id',$row->id);
			$this->data['nama_plugin'] = set_value('nama_plugin',$row->name_modules);
			$this->data['idmenu'] = set_value('idmenu',$t->id);
			$this->data['nama_menu'] = set_value('nama_menu',$t->title);
			$this->data['nama_url'] = set_value('nama_url',$t->url);
			$this->data['back'] = ' <a href="javascript:history.go(-1);" class="btn btn-warning"><i class="fa fa-arrow-left"> </i> Back</a>';
   		}
    	
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->render_page('form_plugin',$this->data);
    }


    public function backup($nama_file=''){
			    
                $nama_file  = 'hrd_db'.date('Y-m-d');
                $prefs = array(
                        'tables'      => array(),  // Array of tables to backup.
                        'ignore'      => array(),           // List of tables to omit from the backup
                        'format'      => 'txt',             // gzip, zip, txt
                        'filename'    => $nama_file.'.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                        'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                        'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                        'newline'     => "\n"               // Newline character used in backup file
                      );

                // Backup your entire database and assign it to a variable
                $backup =& $this->dbutil->backup($prefs);
                // Load the file helper and write the file to your server
               $file = write_file('./doc/database/'.$nama_file.'.sql', $backup); 
               if(file_exists($file)){
                  unlink($file);
               }
                // Load the download helper and send the file to your desktop
                //$this->load->helper('download');
                $download = '<a href="'.base_url().'/doc/database/'.$nama_file.'.sql">Silahkan Unduh File ini!</a>';
				$this->session->set_flashdata('message','success backup database '.$nama_file.' is create '.$download.'');
		   		redirect('settings','refresh');
		}


   public function _rules(){
		$this->form_validation->set_rules('nama_plugin', 'Nama Plugin Modules', 'required');
		$this->form_validation->set_rules('nama_menu', 'Nama  Menu Plugin Modules', 'required');
		$this->form_validation->set_rules('nama_url', 'Alamat Url Plugin', 'required');
	}


	public function settgenerate(){
		$path = base_url('settingjson.cfg');
		$get_setting = $this->readJSON($path);

		if (isset($_POST['save'])) {
			    $target = $_POST['target'];
			    $string = '{
							"target": "' . $target . '",
							"copyassets": "0"
							}';
			}
    $hasil_setting = $this->createFile($string, 'settingjson.cfg');
   	$this->session->set_flashdata('message','Setting Updated');
   	redirect('plugin','refresh');

	}

	private function readJSON($path){
		 $string = file_get_contents($path);
    	 $obj = json_decode($string);
   		 return $obj;
	}


	
}
