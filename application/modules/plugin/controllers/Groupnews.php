<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Groupnews extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('AuthLogin', 'refresh');
        $this->load->model(array('plugin/Groupnews_model'));
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'plugin/groupnews/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'plugin/groupnews/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'plugin/groupnews/index';
            $config['first_url'] = base_url() . 'plugin/groupnews/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Groupnews_model->total_rows($q);
        $groupnews = $this->Groupnews_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'groupnews_data' => $groupnews,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('groupnews_list', array_merge($this->data ));
    }

    public function read($id) 
    {
        $row = $this->Groupnews_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'Categories_id' => $row->Categories_id,
		'news_id' => $row->news_id,
	    );
            $this->render_page('groupnews_read',array_merge($this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/groupnews'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('plugin/groupnews/create_action'),
	    'id' => set_value('id'),
	    'Categories_id' => set_value('Categories_id'),
	    'news_id' => set_value('news_id'),
        'list_kate'=>$this->db->get('newscategori')->result(),
        'list_news'=>$this->db->get('news')->result()
	);
        $this->render_page('groupnews_form',array_merge($this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'Categories_id' => $this->input->post('Categories_id',TRUE),
		'news_id' => $this->input->post('news_id',TRUE),
	    );

            $this->Groupnews_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plugin/groupnews'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Groupnews_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('plugin/groupnews/update_action'),
		'id' => set_value('id', $row->id),
		'Categories_id' => set_value('Categories_id', $row->Categories_id),
		'news_id' => set_value('news_id', $row->news_id),
        'list_kate'=>$this->db->get('newscategori')->result(),
        'list_news'=>$this->db->get('news')->result()
	    );
            $this->render_page('groupnews_form',array_merge($this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/groupnews'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'Categories_id' => $this->input->post('Categories_id',TRUE),
		'news_id' => $this->input->post('news_id',TRUE),
	    );

            $this->Groupnews_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plugin/groupnews'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Groupnews_model->get_by_id($id);

        if ($row) {
            $this->Groupnews_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plugin/groupnews'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/groupnews'));
        }
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

    public function _rules() 
    {
	$this->form_validation->set_rules('Categories_id', 'categories id', 'trim|required');
	$this->form_validation->set_rules('news_id', 'news id', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Groupnews.php */
/* Location: ./application/modules/plugin/controllers/Groupnews.php */
/* Please DO NOT modify this information : */

