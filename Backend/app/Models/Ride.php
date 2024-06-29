<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;
    protected  $fillable =['user_id','location','destination','time','rider','price','confirmed','paid']; 
}
