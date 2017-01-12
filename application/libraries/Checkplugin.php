<?php  defined('BASEPATH') OR exit('No direct script access allowed');
class Checkplugin{
	 protected $CI;
	 public $table = 'Plugin_module';
     public $id = 'id';
     public $modules ='name_modules';
     public $order = 'DESC';

        public function __construct(){
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
        }

	     public function get_by_modules($modules){
			$this->CI->db->where($this->modules, $modules);
	        return $this->CI->db->get($this->table)->row();
		}

		public function index($modules){
			$ws = $this->get_by_modules($modules);
			if($ws->status_modules == 0){
				show_error('Modules Plugin '.$modules.' is Disabled');
			}
		}
}