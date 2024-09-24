<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function clothingItems() {
        return $this->belongsToMany(ClothingItem::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
