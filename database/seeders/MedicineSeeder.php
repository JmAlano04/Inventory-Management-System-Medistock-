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
                'batches_id'  => rand(1,10),
                'brand_name'     => 'Brand' . $i,
                'dosage'         => rand(100, 500) . 'mg',
                'category'      => 'General',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}
