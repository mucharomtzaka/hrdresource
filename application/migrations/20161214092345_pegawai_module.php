<?php

class Migration_pegawai_module extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'NIK' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'nama_lengkap' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'tempat' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'tgl_lahir' => array(
                'type' => 'date',
            ),
            'alamat_ktp' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'alamat_sekarang' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'nomer_kontak_hp' => array(
                'type' => 'varchar',
                'constraint' => 12,
            ),
            'nomer_kontak_tp' => array(
                'type' => 'varchar',
                'constraint' => 12,
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('pegawai');

    }

    public function down() {
        $this->dbforge->drop_table('pegawai');
    }

}