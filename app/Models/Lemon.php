<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lemon extends Model
{
    // use HasFactory;
    protected $table = 'lemons';
    protected $fillable = ['good_lemon','bad_lemon','small_lemon','medium_lemon','big_lemon'];
    
}