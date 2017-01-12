<?php

class Migration_navbarplug extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_navbar' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'navbar_menu' => array(
                'type' => 'varchar',
                'constraint' =>50,
            ),
            'url' => array(
                'type' => 'varchar',
                'constraint' => 80,
            ),
            'icon' => array(
                'type' => 'varchar',
                'constraint' =>30,
            ),'parent_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            )
        ));
        $this->dbforge->add_key('id_navbar', TRUE);
        $this->dbforge->add_key('parent_id');
        $this->dbforge->create_table('navbarplug');
    }

    public function down() {
        $this->dbforge->drop_table('navbarplug');
    }
}