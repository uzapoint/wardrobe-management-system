<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClothingItem extends Model
{
    use HasFactory;

    protected $fillable = ['wardrobe_id', 'drawer_id', 'user_id', 'clothing_name', 'color', 'size', 'image'];

    public function wardrobe(): BelongsTo
    {
        return $this->belongsTo(Wardrobe::class);
    }

    public function drawer(): BelongsTo
    {
        return $this->belongsTo(Drawer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
