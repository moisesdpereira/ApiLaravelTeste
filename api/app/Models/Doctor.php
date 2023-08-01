<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'doctors';

    protected $hidden = [
        'name',
        'specialty',
        'city_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'nome',
        'especialidade',
        'cidade_id',
    ];

    public function getNomeAttribute()
    {
        return $this->attributes['name'];
    }

    public function getEspecialidadeAttribute()
    {
        return $this->attributes['specialty'];
    }

    public function getCidadeIdAttribute()
    {
        return $this->attributes['city_id'];
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class, 'doctors_patients', 'doctor_id', 'patient_id');
    }
}
