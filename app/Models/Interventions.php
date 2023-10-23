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

    public function intervention_control()
    {
        return $this->hasOne(InterventionControl::class);
    }

    public function intervention_queen()
    {
        return $this->hasOne(InterventionQueen::class);
    }

    public function intervention_treatment()
    {
        return $this->hasOne(InterventionTreatment::class);
    }

    public function intervention_food()
    {
        return $this->hasOne(InterventionFood::class);
    }
}
