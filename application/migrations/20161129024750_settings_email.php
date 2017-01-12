<?php

class Migration_settings_email extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
             'protocol' => array(
                'type' => 'varchar',
                'constraint' => 80,
            ),
            'smtp_host' => array(
                'type' => 'varchar',
                'constraint' => 80,
            ),
            'smtp_user' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'smtp_pass' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'smtp_port' => array(
                'type' => 'varchar',
                'constraint' => 12,
            ),
            'newline_smtp'=>array(
                'type' => 'varchar',
                'constraint' => 25,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('settings_email');
    }

    public function down() {
        $this->dbforge->drop_table('settings_email');
    }

}