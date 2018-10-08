<?php

namespace FormBuilder\Http\Controllers\Api;

use Illuminate\Http\Request;
use FormBuilder\Models\Answer;
use FormBuilder\Common\OnlyTrashed;
use FormBuilder\Http\Controllers\Controller;
use FormBuilder\Http\Requests\AnswerRequest;
use FormBuilder\Http\Resources\AnswerResource;

class AnswerController extends Controller
{
    use OnlyTrashed;

    public function index(Request $request)
    {
        $query = Answer::query();
        $query = $this->onlyTrashedIfRequested($request, $query);
        $products = $query->paginate(10);
        return AnswerResource::collection($products);
    }

    public function store(AnswerRequest $request)
    {
        $answer = Answer::create($request->all());
        $answer->refresh();
        return new AnswerResource($answer);
    }

    public function show(Answer $answer)
    {
        return new AnswerResource($answer);
    }

    public function update(AnswerRequest $request, Answer $answer)
    {
        $answer->fill($request->all());
        $answer->save();
        return new AnswerResource($answer);
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();
        return response()->json([], 204);
    }
}
