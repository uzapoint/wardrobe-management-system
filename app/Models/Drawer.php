<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drawer extends Model
{
    use HasFactory;

    protected $fillable = ['wardrobe_id', 'drawer_name'];

    public function wardrobe(): BelongsTo
    {
        return $this->belongsTo(Wardrobe::class);
    }

    public function clothingItems(): HasMany
    {
        return $this->hasMany(ClothingItem::class);
    }
}
