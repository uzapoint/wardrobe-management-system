<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WadrobeClothingCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'wadrobe_clothing_categories';

    protected $guarded = [];
}
