<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::truncate();
//        Post::truncate();
//        Category::truncate();
         \App\Models\User::factory(1)->create();
        Post::factory(3000)->create();
        Category::factory(3000)->create();
        Comment::factory(3000)->create();
    }
}
