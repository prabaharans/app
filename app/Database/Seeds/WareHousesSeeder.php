<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class WareHousesSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 1000; $i++) {
            $seed = [
                // 'name'        => $faker->sentence,
                // 'name'        => $faker->commerce->productName(),
                // 'name'        => $faker->company()->name(),
                'name'        => $faker->unique()->city(),
                // 'author'      => $faker->name,
                // 'description' => $faker->realText(),
                // 'status_id'   => $faker->randomElement(['1', '2', '3']),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            $data[] = $seed;
        }

        $this->db->table('warehouses')->insertBatch($data);
    }
}
