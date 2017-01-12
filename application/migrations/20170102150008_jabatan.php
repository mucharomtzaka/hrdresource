<?php

class Migration_jabatan extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'name_jabatan' => array(
                'type' => 'varchar',
                'constraint' => 100,
            )
           
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('jabatan');
    }

    public function down() {
        $this->dbforge->drop_table('jabatan');
    }

}