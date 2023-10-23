<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hive extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_queen',
        'color_queen',
        'rise',
        'max_nb_frames',
        'frames_slots',
        'nb_varroa',
        'treatment',
        'intensity',
        'food',
        'is_active',
        'apiary_id',
        'inventory_place_id',
    ];

    public function apiary()
    {
        return $this->belongsTo(Apiary::class);
    }

    public function inventory_place()
    {
        return $this->belongsTo(InventoryPlace::class);
    }

    public function interventions()
    {
        return $this->hasMany(Interventions::class);
    }
}
