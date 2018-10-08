<?php

namespace FormBuilder\Http\Controllers\Api;

use Illuminate\Http\Request;
use FormBuilder\Models\Question;
use FormBuilder\Common\OnlyTrashed;
use FormBuilder\Http\Controllers\Controller;
use FormBuilder\Http\Requests\QuestionRequest;
use FormBuilder\Http\Resources\QuestionResource;

class QuestionController extends Controller
{
    use OnlyTrashed;

    public function index(Request $request)
    {
        $query = Question::query();
        $query = $this->onlyTrashedIfRequested($request, $query);
        $products = $query->paginate(10);
        return QuestionResource::collection($products);
    }

    public function store(QuestionRequest $request)
    {
        $question = Question::create($request->all());
        $question->refresh();
        return new QuestionResource($question);
    }

    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $question->fill($request->all());
        $question->save();
        return new QuestionResource($question);
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json([], 204);
    }
}
