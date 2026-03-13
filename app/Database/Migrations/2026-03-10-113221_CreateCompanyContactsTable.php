<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCompanyContactsTable extends Migration
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
            'company_id'  => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'name'        => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'designation'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'working'     => [
                'type'    => 'Boolean',
                'null'    => true,
                'default' => true,
            ],
            'status_id'   => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 1,
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
                'type' => 'INT',
                'null' => true,
            ],
            'rejected_by' => [
                'type' => 'INT',
                'null' => true,
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
        $this->forge->createTable('company_contacts');
    }

    public function down()
    {
        $this->forge->dropTable('company_contacts');

    }
}
