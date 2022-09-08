<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'super-admin'], //1
            ['name' => 'admin'], //2
            ['name' => 'doctor'], //3
            ['name' => 'desk'], //4
            ['name' => 'patient'], //5
            ['name' => 'unset'], //6
        ];

        foreach ($roles as $role) {
            UserRole::create($role);
        }
    }
}
