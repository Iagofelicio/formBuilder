<?php

namespace FormBuilder\Http\Controllers\Api;

use FormBuilder\Models\Form;
use Illuminate\Http\Request;
use FormBuilder\Http\Controllers\Controller;
use FormBuilder\Http\Requests\FormQuestionRequest;
use FormBuilder\Http\Resources\FormQuestionResource;
use FormBuilder\Models\Question;

class FormQuestionController extends Controller
{
    public function index(Form $form)
    {
        return new FormQuestionResource($form);
    }

    public function store(FormQuestionRequest $request, Form $form)
    {
        //sincronizando os id's sem deletar os já existentes
        $changed = $form->questions()->syncWithoutDetaching($request->questions);
        $questionAttachedId = $changed['attached'];
        //var COLLECTION question
        $question = Question::whereIn('id', $questionAttachedId)->get(); //WHERE in IN (1,3)
        return $question->count() ? response()->json(new FormQuestionResource($form), 201) : [];
    }

    public function destroy(Form $form, Question $question)
    {
        $form->questions()->detach($question->id);
        return response()->json([], 204);
    }
}
