<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoneyJar extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'size',
        'nb_jar',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'honey_jar_user', 'honey_jar_id', 'user_id')
        ->withPivot('nb_jar')
        ->withTimestamps();
    }
}
