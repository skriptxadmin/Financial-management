<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePurchaseRequestItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                  => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'purchase_request_id' => [
                'type'       => 'INT',
                'constraint' => '10',
            ],
            'item_id'             => [
                'type'       => 'INT',
                'constraint' => '10',
            ],
            'quantity'            => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
            ],
            'price'               => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
            ],
                'subtotal'               => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
            ],
            'tax'                 => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
            ],
            'tax_amount'          => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
            ],
            'total'               => [
                'type'       => 'FLOAT',
                'constraint' => '10,2',
            ],
            'created_by'          => [
                'type'    => 'INT',
                'null'    => true,
                'default' => 1,
            ],
            'updated_by'          => [
                'type'    => 'INT',
                'null'    => true,
                'default' => 1,
            ],
            'deleted_by'          => [
                'type' => 'INT',
                'null' => true,
            ],
            'created_at'          => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at'          => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'deleted_at'          => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('purchase_request_items');

    }

    public function down()
    {
        $this->forge->dropTable('purchase_request_items');

    }
}
