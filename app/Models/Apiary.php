<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'apiary_user', 'apiary_id', 'user_id');
    }

    public function hives()
    {
        return $this->hasMany(Hive::class, 'apiary_id');
    }


}
