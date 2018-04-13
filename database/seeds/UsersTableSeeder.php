<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'name' => 'polo dev',
        'email' => 'dev@gmail.com',
        'password' => bcrypt('secret'),
      ]);
    }
}
