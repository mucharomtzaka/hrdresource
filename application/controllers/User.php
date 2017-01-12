<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public $table = 'users';
    public $id 	  = 'id';
    public $order = 'DESC';

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect('AuthLogin', 'refresh');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language','file'));
		$this->lang->load('auth');
	}


	public function index(){
		
		if (!$this->ion_auth->logged_in()){
			// redirect them to the login page
			redirect('AuthLogin', 'refresh');
		}elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			$this->data = array();
			$this->render_page('notaccess',$this->data);
		}
		else{
			// set the flash data error message if there is one

			 $q = urldecode($this->input->get('q', TRUE));
       		 $start = intval($this->input->get('start'));
	       	if ($q <> '') {
	            $config['base_url'] = base_url() . 'user/index?q=' . urlencode($q);
	            $config['first_url'] = base_url() . 'user/index?q=' . urlencode($q);
	        } else {
	            $config['base_url'] = base_url() . 'user/index';
	            $config['first_url'] = base_url() . 'user/index';
	        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->total_rows($q);
        //$peg = $this->studies_model->get_limit_data($config['per_page'], $start, $q);
        $the_uri_segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config['uri_segment'] = $the_uri_segment;
        $this->load->library('pagination');
        $this->pagination->initialize($config);

	        $this->data = array(
	            'q' => $q,
	            'links' => $this->pagination->create_links(),
	            'total_rows' => $config['total_rows'],
	            'start' => $start,
	        );
	        /*$this->data['users'] = $this->ion_auth->offset($this->uri->segment($the_uri_segment))->limit($config['per_page'])->users()->result();

			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}*/
			 $this->data['users'] =$this->get_limit_data($config['per_page'], $start, $q);
		        foreach($this->data['users'] as $k => $user){
		          $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		        }
	        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		    $this->render_page('User',$this->data);
		   }
	}


	private  function get_limit_data($limit, $start = 0, $q = NULL) {
		         $this->db->order_by($this->id, $this->order);
		     	 $this->db->like('id', $q);
				 $this->db->like('id', $q);
		         $this->db->or_like('username', $q);
		         $this->db->or_like('email', $q);
		         $this->db->or_like('last_name', $q);
		         $this->db->or_like('first_name', $q);
				$this->db->limit($limit, $start);
		        return $this->db->get($this->table)->result();
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

	private function total_rows($q = NULL) {
	    $this->db->like('id', $q);
		$this->db->or_like('username', $q);
		$this->db->from($this->table);
	    return $this->db->count_all_results();
    }


	public function deactivate($id){
		$this->ion_auth_model->deactivate($id);
		$this->session->set_flashdata('message','Account User Information is deactivate');
		redirect("user", 'refresh');
	}

	public function activate($id){
		$this->ion_auth_model->activate($id);
		$this->session->set_flashdata('message','Account User Information is activate');
		redirect("user", 'refresh');
	}


	// create a new user
	public function create_user()
    {
        $this->data['title'] = $this->lang->line('create_user_heading');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('AuthLogin', 'refresh');
        }

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
        if ($this->form_validation->run() == true && $this->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("user", 'refresh');
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

            $this->render_page('Create_user',$this->data);
        }
    }

    public function register($identity, $password, $email, $additional_data = array(), $group_ids = array()) //need to test email activation
	{
		$this->ion_auth_model->trigger_events('pre_account_creation');

		$email_activation = $this->config->item('email_activation', 'ion_auth');

		$id = $this->ion_auth_model->register($identity, $password, $email, $additional_data, $group_ids);

		if (!$email_activation)
		{
			if ($id !== FALSE)
			{
				//$this->set_message('account_creation_successful');
				$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
				return $id;
			}
			else
			{
				//$this->set_error('account_creation_unsuccessful');
				$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
				return FALSE;
			}
		}
		else
		{
			if (!$id)
			{
				//$this->set_error('account_creation_unsuccessful');
				return FALSE;
			}

			// deactivate so the user much follow the activation flow
			$deactivate = $this->ion_auth_model->deactivate($id);

			// the deactivate method call adds a message, here we need to clear that
			$this->ion_auth_model->clear_messages();


			if (!$deactivate)
			{
				//$this->set_error('deactivate_unsuccessful');
				$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
				return FALSE;
			}

			//$activation_code = $this->ion_auth_model->activation_code;
			//$identity        = $this->config->item('identity', 'ion_auth');
			$user           = $this->ion_auth_model->user($id)->row();
			$aktif 			= $this->ion_auth_model->activate($user->id);
			
			return true;
		}
	}


	public function delete_user($id){
		$id = $this->uri->segment(3.0);
		//delete user 
			$delete = $this->db->delete('users',array('id'=>$id));
			$delete = $this->db->delete('users_groups',array('user_id'=>$id));
			if($delete)
				$this->session->set_flashdata('message','Account User Information is Deleted');
				redirect("user", 'refresh');
		}


	// edit a user
	public function edit_user($id)
	{
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('AuthLogin', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}



				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

			// check to see if we are updating the user
			   if($this->ion_auth->update($user->id, $data))
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('user', 'refresh');
					}
					else
					{
						redirect('auth/index', 'refresh');
					}

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('user', 'refresh');
					}
					else
					{
						redirect('user/index', 'refresh');
					}

			    }

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
			 'class' =>'form-control',
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
			 'class' =>'form-control',
		);

		$this->render_page('edit_user',array_merge($this->data));
	}

	// create a new group
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('AuthLogin', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("user", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				 'class' =>'form-control',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				 'class' =>'form-control',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->render_page('create_group', array_merge($this->data));
		}
	}

	public function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('AuthLogin', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('AuthLogin', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("user", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			 'class' =>'form-control',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			 'class' =>'form-control',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->render_page('edit_group', array_merge($this->data));
	}


	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}