<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Overtrue\LaravelSubscribe\Traits\Subscribable;

class Resource extends Model
{
    use HasFactory;
    use Favoriteable;
    use Subscribable;

    protected $fillable = [
        'title',
        'content',
        'visibility',
        'validated',
        'deleted',
        'views',
    ];

    const PRIVATE_TYPE = 1;
    const SHARED_TYPE = 2;
    const PUBLIC_TYPE = 3;

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    /**
     * @var mixed
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function resourceType()
    {
        return $this->hasOne(ResourceType::class);
    }

    public function relation()
    {
        return $this->hasOne(Relation::class);
    }
}