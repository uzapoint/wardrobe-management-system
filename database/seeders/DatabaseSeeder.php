<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Clothes;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'Ronald Kimeli',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
            ]);
        }

         // Create specific categories
         $categories = [
            'Sweaters',
            'Jackets',
            'Shirts',
            'Blouses',
            'Socks',
            'Pants' 
        ];
        
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
        
        // Create 50 clothes items with random user and category
        Clothes::factory(20)->create();
    }
}
