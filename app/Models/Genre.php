<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'genres';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'slug',
        'title',
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'genre_relations', 'genre_id', 'film_id');
    }
}
