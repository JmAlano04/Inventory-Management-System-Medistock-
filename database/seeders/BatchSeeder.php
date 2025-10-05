<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class BatchSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $batches = [];

      

        for ($i = 1; $i <= 10; $i++) {
            $batches[] = [
                'medicine_name' => 'Medicine ' . $i, // assumes you have at least 5 medicines
                'batch_code' => 1000 + $i,
                'quantity' => rand(10, 200),
                'expiry_date' => Carbon::now()->addMonths(rand(6, 24))->toDateString(),
                'unit_cost' => rand(10, 50),
                'supplier_id' => rand(1,10),
                'status' => 'Available',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('batches')->insert($batches);
    }
}
