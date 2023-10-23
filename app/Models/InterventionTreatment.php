<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionTreatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'type',
        'intensity',
        'interventions_id',
    ];

    public function intervention()
    {
        return $this->belongsTo(Interventions::class);
    }
}
