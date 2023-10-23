<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'inventory_place_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'apiary_user', 'apiary_id', 'user_id');
    }

    public function inventory_place()
    {
        return $this->belongsTo(InventoryPlace::class);
    }

    public function hives()
    {
        return $this->hasMany(Hive::class, 'apiary_id');
    }


}
