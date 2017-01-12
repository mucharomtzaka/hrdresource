<?php

class Migration_plugin_module extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'name_modules'=>array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'status_modules'=>array(
                'type' => 'int',
                'constraint' =>1,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('plugin_module');
    }

    public function down() {
        $this->dbforge->drop_table('plugin_module');
    }

}