<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'role_id'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'firstname'      => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'lastname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'username'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'email'          => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'unique'     => true,
            ],
            'mobile'         => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'unique'     => true,
            ],
            'password'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'otp'            => [
                'type'       => 'VARCHAR',
                'constraint' => 8,
                'null'       => true,
                'default'    => null,
            ],
            'otp_expires_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
            'gender'         => [
                'type'       => 'VARCHAR',
                'constraint' => '1',
            ],
            'notes'          => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
