<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Module extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in())redirect('AuthLogin', 'refresh');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
	}

	public function index($active=''){
		$active = ($active != "") ? $active :1;
		$this->session->set_userdata('active',$active);
        redirect($_SERVER['HTTP_REFERER']);
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

	public function generatorplug(){
		$table_name = safe($_POST['table_name']);
		    $jenis_tabel = safe($_POST['jenis_tabel']);
		   /* $export_excel = safe($_POST['export_excel']);
		    $export_word = safe($_POST['export_word']);
		    $export_pdf = safe($_POST['export_pdf']);*/
		    $controller = safe($_POST['controller']);
		    $model = safe($_POST['model']);
		      if ($table_name <> ''){
		      		$table_name = $table_name;
			        $c = $controller <> '' ? ucfirst($controller) : ucfirst($table_name);
			        $m = $model <> '' ? ucfirst($model) : ucfirst($table_name) . '_model';
			        $v_list = $table_name . "_list";
			        $v_read = $table_name . "_read";
			        $v_form = $table_name . "_form";
			        $v_doc = $table_name . "_doc";
			        $v_pdf = $table_name . "_pdf";
			        // url
			        $c_url = strtolower($c);
			        // filename
			        $c_file = $c . '.php';
			        $m_file = $m . '.php';
			        $v_list_file = $v_list . '.php';
			        $v_read_file = $v_read . '.php';
			        $v_form_file = $v_form . '.php';
			        $v_doc_file = $v_doc . '.php';
			        $v_pdf_file = $v_pdf . '.php';
			        $path = base_url('settingjson.cfg');
					$get_setting = $this->readJSON($path);
					$target = $get_setting->target;
				/*	if (!file_exists($target . "modules/plugin/views/" . $c_url)){
				            mkdir($target . "modules/plugin/views/" . $c_url, 0777, true);
				        }*/
				     $pk = $this->modgen->primary_field($table_name);
			         $non_pk = $this->modgen->not_primary_field($table_name);
			         $all =$this->modgen->all_field($table_name); 
			         $jenis_tabel == 'reguler_table' ? include APPPATH.'includes/create_view_list.php' : include  APPPATH.'includes/create_view_list_datatables.php';
				        include APPPATH.'includes/create_view_form.php';
				        include APPPATH.'includes/create_view_read.php';

						$this->model_modules($target,$m,$m_file,$table_name,$pk,$non_pk,$all);
						$this->controller_modules($target,$c,$m,$c_file,$c_url,$jenis_tabel,$v_list,$v_read,$v_form,$all,$pk,$non_pk);
					  $this->session->set_flashdata('message','modules is created');  
					  redirect('plugin','refresh');
		      }else{
				       // $hasil[] = 'No table selected.';
				         $this->session->set_flashdata('message','No table selected');  
					      redirect('plugin','refresh');
				  }	
   		
	}

	private function readJSON($path){
		 $string = file_get_contents($path);
    	 $obj = json_decode($string);
   		 return $obj;
	}

	private function controller_modules($target,
										$c,$m,$c_file,$c_url,
										$jenis_tabel,$v_list,$v_read,$v_form,$all,$pk,$non_pk){
$string = "<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $c . " extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!\$this->ion_auth->logged_in()) redirect('AuthLogin', 'refresh');
        \$this->checkplugin->index('$c'); 
        \$this->load->model(array('plugin/$m'));
        \$this->load->helper(array('url','language'));
    }";

if ($jenis_tabel == 'reguler_table') {
    
$string .= "\n\n    public function index()
    {
        \$q = urldecode(\$this->input->get('q', TRUE));
        \$start = intval(\$this->input->get('start'));
        
        if (\$q <> '') {
            \$config['base_url'] = base_url() . 'plugin/$c_url/index?q=' . urlencode(\$q);
            \$config['first_url'] = base_url() . 'plugin/$c_url/index?q=' . urlencode(\$q);
        } else {
            \$config['base_url'] = base_url() . 'plugin/$c_url/index';
            \$config['first_url'] = base_url() . 'plugin/$c_url/index';
        }

        \$config['per_page'] = 10;
        \$config['page_query_string'] = TRUE;
        \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);
        \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q);

        \$this->load->library('pagination');
        \$this->pagination->initialize(\$config);

        \$this->data = array(
            '" . $c_url . "_data' => \$$c_url,
            'q' => \$q,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
         \$this->data['message'] = \$this->session->flashdata('message');
        \$this->render_page('$v_list', array_merge(\$this->data ));
    }";

} else {
    
$string .="\n\n    public function index()
    {
        \$$c_url = \$this->" . $m . "->get_all();

        \$this->data = array(
            '" . $c_url . "_data' => \$$c_url
        );

        \$this->render_page('$v_list', array_merge(\$this->data ));
    }";

}
    
