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
        return $this->hasMany(Casting::class, 'film_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
