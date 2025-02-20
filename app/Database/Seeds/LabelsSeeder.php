<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LabelsSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $seed = [
                'name'        => $faker->unique()->word(),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            $data[] = $seed;
        }

        $this->db->table('labels')->insertBatch($data);
    }
}
