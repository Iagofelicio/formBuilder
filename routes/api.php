<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'as' => 'api.'], function(){
    Route::name('login')->post('login', 'AuthController@login');
    Route::name('refresh')->post('refresh', 'AuthController@refresh');

    //Route::group(['middleware' => ['auth:api', 'refresh']], function(){
    Route::group(['middleware' => ['auth:api']], function(){
        Route::name('logout')->post('logout', 'AuthController@logout');
        Route::name('me')->get('me', 'AuthController@me');
        Route::resource('roles', 'RoleController', ['only' => ['index', 'show']]);
        Route::resource('forms', 'FormController', ['except' => ['create', 'edit']]);
        Route::resource('questions', 'QuestionController', ['except' => ['create', 'edit']]);
        Route::resource('restrictions', 'RestrictionController', ['except' => ['create', 'edit']]);
        Route::resource('answers', 'AnswerController', ['except' => ['create', 'edit']]);
        Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
        Route::resource('forms.questions', 'FormQuestionController', ['only' => ['index', 'store', 'destroy']]);
        Route::resource('questions.restrictions', 'QuestionRestrictionController', ['only' => ['index', 'store', 'destroy']]);
        Route::resource('answers.questions', 'AnswerQuestionController', ['only' => ['index', 'store','show', 'destroy']]);
        Route::resource('users.forms', 'UserFormController', ['only' => ['index', 'store', 'destroy']]);
    });
});
