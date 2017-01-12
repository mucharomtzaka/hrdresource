<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}

	
	public function index()
	{
		$q = urldecode($this->input->get('q', TRUE));
       	$start = intval($this->input->get('start'));
       if ($q <> '') {
            $config['base_url'] = base_url() . 'news?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'news?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'news';
            $config['first_url'] = base_url() . 'news';
        }

       	$config['per_page'] = '5';
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->total_rows_news($q);
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $this->data['title'] = '';
        $this->data['total_rows'] = $config['total_rows'];
        $this->data['news_update'] = $this->get_limit_data($config['per_page'],$start,$q);
        $this->data['news_later'] = $this->get_limit_data_latest($config['per_page'],$start);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['q'] = $q;
		$this->data['message'] = $this->session->flashdata('message');
		$this->render_page('welcome_message',$this->data);
	}

	public function view($slug = NULL){
		$q = str_replace("-"," ",$slug);
        $this->data['news_item'] = $this->get_news($q);
        if (empty($this->data['news_item']))
        {
                show_404();
        }
        $this->data['title'] = $data['news_item']['title'];
        $this->render_page('blog',$this->data);
 	}

 	 private function total_rows_news($q = NULL,$table='news') {
	    $this->db->like('id', $q);
		$this->db->or_like('slug', $q);
		$this->db->from($table);
	     return $this->db->count_all_results();
    }

    private  function get_limit_data($limit, $start = 0, $q = NULL) {
	       		$this->db->order_by('id','DESC');
		        $this->db->like('id', $q);
		        $this->db->or_like('slug',$q);
		        $this->db->limit($limit, $start);
                return $this->db->get('news')->result_array();
    }

     private  function get_limit_data_latest($limit, $start = 0) {
	       		$this->db->order_by('id','ASC');
		        $this->db->like('id', $q);
		        $this->db->or_like('slug',$q);
		        $this->db->limit($limit, $start);
                return $this->db->get('news')->result_array();
    }

	private function get_news($slug = FALSE){
        if ($slug === FALSE)
        { 
                return $this->db->get('news')->result_array();
        }

        $q = str_replace("-"," ",$slug);
    
        return  $this->db->get_where('news',array('slug'=>$q))->row_array();
	}

	public function auth($message=null){
		if ($this->ion_auth->logged_in()){
			$this->session->set_flashdata('message','Anda Masih Dalam Mode Login');
			redirect('Adminpage', 'refresh');
		}else{

			if($message =='error'?$message:'')
				{
					$this->data['notif'] = $message;
					
				}else{
					$this->data['notif'] = '';
				}
		$this->data['message'] = (validation_errors()) ? 
									validation_errors() : $this->session->flashdata('message');
		$this->data['has_notife'] = 'has-feedback';
		$this->load->view('login',$this->data);	
		} 
		
	}

	public function postgetAuth(){
		$this->data['title'] = $this->lang->line('login_heading');
		//validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page

				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->dashboard();
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('welcome/auth/error', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);
			$this->data['has_notife'] = 'has-error';
			$this->data['notif'] ='';
			$this->load->view('login',$this->data);
		}
	}


	public function logout($param=null,$notif=null)
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		if($param=='timeout'){
			$notif.='<div class="span4 offset4 alert 
			alert-warning text-center"><button type="button" class="close" data-dismiss="alert">
			<i class="fa fa-times"></i></button>Waktu Session Telah Habis Silahkan login kembali</div>';
			$this->session->set_flashdata('message',$notif);
			redirect('auth/login/timeout', 'refresh');
		}else{
			$this->session->set_flashdata('message', $this->ion_auth->messages());
		}
		redirect('welcome/auth', 'refresh');
	}

	public function dashboard(){
		if($this->ion_auth->is_admin()){
			redirect('Adminpage', 'refresh');
		}elseif ($this->ion_auth->is_programmer()) {
			redirect('Adminpage/programmer', 'refresh');
		}else{
			redirect('/', 'refresh');
		}	
	}

	// forgot password
	public function forget_password()
	{
		// setting validation rules by checking whether identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email' )
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			$this->data['type'] = $this->config->item('identity','ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity','class'=>'form-control'
			);

			if ( $this->config->item('identity', 'ion_auth') != 'email' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->load->view('forgot_password', array_merge($this->data));
		}
		else
		{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if(empty($identity)) {

	            		if($this->config->item('identity', 'ion_auth') != 'email')
		            	{
		            		$this->ion_auth->set_error('forgot_password_identity_not_found');
		            	}
		            	else
		            	{
		            	   $this->ion_auth->set_error('forgot_password_email_not_found');
		            	}

		                $this->session->set_flashdata('message', $this->ion_auth->errors());
                		redirect("welcome/forget_password", 'refresh');
            		}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("AuthLogin", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("welcome/forget_password", 'refresh');
			}
		}
	}

	private function render_page($view, $data=null, $returnhtml=false){
		$this->viewdata = (empty($data)) ? $this->data: $data;
		$list = $this->navbarplug_model->menubar();
		$pengaturan = $this->settings_model->index();
		$this->viewdata['header_title'] = $pengaturan['header_title'];
		$this->viewdata['footer_title'] = $pengaturan['footer_title'];
		$this->viewdata['skin_color']   = $pengaturan['themes'];
		$this->viewdata['menu'] = $this->navbarplug_model->create_list($list,0);
		$view_html = $this->load->view('template/index/header', $this->viewdata);
		$view_html = $this->load->view('template/index/navbar', $this->viewdata);
		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);
		$view_html = $this->load->view('template/index/asidebar', $this->viewdata);
		$view_html = $this->load->view('template/index/footer', $this->viewdata);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

	public  function register(){
		 $this->data['title'] = 'Register New User';
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("welcome/register", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'class' =>'form-control',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name'  => 'company',
                'id'    => 'company',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                 'class' =>'form-control',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->render_page('register',array_merge($this->data));
        }
 	}

	
}
