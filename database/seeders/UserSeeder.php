<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'A', 'email' => 'a@g.com', 'password' => bcrypt('123456'), 'remember_token' => Str::random(10)],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
