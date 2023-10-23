<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'name',
    ];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function hives()
    {
        return $this->hasMany(Hive::class);
    }
}
