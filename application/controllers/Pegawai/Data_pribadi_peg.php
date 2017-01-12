<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Data_pribadi_peg extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->ion_auth->logged_in()){
			redirect('AuthLogin', 'refresh');
		}
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->model(array('pegawai_model'));
	}

	public function index(){
		$q = urldecode($this->input->get('q', TRUE));
       	$start = intval($this->input->get('start'));
       	if ($q <> '') {
            $config['base_url'] = base_url() . 'pegawai/Data_pribadi_peg/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pegawai/Data_pribadi_peg/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pegawai/Data_pribadi_peg/index';
            $config['first_url'] = base_url() . 'pegawai/Data_pribadi_peg/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->pegawai_model->total_rows($q);
        $peg = $this->pegawai_model->get_limit_data($config['per_page'], $start, $q);

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
        $this->render_page('module/list_data_pribadi_peg',$this->data);
	}

	public function forminput(){
		$this->data['button'] = 'Save';
		$this->data['aksi'] = 'pegawai/Data_pribadi_peg/prosesinput';
		$this->data['nama'] = set_value('nama');
		$this->data['nik'] = set_value('nik');
		$this->data['tempat'] = set_value('tempat');
		$this->data['tanggallahir'] = set_value('tanggallahir');
		$this->data['alamat_KTP'] = set_value('alamat_KTP');
		$this->data['alamat_sekarang'] = set_value('alamat_sekarang');
		$this->data['kontak'] = set_value('kontak');
		$this->data['kontak1'] = set_value('kontak1');
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->render_page('module/form_data_pribadi_peg',$this->data);
	}

	public function formupdate($id){
		$row = $this->pegawai_model->get_by_id($id);
		if($row){
			$this->data['aksi'] = 'pegawai/Data_pribadi_peg/prosesupdate';
			$this->data['button'] = 'update';
			$this->data['back'] = ' <a href="javascript:history.go(-1);" class="btn btn-warning"><i class="fa fa-arrow-left"> </i> Back</a>';
			$this->data['photos'] = $row->photos;
			$this->data['nama'] = set_value('nama',$row->nama_lengkap);
			$this->data['nik'] = set_value('nik',$row->NIK);
			$this->data['id'] = set_value('id',$row->id);
			$this->data['tempat'] = set_value('tempat',$row->tempat);
			$this->data['tanggallahir'] = set_value('tanggallahir',$row->tgl_lahir);
			$this->data['alamat_KTP'] = $row->alamat_ktp;
			$this->data['alamat_sekarang'] = $row->alamat_sekarang;
			$this->data['kontak'] = set_value('kontak',$row->nomer_kontak_hp);
			$this->data['kontak1'] = set_value('kontak1',$row->nomer_kontak_tp);
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->render_page('module/form_data_pribadi_peg',$this->data);
		}else{
			 $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/data_pribadi_peg'));
		}
	}

	public function formdetail($id){
		$row = $this->pegawai_model->get_by_id($id);
		if($row){
			$this->data['aksi'] = '';
			$this->data['button'] = 'update';
			$this->data['photos'] = $row->photos;
			$this->data['nama'] = $row->nama_lengkap;
			$this->data['nik'] = $row->NIK;
			$this->data['id'] = $row->id;
			$this->data['tempat'] = $row->tempat;
			$this->data['tanggallahir'] = $row->tgl_lahir;
			$this->data['alamat_KTP'] = $row->alamat_ktp;
			$this->data['alamat_sekarang'] = $row->alamat_sekarang;
			$this->data['kontak'] = $row->nomer_kontak_hp;
			$this->data['kontak1'] = $row->nomer_kontak_tp;
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->render_page('module/list_detail_peg',$this->data);
		}else{
			 $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/data_pribadi_peg'));
		}

	}

	public function formmore($id){
		$row = $this->pegawai_model->get_by_id($id);
		if($row){
			$this->data['aksi'] = '';
			$this->data['button'] = 'update';
			$this->data['photos'] = $row->photos;
			$this->data['nama'] = $row->nama_lengkap;
			$this->data['nik'] = $row->NIK;
			$this->data['id'] = $row->id;
			$this->data['tempat'] = $row->tempat;
			$this->data['tanggallahir'] = $row->tgl_lahir;
			$this->data['alamat_KTP'] = $row->alamat_ktp;
			$this->data['alamat_sekarang'] = $row->alamat_sekarang;
			$this->data['kontak'] = $row->nomer_kontak_hp;
			$this->data['kontak1'] = $row->nomer_kontak_tp;
			$this->data['pen'] = $this->db->get('pendidikan')->result();
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->render_page('module/addmore_form_pegawai',$this->data);
		}else{
			 $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai/data_pribadi_peg'));
		}

	}

	public function prosesupdate(){
		$this->_rules();
		 if ($this->form_validation->run() == true){
		 		$ft = $this->input->post(null,true);
		 		$filter = $this->security->xss_clean($ft);
		 		//echo json_encode($filter);
		 		if ($_FILES['photos']['name']!=''){
		 			$logo2 = $_FILES['photos']['name'];
	                $direktori = './doc/images/photos_em/'; //Folder penyimpanan file
	                //$max_size  = 1000000*10; //Ukuran file maximal 10mb
	                 $nama_file =  $logo2 ; //Nama file yang akan di Upload
	               // $file_size = $_FILES['file']['size']; //Ukuran file yang akan di Upload
	                 $nama_tmp  = $_FILES['photos']['tmp_name']; //Nama file sementara
	                 $upload = $direktori . $nama_file;
	                 move_uploaded_file($nama_tmp, $upload);
	                 $cek['photos'] =$logo2;
		 		}
	               
		 		$cek['nama_lengkap'] = $filter['nama'];
		 		$cek['NIK'] = $filter['nik'];
		 		$cek['tempat'] = $filter['tempat'];
		 		$cek['tgl_lahir'] = $filter['tanggallahir'];
		 		$cek['alamat_ktp'] = $filter['alamat_KTP'];
		 		$cek['alamat_sekarang'] = $filter['alamat_sekarang'];
		 		$cek['nomer_kontak_hp'] = $filter['kontak'];
		 		$cek['nomer_kontak_tp'] = $filter['kontak1'];
		 		$this->db->update('pegawai',$cek,array('id'=>$filter['id']));
		 		$this->session->set_flashdata('message','Data Telah Diupdate');
		 		redirect('pegawai/data_pribadi_peg','refresh');
		 }else{
		 	$id = $this->input->post('id');
		 	$this->formupdate($id);
		 }
	}

	public function delete($id){
		$delete = $this->pegawai_model->delete($id);
		 $this->session->set_flashdata('message', 'Record is Deleted');
          redirect(site_url('pegawai/data_pribadi_peg'));
	}


	public function prosesinput(){
		//form validasi input
		 $this->_rules();
		 if ($this->form_validation->run() == true){
		 		$ft = $this->input->post(null,true);
		 		$filter = $this->security->xss_clean($ft);
		 		//echo json_encode($filter);
		 		if ($_FILES['photos']['name']!='') 
	               	$logo2 = $_FILES['photos']['name'];
	                $direktori = './doc/images/photos_em/'; //Folder penyimpanan file
	                 $nama_file =  $logo2 ; //Nama file yang akan di Upload
	                 $nama_tmp  = $_FILES['photos']['tmp_name']; //Nama file sementara
	                 $upload = $direktori . $nama_file;
	                 move_uploaded_file($nama_tmp, $upload);
	                 $cek['photos'] =$logo2;

		 		$cek['nama_lengkap'] = $filter['nama'];
		 		$cek['NIK'] = $filter['nik'];
		 		$cek['tempat'] = $filter['tempat'];
		 		$cek['tgl_lahir'] = $filter['tanggallahir'];
		 		$cek['alamat_ktp'] = $filter['alamat_KTP'];
		 		$cek['alamat_sekarang'] = $filter['alamat_sekarang'];
		 		$cek['nomer_kontak_hp'] = $filter['kontak'];
		 		$cek['nomer_kontak_tp'] = $filter['kontak1'];
		 		$this->db->insert('pegawai',$cek);
		 		$this->session->set_flashdata('message','Data Telah Tersimpan');
		 		redirect('pegawai/data_pribadi_peg','refresh');
		 }else{
		 	$this->forminput();
		 }
	}

	public function _rules(){
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
		 $this->form_validation->set_rules('nik', 'NIK diisi sesuai dengan Nomor Induk Kependudukan', 'required');
		 $this->form_validation->set_rules('tempat', 'Tempat', 'required');
		 $this->form_validation->set_rules('tanggallahir', 'Tanggal Lahir', 'required');
		 $this->form_validation->set_rules('alamat_KTP', 'Alamat KTP', 'required');
		 $this->form_validation->set_rules('alamat_sekarang', 'Alamat Sekarang', 'required');
		 $this->form_validation->set_rules('kontak', 'Nomor Kontak yang bisa dihubungi', 'required');
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