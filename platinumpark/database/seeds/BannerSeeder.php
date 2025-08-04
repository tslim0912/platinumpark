<?php

use App\Banner;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $banner = [
            ['title' => 'homepage', 'created_at' => Carbon::now()],
            ['title' => 'loyalty', 'created_at' => Carbon::now()],
            ['title' => 'property', 'created_at' => Carbon::now()],
            ['title' => 'rewards', 'created_at' => Carbon::now()],
        ];

        Banner::truncate(); //remove after insert all Users *
        Banner::insert($banner);

    }
}
