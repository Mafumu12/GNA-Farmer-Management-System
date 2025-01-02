<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $connection = 'mysql'; 
    // Specify the table name (if it differs from the default, which is 'modules')
    protected $table = 'modules';

    // Define the fillable attributes (columns that can be mass-assigned)
    protected $fillable = ['name', 'is_active'];

    // You can also define casts if necessary, for example:
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
