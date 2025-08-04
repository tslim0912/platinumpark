<?php

use App\Admin;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            ['name' => 'admin', 'email' => 'admin@vibe.com', 'password' => '$2y$12$A9vEIY8hsFOQFN70PuyzVOrtsupw7PedUKvGtmJ2HxIXsZmWEvd7e'],
        ];

        Admin::truncate(); //remove after insert all Users *
        Admin::insert($user);

    }
}
