<?php

use App\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $posts = [
            ['title' => 'homepage', 'created_at' => Carbon::now()],
            ['title' => 'loyalty', 'created_at' => Carbon::now()],
            ['title' => 'property', 'created_at' => Carbon::now()],
            ['title' => 'rewards', 'created_at' => Carbon::now()],
        ];

        Post::truncate(); //remove after insert all Users *
        Post::insert($posts);

    }
}
