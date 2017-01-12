<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Navbarplug extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('AuthLogin', 'refresh');
        $this->load->model(array('Navbarplug_model'));
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'navbarplug/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'navbarplug/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'navbarplug/index';
            $config['first_url'] = base_url() . 'navbarplug/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Navbarplug_model->total_rows($q);
        $navbarplug = $this->Navbarplug_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'navbarplug_data' => $navbarplug,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('navbarplug_list', array_merge($this->data ));
    }

    public function read($id) 
    {
        $row = $this->Navbarplug_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id_navbar' => $row->id_navbar,
		'navbar_menu' => $row->navbar_menu,
		'url' => $row->url,
		'icon' => $row->icon,
		'parent_id' => $row->parent_id,
	    );
            $this->render_page('navbarplug_read',array_merge($this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('navbarplug/index'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('navbarplug/create_action'),
	    'id_navbar' => set_value('id_navbar'),
	    'navbar_menu' => set_value('navbar_menu'),
	    'url' => set_value('url'),
	    'icon' => set_value('icon'),
	    'parent_id' => set_value('parent_id'),
        'list_parent_id'=>$this->Navbarplug_model->get_all()
	);
        $this->render_page('navbarplug_form',array_merge($this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'navbar_menu' => $this->input->post('navbar_menu',TRUE),
		'url' => $this->input->post('url',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'parent_id' => $this->input->post('parent_id',TRUE),
	    );

            $this->Navbarplug_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('navbarplug/index'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Navbarplug_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('navbarplug/update_action'),
		'id_navbar' => set_value('id_navbar', $row->id_navbar),
		'navbar_menu' => set_value('navbar_menu', $row->navbar_menu),
		'url' => set_value('url', $row->url),
		'icon' => set_value('icon', $row->icon),
		'parent_id' => set_value('parent_id', $row->parent_id),
        'list_parent_id'=>$this->Navbarplug_model->get_all()
	    );
            $this->render_page('navbarplug_form',array_merge($this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('navbarplug/index'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_navbar', TRUE));
        } else {
            $data = array(
		'navbar_menu' => $this->input->post('navbar_menu',TRUE),
		'url' => $this->input->post('url',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'parent_id' => $this->input->post('parent_id',TRUE),
	    );

            $this->Navbarplug_model->update($this->input->post('id_navbar', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('navbarplug/index'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Navbarplug_model->get_by_id($id);

        if ($row) {
            $this->Navbarplug_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('navbarplug/index'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('navbarplug/index'));
        }
    }

    private function render_page($view, $data=null, $returnhtml=false){
        $this->viewdata = (empty($data)) ? $this->data: $data;
        $view_html = $this->load->view('template/adminpage/header', $this->viewdata);
        $view_html = $this->load->view('template/adminpage/navbar', $this->viewdata);
        $view_html = $this->load->view('module/'.$view, $this->viewdata, $returnhtml);
        $list = $this->menu_model->menubar();
		$this->viewdata['menu'] = $this->menu_model->create_list($list,0);
		$view_html = $this->load->view('template/adminpage/asidebar', $this->viewdata);
        $view_html = $this->load->view('template/adminpage/footer', $this->viewdata);

        if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('navbar_menu', 'navbar menu', 'trim|required');
	$this->form_validation->set_rules('url', 'url', 'trim|required');
	$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	$this->form_validation->set_rules('parent_id', 'parent id', 'trim|required');
	$this->form_validation->set_rules('id_navbar', 'id_navbar', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Navbarplug.php */
/* Location: ./application/modules/controllers/Navbarplug.php */
/* Please DO NOT modify this information : */

