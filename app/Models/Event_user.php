<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_user extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id'
    ];
}
