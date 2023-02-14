<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apiary_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'apiary_id',
        'user_id'
    ];

    

}
