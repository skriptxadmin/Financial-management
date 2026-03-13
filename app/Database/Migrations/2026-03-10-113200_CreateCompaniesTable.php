<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCompaniesTable extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'slug'        => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'name'        => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
             'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'website'     => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'address_line_1'   => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'address_line_2'   => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
             'category_id'        => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'location_id'        => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'pincode'        => [
                'type'       => 'VARCHAR',
                'constraint' => '6',
            ],
            'status_id'   => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 1
            ],
            'visible'     => [
                'type'    => 'Boolean',
                'null'    => true,
                'default' => true,
            ],
            'notes'       => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'approved_by' => [
                'type'    => 'INT',
                'null'    => true,
            ],
            'rejected_by' => [
                'type'    => 'INT',
                'null'    => true,
            ],
            'created_by'  => [
                'type'    => 'INT',
                'null'    => true,
                'default' => 1,
            ],
            'updated_by'  => [
                'type'    => 'INT',
                'null'    => true,
                'default' => 1,
            ],
            'deleted_by'  => [
                'type' => 'INT',
                'null' => true,
            ],
            'approved_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'rejected_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'deleted_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('companies');
    }

    public function down()
    {
        $this->forge->dropTable('companies');
        
    }
}
