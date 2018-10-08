<?php
declare(strict_types=1);
namespace FormBuilder\Models;

use FormBuilder\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restriction extends Model
{
    use Sluggable, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title', 'slug', 'active', 'description'
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
}
