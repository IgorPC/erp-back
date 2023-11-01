<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('product_status')->insert([
            [
                'description' => 'Active',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'description' => 'Inactive',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
