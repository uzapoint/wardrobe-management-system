<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;
     // Define the table if it's not plural
     protected $table = 'clothes';

     // Specify which attributes can be mass assigned
     protected $fillable = ['name', 'category', 'size', 'color', 'image', 'user_id'];
 
     // Define the relationship if applicable (e.g., if each cloth belongs to a user)
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
