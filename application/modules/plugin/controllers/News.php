<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) redirect('AuthLogin', 'refresh');
        $this->load->model(array('plugin/News_model'));
        $this->load->helper(array('url','language'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'plugin/news/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'plugin/news/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'plugin/news/index';
            $config['first_url'] = base_url() . 'plugin/news/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->News_model->total_rows($q);
        $news = $this->News_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->data = array(
            'news_data' => $news,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->data['message'] = $this->session->flashdata('message');
        $this->render_page('news_list', array_merge($this->data ));
    }

    public function read($id) 
    {
        $row = $this->News_model->get_by_id($id);
        if ($row) {
            $this->data = array(
		'id' => $row->id,
		'title' => $row->title,
		'slug' => $row->slug,
		'text' => $row->text,
	    );
            $this->render_page('news_read',array_merge($this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/news'));
        }
    }

    public function create() 
    {
        $this->data = array(
            'button' => 'Create',
            'action' => site_url('plugin/news/create_action'),
	    'id' => set_value('id'),
	    'title' => set_value('title'),
	    'slug' => set_value('slug'),
	    'text' => set_value('text'),
	);
        $this->render_page('news_form',array_merge($this->data ));
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'title' => $this->input->post('title',TRUE),
		'slug' => $this->input->post('slug',TRUE),
		'text' => $this->input->post('text',TRUE),
	    );

            $this->News_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('plugin/news'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->News_model->get_by_id($id);

        if ($row) {
            $this->data = array(
                'button' => 'Update',
                'action' => site_url('plugin/news/update_action'),
		'id' => set_value('id', $row->id),
		'title' => set_value('title', $row->title),
		'slug' => set_value('slug', $row->slug),
		'text' => set_value('text', $row->text),
	    );
            $this->render_page('news_form',array_merge($this->data ));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/news'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'title' => $this->input->post('title',TRUE),
		'slug' => $this->input->post('slug',TRUE),
		'text' => $this->input->post('text',TRUE),
	    );

            $this->News_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('plugin/news'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->News_model->get_by_id($id);

        if ($row) {
            $this->News_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('plugin/news'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('plugin/news'));
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
	$this->form_validation->set_rules('title', 'title', 'trim|required');
	$this->form_validation->set_rules('slug', 'slug', 'trim|required');
	$this->form_validation->set_rules('text', 'text', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file News.php */
/* Location: ./application/modules/plugin/controllers/News.php */
/* Please DO NOT modify this information : */

