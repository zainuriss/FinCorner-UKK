<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenreRelation extends Model
{
    use SoftDeletes;
    protected $table = 'genre_relations';
    protected $primaryKey = 'id';
    protected $fillable = ['film_id', 'genre_id'];
    
    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id', 'id');
    }
    
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }
}

