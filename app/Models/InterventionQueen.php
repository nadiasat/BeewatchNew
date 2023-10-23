<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionQueen extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_queen',
        'color_queen',
        'rise',
        'frames_slots',
        'interventions_id'
    ];

    public function intervention()
    {
        return $this->belongsTo(Interventions::class);
    }
}
