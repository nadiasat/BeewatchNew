<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionFood extends Model
{
    use HasFactory;

    protected $fillable = [
        'has_food',
        'interventions_id'
    ];

    public function intervention()
    {
        return $this->belongsTo(Interventions::class);
    }
}
