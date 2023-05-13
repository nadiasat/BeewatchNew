<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoneyJar_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'honey_jar_id',
        'user_id',
        'nb_jar'
    ];
}
