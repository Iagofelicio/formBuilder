<?php
declare(strict_types=1);
namespace FormBuilder\Models;

use FormBuilder\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Role extends Model
{
    use Sluggable;

    protected $fillable = [
        'name', 'description'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user(){
        return $this.belongsTo(User::class);
    }
}
