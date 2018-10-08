<?php

namespace FormBuilder\Http\Controllers\Api;

use Carbon\Carbon;
use FormBuilder\Models\Form;
use Illuminate\Http\Request;
use FormBuilder\Common\OnlyTrashed;
use FormBuilder\Http\Requests\FormsRequest;
use FormBuilder\Http\Controllers\Controller;
use FormBuilder\Http\Resources\FormResource;

class FormController extends Controller
{
    use OnlyTrashed;

    public function index(Request $request)
    {
        $query = Form::query();
        $query = $this->onlyTrashedIfRequested($request, $query);
        $products = $query->paginate(10);
        return FormResource::collection($products);
    }

    public function store(FormsRequest $request)
    {
        $form = Form::create($request->all());
        $form->refresh();
        return new FormResource($form);
    }

    public function show(Form $form)
    {
        return new FormResource($form);
    }

    public function update(FormsRequest $request, Form $form)
    {
        $form->fill($request->all());
        $form->save();
        return new FormResource($form);
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return response()->json([], 204);
    }
}
