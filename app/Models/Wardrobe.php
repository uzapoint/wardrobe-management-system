<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wardrobe extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'wardobe_name'];

    public function drawers(): HasMany
    {
        return $this->hasMany(Drawer::class);
    }

    public function clothingItems(): HasMany
    {
        return $this->hasMany(ClothingItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
