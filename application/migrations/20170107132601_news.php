<?php

class Migration_news extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
             'title' => array(
                'type' => 'varchar',
                'constraint' => 128,
            ),
             'slug' => array(
                'type' => 'varchar',
                'constraint' => 128,
            ),
             'text' => array(
                'type' => 'text',
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('slug');
        $this->dbforge->create_table('news');
    }

    public function down() {
        $this->dbforge->drop_table('news');
    }

}