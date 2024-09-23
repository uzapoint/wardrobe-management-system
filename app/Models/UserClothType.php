<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserClothType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ref_no', 'user_id', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userClothes()
    {
        return $this->hasMany(UserClothe::class);
    }
}
