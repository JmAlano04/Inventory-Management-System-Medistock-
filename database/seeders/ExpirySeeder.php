<?php

namespace Database\Seeders;

use App\Models\Batches;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Support\arr;
use Carbon\Carbon;

class ExpirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        $expiry = [];
        $batches = Batches::pluck('id')->toArray();
        shuffle($batches);
        $count = Batches::count('id');
        // $suppliers = Supplier::pluck('id')->toArray();
        // shuffle($suppliers);
        // $medicine = Medicine::pluck('id')->toArray();
        // shuffle($suppliers);

        for ($i = 1; $i <= $count; $i++) {      
            $expiry[] = [
                'medicines_id' => null,
                'batches_id' => Arr::random($batches), // assumes you have at least 5 medicines
                'supplier_id' => null,
                // 'batch_code' => 1000 + $i,
                // 'expiry_date' => Carbon::now()->addMonths(rand(6, 24))->toDateString(),
                // 'quantity' => rand(10, 200),
                'days_remaining' => rand(1, 31),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('expiries')->insert($expiry);
    }
}
