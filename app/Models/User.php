<?php
declare(strict_types=1);
namespace FormBuilder\Models;

use FormBuilder\Role;
use FormBuilder\Models\Form;
use FormBuilder\Models\Answer;
use FormBuilder\Models\Question;
use Illuminate\Notifications\Notifiable;
use FormBuilder\Models\AnswerQuestionUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'role_id', 'date_birth', 'password
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fill(array $attributes)
    {
        !isset($attributes['password']) ?: $attributes['password'] = bcrypt($attributes['password']);
        return parent::fill($attributes);
    }

    public function getJWTIdentifier(){
        return $this->id;
    }

    public function getJWTCustomClaims()
    {
        return [
            'email' => $this->email,
            'name' => $this->name
        ];
    }

    public function roles(){
        return $this.hasMany(Role::class);
    }

    public function forms(){
        return $this->belongsToMany(Form::class);
    }

    public function questions(){
        return $this->belongsTo(Question::class, 'answer_question_users');
    }

    public function answers(){
        return $this->belongsTo(Answer::class, 'answer_question_users');
    }
}
