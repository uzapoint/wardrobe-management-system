<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClothe extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ref_no', 'user_cloth_type_id', 'color', 'filename'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userClothType()
    {
        return $this->belongsTo(UserClothType::class);
    }
}
