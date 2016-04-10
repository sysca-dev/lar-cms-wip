<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new \App\User();
      $user->name = "Administrator";
      $user->password = bcrypt('secret');
      $user->email = "bethaneeks@gmail.com";
      $user->save();
    }
}
