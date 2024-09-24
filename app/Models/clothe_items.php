<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clothe_items extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'category',
        'color',
        'size',
        'brand',
        'material',
        // 'purchase_date',
        'price',
    ];
}