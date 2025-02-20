<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BinsSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $seed = [
                'name'        => $faker->unique()->randomDigit(),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            $data[] = $seed;
        }

        $this->db->table('bins')->insertBatch($data);
    }
}
