<?php
declare(strict_types=1);
namespace FormBuilder\Models;

use FormBuilder\Models\Form;
use FormBuilder\Models\User;
use FormBuilder\Models\Answer;
use FormBuilder\Models\Restriction;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use Sluggable, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title', 'description', 'type', 'active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function forms(){
        return $this->belongsToMany(Form::class);
    }

    public function restrictions(){
        return $this->belongsToMany(Restriction::class);
    }

    public function answers(){
        return $this->belongsToMany(Answer::class);
    }

    public function users(){
        return $this.hasMany(User::class, 'answer_question_users');
    }
}
