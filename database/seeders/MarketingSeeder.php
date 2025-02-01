<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marketings')->insert([
            ['id' => 1, 'name' => 'Alfandy', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'Mery', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'Danang', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
