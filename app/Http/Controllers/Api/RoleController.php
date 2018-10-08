<?php

namespace FormBuilder\Http\Controllers\Api;

use FormBuilder\Models\Role;
use Illuminate\Http\Request;
use FormBuilder\Common\OnlyTrashed;
use FormBuilder\Http\Controllers\Controller;
use FormBuilder\Http\Resources\RoleResource;

class RoleController extends Controller
{
    use OnlyTrashed;

    public function index(Request $request)
    {
        $query = Role::query();
        $query = $this->onlyTrashedIfRequested($request, $query);
        $products = $query->paginate();
        return RoleResource::collection($products);
    }

    public function show(Role $role)
    {
        return new RoleResource($role);
    }

}
