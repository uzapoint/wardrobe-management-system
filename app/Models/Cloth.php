<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloth extends Model
{
    use HasFactory;

    protected $fillable = [
        'cloth_name',
        'category',
        'color',
        'size',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
