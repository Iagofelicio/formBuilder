<?php
declare(strict_types=1);
namespace FormBuilder\Models;

use FormBuilder\Models\User;
use FormBuilder\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'answer', 'active'
    ];

    public function questions(){
        return $this->belongsToMany(Question::class);
    }

    public function users(){
        return $this.hasMany(User::class, 'answer_question_users');
    }
}
