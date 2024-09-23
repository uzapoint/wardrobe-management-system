<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloth extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'size', 'color', 'image'
    ];
    protected $primaryKey = 'cloth_id';
  
}
