<?php

declare(strict_types=1);

namespace FormBuilder\Models;

use FormBuilder\Models\User;
use FormBuilder\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use Sluggable, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'description', 'active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function questions(){
        return $this->belongsToMany(Question::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
