<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use SoftDeletes;
    protected $table = 'genres';
    protected $primaryKey = 'id';
    protected $fillable = [
        'slug',
        'title',
    ];

    public function genreRel()
    {
        return $this->hasMany(GenreRelation::class,  'genre_id', 'film_id');
    }
}
