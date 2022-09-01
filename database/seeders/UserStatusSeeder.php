<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // UserStatus::factory(3)->create();
        $statuses = [
            ['name' => 'new'],
            ['name' => 'active'],
            ['name' => 'inactive'],
            ['name' => 'dismissed'],
        ];

        foreach ($statuses as $status) {
            UserStatus::create($status);
        }
    }
}