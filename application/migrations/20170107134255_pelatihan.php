<?php

class Migration_pelatihan extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_pelatihan' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'id_pegawai' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'id_master_pelatihan' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'uraian' => array(
                'type' => 'text',
            ),
            'lokasi' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'tanggal_sertifikat' => array(
                'type' => 'varchar',
                'constraint' => 50,
            ),
            'jam_pelatihan' => array(
                'type' => 'varchar',
                'constraint' => 50,
            )
            ,'negara' => array(
                'type' => 'varchar',
                'constraint' => 100,
            )
        ));
        $this->dbforge->add_key('id_pelatihan', TRUE);
        $this->dbforge->create_table('pelatihan');
    }

    public function down() {
        $this->dbforge->drop_table('pelatihan');
    }

}