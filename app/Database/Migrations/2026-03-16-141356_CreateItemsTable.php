<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsTable extends Migration
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
            'nickname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'partno'     => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'unit_id'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'category_id'    => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'link'      => [
                'type'       => 'Text',
            ],
            'datasheet' => [
                'type'       => 'TEXT',
            ],
            'specification' => [
                'type' => 'TEXT',
            ],
            'handlinginstruction' => [
                'type' => 'TEXT',
            ],
            'tags'      => [
                'type' => 'TEXT',
            ],
            'description' => [
                'type' => 'TEXT',
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
        $this->forge->createTable('items');
    }

    public function down()
    {

        $this->forge->dropTable('items');

    }
}
