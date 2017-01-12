<?php

class Migration_role_premission extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'groups_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'plugin_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'view' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'edit' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'remove' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'download' => array(
                'type' => 'INT',
                'constraint' => 11,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('role_premission');
    }

    public function down() {
        $this->dbforge->drop_table('role_premission');
    }

}