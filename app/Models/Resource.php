<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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
        'category_id',
        'relation_id',
        'resource_type_id'
    ];

    protected $casts = [
        'validated' => 'boolean',
        'deleted' => 'boolean',
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
        return $this->hasMany(Comment::class)->whereNull('parent_id');

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function resourceType()
    {
        return $this->belongsTo(ResourceType::class);
    }

    public function relation()
    {
        return $this->belongsTo(Relation::class);
    }

    /*
    |--------------------------------------------------------------------------
    | EVENTS
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();
        // Par défaut récupérer uniquement les ressources non supprimées.
        static::addGlobalScope('no_deleted', function (Builder $builder) {
            $builder->where('deleted', false);
        });
    }
}
