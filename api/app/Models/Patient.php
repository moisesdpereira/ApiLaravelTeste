<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'patients';

    protected $hidden = [
        'name',
        'cell_phone',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'nome',
        'celular',
    ];

    public function getNomeAttribute()
    {
        return $this->attributes['name'];
    }

    public function getCelularAttribute()
    {
        return $this->attributes['cell_phone'];
    }

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class, 'doctors_patients', 'doctor_id', 'patient_id');
    }
}
