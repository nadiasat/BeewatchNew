<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'glimpse_queen',
        'queen_laid',
        'brood',
        'frames_full',
        'honey',
        'honey_rise',
        'nb_varroa',
        'comment',
        'interventions_id'
    ];

    public function intervention()
    {
        return $this->belongsTo(Interventions::class);
    }
}
