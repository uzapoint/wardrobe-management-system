<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;

    // Other model properties and methods...

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable=[
        'name', 'category', 'size', 'color', 'image'
    ];
}
