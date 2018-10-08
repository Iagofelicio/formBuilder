<?php

namespace FormBuilder\Http\Controllers\Api;

use FormBuilder\Models\User;
use Illuminate\Http\Request;
use FormBuilder\Http\Requests\UserRequest;
use FormBuilder\Http\Controllers\Controller;
use FormBuilder\Http\Resources\UserResource;
use Formbuilder\Common\OnlyTrashed;

class UserController extends Controller
{
    use OnlyTrashed;

    public function index(Request $request)
    {
        $query = User::query();
        $query = $this->onlyTrashedIfRequested($request, $query);
        $products = $query->paginate(10);
        return UserResource::collection($products);
        /*$users = User::paginate(10);
        return UserResource::collection($users);*/
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        $user->refresh();
        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->save();
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([], 204);
    }
}
