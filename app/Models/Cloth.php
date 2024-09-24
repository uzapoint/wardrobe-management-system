<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloth extends Model
{
    use HasFactory;

    // Explicitly specify the table name if it's not following Laravel's convention
    protected $table = 'clothes';  // Ensure this is 'clothes', not 'cloths'

    // Specify which attributes can be mass assigned
    protected $fillable = ['name', 'category', 'size', 'color', 'image'];
}
