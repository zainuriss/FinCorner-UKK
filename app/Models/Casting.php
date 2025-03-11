<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Casting extends Model
{
    use SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'castings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'real_name',
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'casting_relations', 'casting_id', 'film_id');
    }
}
