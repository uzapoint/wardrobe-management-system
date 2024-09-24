<?php

// app/Models/Cloth.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloth extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'size', 'color', 'image', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
