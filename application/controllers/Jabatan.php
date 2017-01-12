<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Jabatan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->ion_auth->logged_in()){
			redirect('AuthLogin', 'refresh');
		}
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->model(array('jabatan_model'));
	}

	public function index(){
		$q = urldecode($this->input->get('q', TRUE));
       	$start = intval($this->input->get('start'));
       	if ($q <> '') {
            $config['base_url'] = base_url() . 'jabatan/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jabatan/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jabatan/index';
            $config['first_url'] = base_url() . 'jabatan/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->jabatan_model->total_rows($q);
        $peg = $this->jabatan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'peg_data' => $peg,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('module/list_data_jabatan',$this->data);
	}

	public function forminput(){
		$this->data['button'] = 'Save';
		$this->data['aksi'] = 'jabatan/prosesinput';
		$this->data['nama'] = set_value('nama');
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->render_page('module/form_jabatan',$this->data);
	}

	private function _rules(){
		$this->form_validation->set_rules('nama', 'Nama jabatan', 'required');
	}

	public function formupdate($id){
		$row = $this->jabatan_model->get_by_id($id);
		if($row){
			$this->data['aksi'] = 'jabatan/prosesupdate';
			$this->data['button'] = 'update';
			$this->data['nama'] = set_value('nama',$row->name_jabatan);
			$this->data['id'] = set_value('id',$row->id);
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->render_page('module/form_jabatan',$this->data);
		}else{
			 $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/Jabatan'));
		}
	}

	public function prosesinput(){
		//form validasi input
		 $this->_rules();
		 if ($this->form_validation->run() == true){
		 		$ft = $this->input->post(null,true);
		 		$filter = $this->security->xss_clean($ft);
		 		//echo json_encode($filter);
		 		
		 		$cek['name_jabatan'] = $filter['nama'];
		 		$this->db->insert('jabatan',$cek);
		 		$this->session->set_flashdata('message','Data Telah Tersimpan');
		 		redirect('jabatan','refresh');
		 }else{
		 	$this->forminput();
		 }
	}

	public function prosesupdate(){
		$this->_rules();
		 if ($this->form_validation->run() == true){
		 		$ft = $this->input->post(null,true);
		 		$filter = $this->security->xss_clean($ft);
		 		//echo json_encode($filter);
		 		$cek['name_jabatan'] = $filter['nama'];
		 		$this->db->update('jabatan',$cek,array('id'=>$filter['id']));
		 		$this->session->set_flashdata('message','Data Telah Diupdate');
		 		redirect('jabatan','refresh');
		 }else{
		 	$id = $this->input->post('id');
		 	$this->formupdate($id);
		 }
	}

	public function delete($id){
		$delete = $this->jabatan_model->delete($id);
		 $this->session->set_flashdata('message', 'Record is Deleted');
         redirect('jabatan','refresh');
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
}