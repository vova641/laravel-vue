<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cont extends Model
{
    protected $fillable = [
        'name',
        'text',
        'mail',        
    ];
    
}
