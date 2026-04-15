<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoiceTable extends Migration
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
            'company_id'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'contact_id'     => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'invoice_number'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'invoice_date'    => [
                'type'       => 'DATE',
            ],
            'total_price'      => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'invoice_unique_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'reference_number' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'purchase_request_made' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'purchase_request_id'      => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'project_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'fund_head_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
                'created_by' => [
                    'type'    => 'INT',
                    'null'    => true,
                    'default' => 1,
                ],
                'created_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                ],
                'updated_by' => [
                    'type'    => 'INT',
                    'null'    => true,
                    'default' => 1,
                ],
                'updated_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                ],
                'modified_by' => [
                    'type'    => 'INT',
                    'null'    => true,
                    'default' => 1,
                ],
                'modified_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                ],
                'approved_by' => [
                    'type'    => 'INT',
                    'null'    => true,
                    'default' => 1,
                ],
                'approved_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                ],
                'reject_by' => [
                    'type'    => 'INT',
                    'null'    => true,
                    'default' => 1,
                ],
                'rejected_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                ],
                'notes' => [
                    'type'    => 'TEXT',
                    'null'    => true,
                ],
                'is_valid' => [
                    'type'    => 'TINYINT',
                    'constraint' => 1,
                    'default' => 1,
                ],
                'is_visible' => [
                    'type'    => 'TINYINT',
                    'constraint' => 1,
                    'default' => 1,
                ],
                'status' => [
                    'type'    => 'VARCHAR',
                    'constraint' => '100',
                    'null'    => true,
                ],
                'deleted_by' => [
                    'type'    => 'INT',
                    'null'    => true,
                ],
                'deleted_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,  
                ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('invoice');
    }

    public function down()
    {

        $this->forge->dropTable('invoice');

    }
}
