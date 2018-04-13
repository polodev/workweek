<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
use App\Work;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $works = ['study', 'developing'];

      foreach(range(1, 100) as $i) {
        Work::insert([
          'topic' => $works[rand(0, 1)],
          'user_id' => 1,
          'hour' => rand(1, 5),
          'created_at' => Carbon::now()->subDays(rand(1, 40))->format('Y-m-d H:i:s')
        ]);
      }

    }
}
