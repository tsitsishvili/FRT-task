<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Questions;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Questions::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Questions::create([
                'question' => $faker->sentence,
                'type_id' => 1,
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Questions::create([
                'question' => $faker->sentence,
                'type_id' => 2,
                'is_correct' => rand(1,2),
            ]);
        }
    }
}
