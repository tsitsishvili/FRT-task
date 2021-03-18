<?php

namespace Database\Seeders;

use App\Models\Statistics;
use Illuminate\Database\Seeder;

class StatisticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Statistics::truncate();

        for ($i = 1; $i <= 2; $i++) {
            Statistics::create([
                'type_id' => $i,
            ]);
        }
    }
}
