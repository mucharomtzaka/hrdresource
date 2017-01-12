<?php

class Migration_newsplugin extends CI_Migration {

    public function up() {

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'Categories' => array(
                'type' => 'varchar',
                'constraint' => 128,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('newscategori');

         $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'Categories_id' => array(
                'type' => 'int',
                'constraint' => 11,
            ),'news_id' => array(
                'type' => 'int',
                'constraint' => 11,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('groupnews');
    }

    public function down() {
        $this->dbforge->drop_table('newscategori');
        $this->dbforge->drop_table('groupnews');
    }

}