<?php

namespace FormBuilder\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use FormBuilder\Models\Answer;
use FormBuilder\Models\Question;
use Illuminate\Support\Facades\DB;
use FormBuilder\Http\Controllers\Controller;
use FormBuilder\Http\Controllers\Api\AuthController;
use FormBuilder\Http\Requests\AnswerQuestionRequest;
use FormBuilder\Http\Resources\AnswerQuestionResource;
use FormBuilder\Http\Resources\AnswerQuestionUserResource;

class AnswerQuestionController extends Controller
{
    public function index()
    {
        $users = DB::table('answer_question_users')->get();
        return AnswerQuestionUserResource::collection($users);
    }

    public function store(AnswerQuestionRequest $request, Answer $answer)
    {
        $questionAttachedId = $request->question;
        //pegando usuário autenticado
        $user = \Auth::guard('api')->user();
        $data = new Carbon('now');
        //inserindo no banco
        $teste = DB::table('answer_question_users')->insert([
            'answer_id' => $answer->id,
            'question_id' => $questionAttachedId,
            'user_id' => $user->id,
            'created_at' => $data,
            'updated_at' => $data
        ]);
        $results = DB::select('select* from answer_question_users where answer_id = '.$answer->id.' and question_id = '.$questionAttachedId);
        return response()->json($results, 201);
    }

    public function show(Answer $answer, Question $question)
    {
        $results = DB::select('select* from answer_question_users where answer_id = '.$answer->id.' and question_id = '.$question->id);
        return $results;
    }

    public function destroy(Answer $answer, Question $question)
    {
        $results = DB::delete('delete from answer_question_users where answer_id = :answerId and question_id = :questionId',[
            'answerId' => $answer->id, 'questionId' => $question->id
        ]);
        return response()->json([], 204);
    }
}
