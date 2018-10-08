<?php

namespace FormBuilder\Http\Controllers\Api;

use Carbon\Carbon;
use FormBuilder\Models\Form;
use FormBuilder\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use FormBuilder\Http\Controllers\Controller;
use FormBuilder\Http\Requests\UserFormRequest;
use FormBuilder\Http\Resources\UserFormResource;

class UserFormController extends Controller
{
    public function index(User $user)
    {
        return new UserFormResource($user);
    }

    public function store(UserFormRequest $request, User $user)
    {
        $formId = $request->form;
        $data = new Carbon('now');
        //inserindo no banco
        $teste = DB::table('form_user')->insert([
            'form_id' => $formId,
            'user_id' => $user->id,
            'created_at' => $data,
            'updated_at' => $data
        ]);
        $results = DB::select('select* from form_user where form_id = '.$formId.' and user_id = '.$user->id);
        return response()->json($results, 201);
    }

    public function destroy(User $user, Form $form)
    {
        $user->forms()->detach($form->id);
        return response()->json([], 204);
    }
}
