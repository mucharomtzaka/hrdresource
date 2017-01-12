
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_model extends CI_Model{
public function menubar(){
     $hasil  = $this->db->query('SELECT id as menu_item_id, parent_id as menu_parent_id, title as menu_item_name,concat("",url)as url,menu_order,icon FROM dynamic_menu ORDER BY "menu_order"')->result_array();
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