<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            'name' => "DewaJayon",
            'email' => "dewajayon3@gmail.com",
            'password' => Hash::make('password'),
        ]);

        DB::table('categories')->insert([
            'name' => "Series",
            'slug' => "series",
        ]);

        DB::table('animes')->insert([
            'title' => "Naruto",
            'slug' => "naruto",
            'category_id' => 1,
            'thumbnail' => "https://dummyimage.com/350x190/808080/fff",
            'description' => "Naruto",
            'status' => "Ongoing",
            'studio' => "Studio Jayon",
            'airing_date' => "2022-01-01 00:00:00",
        ]);

        DB::table('genres')->insert([
            'name' => "Romance",
            'slug' => "romance",
            'anime_id' => 1,
        ]);

        DB::table('episodes')->insert([
            'anime_id' => 1,
            'title' => "Naruto Episode 1",
            'slug' => "naruto-episode-1",
            'episode' => 1,
            'thumbnail' => "https://dummyimage.com/350x190/808080/fff",
            'video' => "video/video1.mp4",
            'duration' => "24 Menit",
        ]);
    }
}
