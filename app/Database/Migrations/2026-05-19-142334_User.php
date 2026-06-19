<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
        {
            $this->forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11, // <-- Tambahkan constraint agar seragam
                    'unsigned'       => TRUE,
                    'auto_increment' => TRUE
                ],
                'username' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                    // 'unique' => TRUE <-- HAPUS DARI SINI
                ],
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                    // 'unique' => TRUE <-- HAPUS DARI SINI
                ],
                'password' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                ],
                'role' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => FALSE,
                ],
                'created_at' => [
                    'type' => 'datetime',
                    'null' => TRUE
                ],
                'updated_at' => [
                    'type' => 'datetime',
                    'null' => TRUE
                ]
            ]);

            $this->forge->addKey('id', TRUE);
            
            // Pindahkan UNIQUE KEY ke fungsi bawaan forge di bawah ini:
            $this->forge->addUniqueKey('username');
            $this->forge->addUniqueKey('email');

            $this->forge->createTable('user');
        }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('user');
    }
}