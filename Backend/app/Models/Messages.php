<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rider',
        'message',
        'service',
        'destination',
        'location',
        'number'
    ];
}
