<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Users
        User::truncate();

        $admin = new User;
        $admin->name = 'Jordi';
        $admin->email = 'jordis@gmail.com';
        //No cal utiltizar bcrypt perque al model hem
        //utilitzat setAttribute password
        $admin->password = 'secret';
        $admin->save();


        $writer = new User;
        $writer->name = 'Pedro';
        $writer->email = 'pedros@gmail.com';
        //No cal utiltizar bcrypt perque al model hem
        //utilitzat setAttribute password
        $writer->password = 'secret';
        $writer->save();
    }
}
