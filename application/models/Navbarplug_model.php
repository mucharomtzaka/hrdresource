
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Navbarplug_model extends CI_Model{

public $table = 'navbarplug';
public $id = 'id_navbar';
public $order = 'DESC';

	function __construct(){
	  parent::__construct();
	}

// get all
	function get_all(){
	 $this->db->order_by($this->id, $this->order);
	  return $this->db->get($this->table)->result();
	}

// get data by id
	function get_by_id($id){
	$this->db->where($this->id, $id);
	 return $this->db->get($this->table)->row();
	}
				    
 // get total rows
	function total_rows($q = NULL) {
	 			$this->db->like('id_navbar', $q);
	$this->db->or_like('navbar_menu', $q);
	$this->db->or_like('url', $q);
	$this->db->or_like('icon', $q);
	$this->db->or_like('parent_id', $q);
	$this->db->from($this->table);
				 return $this->db->count_all_results();
	}

 // get data with limit and search
	function get_limit_data($limit, $start = 0, $q = NULL) {
	$this->db->order_by($this->id, $this->order);
	$this->db->like('id_navbar', $q);
	$this->db->or_like('navbar_menu', $q);
	$this->db->or_like('url', $q);
	$this->db->or_like('icon', $q);
	$this->db->or_like('parent_id', $q);
	$this->db->limit($limit, $start);
			 return $this->db->get($this->table)->result();
	}

// insert data
	function insert($data) {
	$this->db->insert($this->table, $data);
	}

// update data
	function update($id, $data) {
	 $this->db->where($this->id, $id);
	 $this->db->update($this->table, $data);
	 }

// delete data
	function delete($id)  {
	$this->db->where($this->id, $id);
	$this->db->delete($this->table);
	 }


	 public function menubar(){
     $hasil  = $this->db->query('SELECT id_navbar as menu_item_id, parent_id as menu_parent_id, navbar_menu as menu_item_name,concat("",url)as url,icon FROM navbarplug ')->result_array();
    $refs = array();
    $list = array();
    foreach ($hasil as $data) {
    	# code...
	    	 	$thisref = &$refs[ $data['menu_item_id'] ];
		        $thisref['menu_parent_id'] = $data['menu_parent_id'];
		        $thisref['menu_item_name'] = $data['menu_item_name'];
		        $thisref['url'] = $data['url'];
		        $thisref['icon'] = $data['icon'];
        if ($data['menu_parent_id'] == 0){
            $list[ $data['menu_item_id'] ] = &$thisref;
        }else{
            $refs[ $data['menu_parent_id'] ]['children'][ $data['menu_item_id'] ] = &$thisref;
        }
    }
    	return $list;
    }

    public function create_list($arr,$urutan)
    {
        if($urutan==0){
             $html = "\n<ul class='sidebar-menu'>\n";
        }else{
             $html = "\n<ul class='treeview-menu'>\n";
        }
        foreach ($arr as $key=>$v){
        	if (array_key_exists('children', $v)){
	                $html .= "<li class='treeview '>\n";
	                $html .= '<a href="#">
	                                 <i class="'.$v['icon'].'"></i> <span>'.$v['menu_item_name'].'</span>
						            <span class="pull-right-container">
						              <i class="fa fa-angle-left pull-right"></i>
						            </span>

	                            </a>';
	 
	                $html .= $this->create_list($v['children'],1);
	                $html .= "</li>\n";
	            }else{
	            	 $html .= '<li class="treeview"><a href="'.base_url().''.$v['url'].'">';
		            	 if($urutan==0){
		                        $html .= '<i class="'.$v['icon'].'"></i>';
		                    }
	                    if($urutan==1)
	                    {
	                        $html .=    '<i class="fa fa-angle-double-right"></i>';
	                    }
	                  $html .= "<span>".$v['menu_item_name']."</span></a></li>\n";
	              }
	            }
	            $html .= "</ul>\n";
	            return $html;
    }

}

				/* End of file Navbarplug_model.php */
				/* Location: ./application/models/Navbarplug_model.php */
				/* Please DO NOT modify this information : */
				