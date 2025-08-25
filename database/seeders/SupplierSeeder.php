<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('suppliers')->insert([
                'supplier_name'  => 'Supplier ' . $i,
                'contact_person' => 'Contact Person ' . $i,
                'phone'          => '09' . rand(100000000, 999999999),
                'email'          => 'supplier' . $i . '@example.com',
                'address'        => 'Address ' . $i,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}
