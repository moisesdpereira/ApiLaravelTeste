<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cities';

    protected $hidden = [
        'name',
        'state',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'nome',
        'estado',
    ];

    public function getNomeAttribute()
    {
        return $this->attributes['name'];
    }

     public function getEstadoAttribute()
     {
         return $this->attributes['state'];
     }

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}
