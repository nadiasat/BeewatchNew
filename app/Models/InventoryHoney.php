<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryHoney extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'jar_id',
        'user_id',
        'date'
    ];

    public function jar()
    {
       // return $this->belongsTo(Jar::class);
    }
}