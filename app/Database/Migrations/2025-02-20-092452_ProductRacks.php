<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductRacks extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'product_id' => [ 'type' => 'INT', 'constraint' => 5,'unsigned' => true ],
            'rack_id' => [ 'type' => 'INT', 'constraint' => 5,'unsigned' => true ],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
            'deleted_at'  => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('rack_id', 'racks', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_racks', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('product_racks');
    }
}
