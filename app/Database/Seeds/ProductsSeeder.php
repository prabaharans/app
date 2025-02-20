<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $seed = [
                'name'        => $faker->unique()->word(),
                'uom'         => $faker->unique()->word(3),
                'quantity'    => $faker->randomDigit(),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            // $data[] = $seed;
            $this->db->table('products')->insert($seed);
            $productId = $this->db->insertID();
            $warehouseIds = [];
            $warehouseIds[] = $this->getRandomId('warehouses');
            $warehouseIds[] = $this->getRandomId('warehouses');
            $warehouseIds[] = $this->getRandomId('warehouses');
            foreach($warehouseIds as $key=>$warehouseId) {
                $pwSeed = [
                    'product_id' => $productId,
                    'warehouse_id' => $warehouseId,
                    'created_at'  => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s'),
                ];
                $this->db->table('product_warehouses')->insert($pwSeed);
                $productWareHouseId = $this->db->insertID();
                $rackId = $this->getRandomId('racks');
                $prSeed = [
                    'product_warehouse_id' => $productWareHouseId,
                    'rack_id' => $rackId,
                    'created_at'  => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s'),
                ];
                $this->db->table('product_racks')->insert($prSeed);
                $productRackId = $this->db->insertID();


                $binId = $this->getRandomId('bins');

                $prSeed = [
                    'product_rack_id' => $productRackId,
                    'bin_id' => $binId,
                    'created_at'  => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s'),
                ];
                $this->db->table('product_bins')->insert($prSeed);
            }


            $labelIds = [];
            $labelIds[] = $this->getRandomId('labels');
            $labelIds[] = $this->getRandomId('labels');
            $labelIds[] = $this->getRandomId('labels');
            foreach($labelIds as $key=>$labelId) {
                $plSeed = [
                    'product_id' => $productId,
                    'label_id' => $labelId,
                    'created_at'  => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s'),
                ];
                $this->db->table('product_labels')->insert($plSeed);
            }
        }


    }

    public function getRandomId($tableName)
    {
        $all_rows = $this->db->table($tableName)->get()->getResultArray();
        $random_row = $all_rows[rand(0,count($all_rows)-1)];
        return $random_row['id'];
    }

}
