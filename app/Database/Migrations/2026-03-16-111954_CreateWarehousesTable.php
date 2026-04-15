<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWarehousesTable extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'id'         => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'slug'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
             'status_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'location_primary_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'location_secondary_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'created_by' => [
                'type'    => 'INT',
                'null'    => true,
                'default' => 1,
            ],
            'updated_by' => [
                'type'    => 'INT',
                'null'    => true,
                'default' => 1,
            ],
            'deleted_by' => [
                'type' => 'INT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('warehouses');
    }
    

    public function down()
    {
        $this->forge->dropTable('warehouses');
    }
}
