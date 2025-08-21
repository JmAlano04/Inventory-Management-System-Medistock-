<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('medicines')->insert([
                'id'             => $i,
                'medicine_name'  => 'Medicine' . $i,
                'brand_name'     => 'Brand' . $i,
                'dosage'         => rand(100, 500) . 'mg',
                'catergory'      => 'General',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}
