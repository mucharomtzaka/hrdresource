<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('AuthLogin', 'refresh');
		}elseif($this->ion_auth->is_admin()){
			redirect('Adminpage', 'refresh');
		}
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
				$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language','file'));
		$this->lang->load('auth');
	}

	public function index($param=null){
		if($param==''&& $param =='welcome' || $param=='mode')
		$this->data['message'] = $param;
		$this->data['message'] = $this->session->flashdata('message');
		$this->render_page('HalamanUtama',$this->data);
	}

	private function render_page($view, $data=null, $returnhtml=false){
		$this->viewdata = (empty($data)) ? $this->data: $data;
		$list = $this->navbarplug_model->menubar();
		$this->viewdata['menu'] = $this->navbarplug_model->create_list($list,0);
		$pengaturan = $this->settings_model->index();
		$this->viewdata['header_title'] = $pengaturan['header_title'];
		$this->viewdata['footer_title'] = $pengaturan['footer_title'];
		$this->viewdata['skin_color']   = $pengaturan['themes'];
		$view_html = $this->load->view('template/userpage/header', $this->viewdata);
		$view_html = $this->load->view('template/userpage/navbar', $this->viewdata);
		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);
		$view_html = $this->load->view('template/adminpage/asidebar', $this->viewdata);
		$view_html = $this->load->view('template/userpage/asidebar', $this->viewdata);
		$view_html = $this->load->view('template/userpage/footer', $this->viewdata);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name'    => 'new',
				'id'      => 'new',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name'    => 'new_confirm',
				'id'      => 'new_confirm',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->render_page('change_password_user_pelamar', array_merge($this->data));
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('AuthLogout');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('Employee/change_password', 'refresh');
			}
		}
	}

	
    
}