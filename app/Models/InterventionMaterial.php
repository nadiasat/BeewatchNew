<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'new_rise',
        'new_nb_frames',
        //'partitions_full',
        //'frame_male_cells',
        'interventions_id'
    ];

    public function intervention()
    {
        return $this->belongsTo(Interventions::class);
    }
}
