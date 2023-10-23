<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'current_stock',
        'max_stock',
        'associated_to',
        'inventory_place_id'
    ];

    public function inventory_place()
    {
        return $this->belongsTo(InventoryPlace::class);
    }
}
