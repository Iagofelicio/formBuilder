<?php

use FormBuilder\Models\Form;
use Illuminate\Database\Seeder;
use FormBuilder\Models\Question;

class FormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = Question::all();
        factory(Form::class, 20)
            ->create()
            ->each(function(Form $forms) use($questions){
                $questionId = $questions->random()->id;
                $forms->questions()->attach($questionId);
            });
    }
}
