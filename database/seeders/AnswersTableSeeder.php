<?php

namespace Database\Seeders;

use App\Models\Answers;
use App\Models\Questions;
use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Answers::truncate();
        $faker = \Faker\Factory::create();

        $QuestionId = 1;
        for ($i=1; $i < 31; $i++) {

            Answers::create([
                'answer' => $faker->sentence,
                'question_id' => $QuestionId,
            ]);

            if (($i % 3) == 0) {
                $q = Questions::find($QuestionId);
                $q->is_correct = $i;
                $q->save();
                $QuestionId++;
            }
        }
    }
}