$string .= "\n\n    public function read(\$id) 
    {
        \$row = \$this->" . $m . "->get_by_id(\$id);
        if (\$row) {
            \$this->data = array(";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$row->" . $row['column_name'] . ",";
}
$string .= "\n\t    );
            \$this->render_page('$v_read',array_merge(\$this->data ));
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/$c_url'));
        }
    }

    public function create() 
    {
        \$this->data = array(
            'button' => 'Create',
            'action' => site_url('plugin/$c_url/create_action'),";
foreach ($all as $row) {
    $string .= "\n\t    '" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
}
$string .= "\n\t);
        \$this->render_page('$v_form',array_merge(\$this->data ));
    }
    
    public function create_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->create();
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}
$string .= "\n\t    );

            \$this->".$m."->insert(\$data);
            \$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plugin/$c_url'));
        }
    }
    
    public function update(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$this->data = array(
                'button' => 'Update',
                'action' => site_url('plugin/$c_url/update_action'),";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->". $row['column_name']."),";
}
$string .= "\n\t    );
            \$this->render_page('$v_form',array_merge(\$this->data ));
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/$c_url'));
        }
    }
    
    public function update_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->update(\$this->input->post('$pk', TRUE));
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}    
$string .= "\n\t    );

            \$this->".$m."->update(\$this->input->post('$pk', TRUE), \$data);
            \$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plugin/$c_url'));
        }
    }
    
    public function delete(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$this->".$m."->delete(\$id);
            \$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plugin/$c_url'));
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/$c_url'));
        }
    }

    private function render_page(\$view, \$data=null, \$returnhtml=false){
        \$this->viewdata = (empty(\$data)) ? \$this->data: \$data;
        \$view_html = \$this->load->view('template/adminpage/header', \$this->viewdata);
        \$view_html = \$this->load->view('template/adminpage/navbar', \$this->viewdata);
        \$view_html = \$this->load->view(\$view, \$this->viewdata, \$returnhtml);
        \$list = \$this->menu_model->menubar();
		\$this->viewdata['menu'] = \$this->menu_model->create_list(\$list,0);
		\$view_html = \$this->load->view('template/adminpage/asidebar', \$this->viewdata);
        \$view_html = \$this->load->view('template/adminpage/footer', \$this->viewdata);

        if (\$returnhtml) return \$view_html;//This will return html on 3rd argument being true
    }

    public function _rules() 
    {";
foreach ($non_pk as $row) {
    $int = $row3['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
    $string .= "\n\t\$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim|required$int');";
}    
$string .= "\n\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }";


$string .= "\n\n}\n\n/* End of file $c_file */
/* Location: ./application/modules/plugin/controllers/$c_file */
/* Please DO NOT modify this information : */

";
		return $this->createFile($string, $target . "modules/plugin/controllers/" . $c_file);
	}

private function model_modules($target,$m,$m_file,$table_name,$pk,$non_pk,$all){
		$string = "
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class " . $m . " extends CI_Model{

public \$table = '$table_name';
public \$id = '$pk';
public \$order = 'DESC';

	function __construct(){
	  parent::__construct();
	}

// get all
	function get_all(){
	 \$this->db->order_by(\$this->id, \$this->order);
	  return \$this->db->get(\$this->table)->result();
	}

// get data by id
	function get_by_id(\$id){
	\$this->db->where(\$this->id, \$id);
	 return \$this->db->get(\$this->table)->row();
	}
				    
 // get total rows
	function total_rows(\$q = NULL) {
	 			\$this->db->like('$pk', \$q);";
	foreach ($non_pk as $row) {
	$string .= "\n\t\$this->db->or_like('" . $row['column_name'] ."', \$q);";
	}    
	 $string .= "\n\t\$this->db->from(\$this->table);
				 return \$this->db->count_all_results();
	}

 // get data with limit and search
	function get_limit_data(\$limit, \$start = 0, \$q = NULL) {
	\$this->db->order_by(\$this->id, \$this->order);
	\$this->db->like('$pk', \$q);";
	foreach ($non_pk as $row) {
	$string .= "\n\t\$this->db->or_like('" . $row['column_name'] ."', \$q);";
	}    
	$string .= "\n\t\$this->db->limit(\$limit, \$start);
			 return \$this->db->get(\$this->table)->result();
	}

// insert data
	function insert(\$data) {
	\$this->db->insert(\$this->table, \$data);
	}

// update data
	function update(\$id, \$data) {
	 \$this->db->where(\$this->id, \$id);
	 \$this->db->update(\$this->table, \$data);
	 }

// delete data
	function delete(\$id)  {
	\$this->db->where(\$this->id, \$id);
	\$this->db->delete(\$this->table);
	 }
}

				/* End of file $m_file */
				/* Location: ./application/models/$m_file */
				/* Please DO NOT modify this information : */
				";
		return $this->createFile($string, $target."modules/plugin/models/" . $m_file);
	}

	public function createFile($string, $path)
		{
		    $create = fopen($path, "w") or die("Unable to open file!");
		    fwrite($create, $string);
		    fclose($create);
		    
		    return $path;
		}

	private	function safe($str){
		    return strip_tags(trim($str));
			}

}
