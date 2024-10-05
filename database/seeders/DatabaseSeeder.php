<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use App\Models\Categorie;
use Illuminate\Database\Seeder;

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

        $categorie = Categorie::factory(5)->create(); 

        User::factory(10)->create()->each(function ($users) use ($categorie){
            Post::factory(rand(1,3))->create([
                'user_id'=>$users->id,
                'categorie_id'=>($categorie->random(1)->first())->id,
            ]);
        }); 
    }
}
