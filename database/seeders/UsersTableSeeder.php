<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        [
          'name' => 'John Doe',
          'email' => 'johndoe@example.com',
          'password' => Hash::make('password'),
        ],
        [
          'name' => 'Jane Smith',
          'email' => 'janesmith@example.com',
          'password' => Hash::make('password'),
        ],
        [
          'name' => 'Bob Johnson',
          'email' => 'bobjohnson@example.com',
          'password' => Hash::make('password'),
        ],
        [
          'name' => 'Sara Lee',
          'email' => 'saralee@example.com',
          'password' => Hash::make('password'),
        ],
        [
          'name' => 'Mike Brown',
          'email' => 'mikebrown@example.com',
          'password' => Hash::make('password'),
        ]
      ]);
    }
}
