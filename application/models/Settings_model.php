<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$d = $this->db->get('settings')->row_array();
		return $d;
	}

	public function emailset(){
		return $this->db->get('settings_email')->row_array();
	}

	public function save($arraylistdata){
		$this->db->set($arraylistdata);
		$this->db->where('id',$arraylistdata['id']);
		return $this->db->update('settings');
	}

	public function saveemail($listdata){
		$this->db->set($listdata);
		$this->db->where('id',$listdata['id']);
		return $this->db->update('settings_email');
	}

	
}