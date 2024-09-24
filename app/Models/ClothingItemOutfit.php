<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClothingItemOutfit extends Model
{
    use HasFactory;

    // You can define the fillable attributes if needed
    protected $fillable = ['clothing_item_id', 'outfit_id'];

    // Define the relationship to ClothingItem
    public function clothingItem()
    {
        return $this->belongsTo(ClothingItem::class);
    }

    // Define the relationship to Outfit
    public function outfit()
    {
        return $this->belongsTo(Outfit::class);
    }
}
