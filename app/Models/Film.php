<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Film extends Model
{
    use HasSlug;
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'films';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
        'description',
        'release_year',
        'duration',
        'age_rating',
        'creator_id',
        'trailer',
        'poster',
        'slug'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_relations', 'film_id', 'genre_id');
    }

    public function casting()
    {
        return $this->hasMany(CastingRelation::class, 'film_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
