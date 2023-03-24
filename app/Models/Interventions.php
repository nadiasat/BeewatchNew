<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interventions extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'hive_id'
    ];

    public function hive()
    {
        return $this->belongsTo(Hive::class);
    }

    public function intervention_material()
    {
        return $this->hasOne(InterventionMaterial::class);
    }
}
