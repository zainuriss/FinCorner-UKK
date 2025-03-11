<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Film extends Model
{
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
    ];

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
