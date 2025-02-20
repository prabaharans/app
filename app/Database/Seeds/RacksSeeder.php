<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RacksSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 26; $i++) {
            $seed = [
                'name'        => $faker->unique()->randomElement(['A', 'B', 'C', 'D', 'E', 'F' ,'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z']),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            $data[] = $seed;
        }

        $this->db->table('racks')->insertBatch($data);
    }
}
