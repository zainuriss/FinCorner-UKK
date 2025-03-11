<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CastingRelation extends Model
{
    use SoftDeletes;
    protected $table = 'casting_relations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'casting_id',
        'film_id',
        'character_name'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id', 'id');
    }
    public function casting()
    {
        return $this->belongsTo(Casting::class, 'casting_id', 'id');
    }
}
