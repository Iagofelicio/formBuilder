<?php

use Illuminate\Database\Seeder;
use FormBuilder\Models\Question;
use FormBuilder\Models\Restriction;
use FormBuilder\Models\Answer;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restrictions = Restriction::all();
        factory(Question::class, 15)
            ->create()
            ->each(function(Question $questions) use($restrictions){
                $restrictionId = $restrictions->random()->id;
                $questions->restrictions()->attach($restrictionId);
            });
    }
}
