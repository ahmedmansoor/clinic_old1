<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
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
            [
                'name' => 'Admin',
                'user_role_id' => '2',
                'user_status_id' => '1',
                'nid' => 'A010101',
                'phone_number' => '9999999',
                'email' => 'admin@gmail.com',
                'dob' => Carbon::yesterday(),
                'password' => bcrypt('Admin321*'),
                'remember_token' => Str::random(10)
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}