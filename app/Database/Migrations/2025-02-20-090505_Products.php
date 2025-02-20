<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'uom'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'quantity'    => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'status'      => ['type' => 'ENUM("Active","InActive")', 'default' => 'Active', 'null' => FALSE],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
            'deleted_at'  => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('name');
        $this->forge->addUniqueKey('uom');
        $this->forge->createTable('products', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
