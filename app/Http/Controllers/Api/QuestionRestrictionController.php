<?php

namespace FormBuilder\Http\Controllers\Api;

use Illuminate\Http\Request;
use FormBuilder\Http\Controllers\Controller;
use FormBuilder\Http\Requests\QuestionRestrictionRequest;
use FormBuilder\Http\Resources\QuestionRestrictionResource;
use FormBuilder\Models\Question;
use FormBuilder\Models\Restriction;

class QuestionRestrictionController extends Controller
{
    public function index(Question $question)
    {
        return new QuestionRestrictionResource($question);
    }

    public function store(QuestionRestrictionRequest $request, Question $question)
    {
        //sincronizando os id's sem deletar os já existentes
        $changed = $question->restrictions()->syncWithoutDetaching($request->restrictions);
        $restrictionAttachedId = $changed['attached'];
        //var COLLECTION question
        $restriction = Restriction::whereIn('id', $restrictionAttachedId)->get(); //WHERE in IN (1,3)
        return $restriction->count() ? response()->json(new QuestionRestrictionResource($question), 201) : [];
    }

    public function destroy(Question $question, Restriction $restriction)
    {
        $question->restrictions()->detach($restriction->id);
        return response()->json([], 204);
    }
}
