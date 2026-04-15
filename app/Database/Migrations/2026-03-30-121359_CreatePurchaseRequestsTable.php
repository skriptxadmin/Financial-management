<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePurchaseRequestsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                 => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'slug'               => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'title'              => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'request_id'         => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'company_id'         => [
                'type'       => 'INT',
                'constraint' => '10',
            ],
            'status_id'         => [
                'type'       => 'INT',
                'constraint' => '10',
            ],
            'company_contact_id' => [
                'type'       => 'INT',
                'constraint' => '10',
            ],
            'discount'           => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
            ],
            'tax'                => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
            ],
            'total'              => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
            ],
            'payable'            => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
            ],
             'notes'            => [
                'type'       => 'TEXT',
            ],
            'approved_by'        => [
                'type'    => 'INT',
                'null'    => true,
            ],
            'approved_at'        => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'rejected_by'        => [
                'type'    => 'INT',
                'null'    => true,
            ],
            'rejected_at'        => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'notes'              => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'approval_notes'     => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'rejection_notes'    => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_by'         => [
                'type'    => 'INT',
                'null'    => true,
                'default' => 1,
            ],
            'updated_by'         => [
                'type'    => 'INT',
                'null'    => true,
                'default' => 1,
            ],
            'deleted_by'         => [
                'type' => 'INT',
                'null' => true,
            ],
            'created_at'         => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at'         => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'deleted_at'         => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('purchase_requests');

    }

    public function down()
    {
        $this->forge->dropTable('purchase_requests');

    }
}
