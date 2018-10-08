<?php

namespace FormBuilder\Http\Controllers\Api;

use Illuminate\Http\Request;
use FormBuilder\Common\OnlyTrashed;
use FormBuilder\Models\Restriction;
use FormBuilder\Http\Controllers\Controller;
use FormBuilder\Http\Requests\RestrictionRequest;
use FormBuilder\Http\Resources\RestrictionResource;

class RestrictionController extends Controller
{
    use OnlyTrashed;

    public function index(Request $request)
    {
        $query = Restriction::query();
        $query = $this->onlyTrashedIfRequested($request, $query);
        $products = $query->paginate(10);
        return RestrictionResource::collection($products);
    }

    public function store(RestrictionRequest $request)
    {
        $restriction = Restriction::create($request->all());
        $restriction->refresh();
        return new RestrictionResource($restriction);
    }

    public function show(Restriction $restriction)
    {
        return new RestrictionResource($restriction);
    }

    public function update(RestrictionRequest $request, Restriction $restriction)
    {
        $restriction->fill($request->all());
        $restriction->save();
        return new RestrictionResource($restriction);
    }

    public function destroy(Restriction $restriction)
    {
        $restriction->delete();
        return response()->json([], 204);
    }
}
