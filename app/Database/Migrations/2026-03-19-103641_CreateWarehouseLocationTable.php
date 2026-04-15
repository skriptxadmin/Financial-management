<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWarehouseLocationsTable extends Migration
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
            'slug'             => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'unique'         => true,
            ],
            'institute'             => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'department'        => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'building_name'      => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'phone_number'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'floor_number'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'lab_number'          => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'note'         => [
                'type'       => 'TEXT',
            ],
            'created_by'=>[
                'type' => 'INT',
                'null'  => true,
                'default' => 1
            ],
             'updated_by'=>[
                'type' => 'INT',
                  'null'  => true,
                'default' => 1
            ],
             'deleted_by'=>[
                'type' => 'INT',
                  'null'  => true,
            ],
            'visible' =>[
                'type' =>'Boolean',
                'null' => true,
                'default' => true
            ],
            'blocked_at'     => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
            'verified_at'    => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
            'created_by'=>[
                'type' => 'INT',
                'null'  => true,
                'default' => 1
            ],
             'updated_by'=>[
                'type' => 'INT',
                  'null'  => true,
                'default' => 1
            ],
             'deleted_by'=>[
                'type' => 'INT',
                  'null'  => true,
            ],
            'created_at'     => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at'     => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'deleted_at'     => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('warehouse_locations');
    }

    public function down()
    {
        $this->forge->dropTable('warehouse_locations');
    }
}
