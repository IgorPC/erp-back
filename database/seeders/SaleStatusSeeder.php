<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('sale_status')->insert([
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
