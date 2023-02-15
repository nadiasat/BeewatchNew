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
        'rise',
        'nb_frames',
        'nb_varroa',
        'is_active',
        'apiary_id'
    ];

    public function apiary()
    {
        return $this->belongsTo(Apiary::class);
    }
}
