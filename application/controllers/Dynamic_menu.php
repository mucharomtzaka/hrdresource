<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dynamic_menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('AuthLogin', 'refresh');
        $this->load->model(array('Dynamic_menu_model'));
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'dynamic_menu/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'dynamic_menu/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'dynamic_menu/index';
            $config['first_url'] = base_url() . 'dynamic_menu/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Dynamic_menu_model->total_rows($q);
        $dynamic_menu = $this->Dynamic_menu_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'dynamic_menu_data' => $dynamic_menu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('dynamic_menu_list', array_merge($this->data ));
    }

    public function read($id) 
    {
        $row = $this->Dynamic_menu_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'parent_id' => $row->parent_id,
		'title' => $row->title,
		'url' => $row->url,
		'menu_order' => $row->menu_order,
		'status' => $row->status,
		'level' => $row->level,
		'icon' => $row->icon,
		'description' => $row->description,
	    );
            $this->render_page('dynamic_menu_read',array_merge($this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dynamic_menu'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('dynamic_menu/create_action'),
	    'id' => set_value('id'),
	    'parent_id' => set_value('parent_id',0),
	    'title' => set_value('title'),
	    'url' => set_value('url'),
	    'menu_order' => set_value('menu_order'),
	    'status' => set_value('status'),
	    'level' => set_value('level'),
	    'icon' => set_value('icon'),
	    'description' => set_value('description'),
        'list_parent_id'=>$this->Dynamic_menu_model->get_all()
	);
        $this->render_page('dynamic_menu_form',array_merge($this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'parent_id' => $this->input->post('parent_id',TRUE),
		'title' => $this->input->post('title',TRUE),
		'url' => $this->input->post('url',TRUE),
		'menu_order' => $this->input->post('menu_order',TRUE),
		'status' => $this->input->post('status',TRUE),
		'level' => $this->input->post('level',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'description' => $this->input->post('description',TRUE),
	    );

            $this->Dynamic_menu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('dynamic_menu/index'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Dynamic_menu_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('dynamic_menu/update_action'),
		'id' => set_value('id', $row->id),
		'parent_id' =>$row->parent_id,
		'title' => set_value('title', $row->title),
		'url' => set_value('url', $row->url),
		'menu_order' => set_value('menu_order', $row->menu_order),
		'status' => set_value('status', $row->status),
		'level' => set_value('level', $row->level),
		'icon' => set_value('icon', $row->icon),
		'description' => set_value('description', $row->description),
        'list_parent_id'=>$this->Dynamic_menu_model->get_all()
	    );
            $this->render_page('dynamic_menu_form',array_merge($this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dynamic_menu/index'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'parent_id' => $this->input->post('parent_id',TRUE),
		'title' => $this->input->post('title',TRUE),
		'url' => $this->input->post('url',TRUE),
		'menu_order' => $this->input->post('menu_order',TRUE),
		'status' => $this->input->post('status',TRUE),
		'level' => $this->input->post('level',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'description' => $this->input->post('description',TRUE),
	    );

            $this->Dynamic_menu_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('dynamic_menu/index'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Dynamic_menu_model->get_by_id($id);

        if ($row) {
            $this->Dynamic_menu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dynamic_menu/index'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dynamic_menu/index'));
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
	$this->form_validation->set_rules('parent_id', 'parent id', 'trim|required');
	$this->form_validation->set_rules('title', 'title', 'trim|required');
	$this->form_validation->set_rules('url', 'url', 'trim|required');
	//$this->form_validation->set_rules('menu_order', 'menu order', 'trim|required');
	//$this->form_validation->set_rules('status', 'status', 'trim|required');
	//$this->form_validation->set_rules('level', 'level', 'trim|required');
	//$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	//$this->form_validation->set_rules('description', 'description', 'trim|required');
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Dynamic_menu.php */
/* Location: ./application/modules/plugin/controllers/Dynamic_menu.php */
/* Please DO NOT modify this information : */

