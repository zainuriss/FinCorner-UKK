<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use SoftDeletes;
    protected $table = 'films';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'description',
        'release_year',
        'duration',
        'rating',
        'creator',
        'trailer',
        'poster',
    ];

    public function genreRel()
    {
        return $this->hasMany(GenreRelation::class, 'film_id', 'id');
    }
}
