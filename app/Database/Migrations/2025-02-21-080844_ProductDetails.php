<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'product_bin_id' => [ 'type' => 'INT', 'constraint' => 5,'unsigned' => true ],
            'quantity' => [ 'type' => 'INT', 'constraint' => 5,'unsigned' => true ],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
            'deleted_at'  => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('product_bin_id', 'product_bins', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_details', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('product_details');
    }
}
