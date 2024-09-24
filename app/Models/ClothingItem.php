<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClothingItem extends Model
{
    protected $fillable = ['name', 'image', 'size', 'color', 'material', 'category_id', 'user_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function outfits() {
        return $this->belongsToMany(Outfit::class);
    }
}
