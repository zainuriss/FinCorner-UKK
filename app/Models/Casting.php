<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Casting extends Model
{
    use SoftDeletes;
    protected $table = 'castings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'film_id', 
        'stage_name',
        'real_name',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id', 'id');
    }
}
