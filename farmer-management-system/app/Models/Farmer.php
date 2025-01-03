<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Farmer extends Model
{
    use HasFactory;
    protected $connection = 'mysql'; 
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'location',
    ];
}
