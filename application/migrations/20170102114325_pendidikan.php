<?php

class Migration_pendidikan extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'name_pendidikan'=>array(
             'type' => 'varchar',
             'constraint' => 25,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('pendidikan');
    }

    public function down() {
        $this->dbforge->drop_table('pendidikan');
    }

}