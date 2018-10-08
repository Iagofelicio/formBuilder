<?php

use Carbon\Carbon;
use FormBuilder\Models\Form;
use FormBuilder\Models\User;
use FormBuilder\Models\Answer;
use Illuminate\Database\Seeder;
use FormBuilder\Models\Question;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forms = Form::all();
        $questions = Question::all();
        $answers = Answer::all();
        $data = new Carbon('now');

        factory(User::class, 1)
            ->create([
                'email' => 'admin@user.com',
                'role_id' => 1
        ]);
        factory(User::class, 9)
            ->create()
            ->each(function(User $users) use($forms, $questions, $answers, $data){
                $formId = $forms->random()->id;
                $users->forms()->attach($formId);
                $questionId = $questions->random()->id;
                $answerId = $answers->random()->id;
                $userId = rand(1,10);

                DB::table('answer_question_users')->insert([
                    'answer_id' => $answerId, 
                    'question_id' => $questionId, 
                    'user_id' => $userId,
                    'created_at' => $data,
                    'updated_at' => $data
                ]);
            });
    }
}
