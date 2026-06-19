<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeletedAtToTables extends Migration
{
    public function up()
        {
            // Jalankan satu-satu dengan array baru agar tidak bentrok
            $this->forge->addColumn('user', [
                'deleted_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'updated_at']
            ]);

            $this->forge->addColumn('product', [
                'deleted_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'updated_at']
            ]);

            $this->forge->addColumn('transaction', [
                'deleted_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'updated_at']
            ]);

            $this->forge->addColumn('transaction_detail', [
                'deleted_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'updated_at']
            ]);
        }

    public function down()
    {
        // user
        $this->forge->dropColumn('user', 'deleted_at');

        // product
        $this->forge->dropColumn('product', 'deleted_at');

        // transaction
        $this->forge->dropColumn('transaction', 'deleted_at');

        // transaction_detail
        $this->forge->dropColumn('transaction_detail', 'deleted_at');
    }
}